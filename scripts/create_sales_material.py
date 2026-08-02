#!/usr/bin/env python3
"""Create the A4 Dezaneko sales booklet PDF."""

from __future__ import annotations

import csv
import hashlib
import json
import math
import os
import re
import ssl
from collections import Counter
from pathlib import Path
from urllib.parse import urlparse
from urllib.request import Request, urlopen

from PIL import Image
from reportlab.graphics import renderPDF
from reportlab.graphics.barcode import qr
from reportlab.graphics.shapes import Drawing
from reportlab.lib.colors import Color, HexColor, white
from reportlab.lib.pagesizes import A4
from reportlab.lib.units import mm
from reportlab.pdfbase import pdfmetrics
from reportlab.pdfbase.ttfonts import TTFont
from reportlab.pdfgen import canvas


ROOT = Path(__file__).resolve().parents[1]
OUT_DIR = ROOT / "output" / "pdf"
TMP_DIR = ROOT / "tmp" / "pdfs"
OUT_PDF = OUT_DIR / "dezaneko_sales_guide_A4.pdf"
PRINT_WORKS_MANIFEST = ROOT / "data" / "print_works.json"


def resolve_font(env_name: str, candidates: tuple[str, ...]) -> str:
    configured = os.environ.get(env_name, "").strip()
    paths = ([configured] if configured else []) + list(candidates)
    for value in paths:
        if value and Path(value).is_file():
            return value
    raise FileNotFoundError(
        f"Font not found for {env_name}. Set {env_name} to an installed font file."
    )


W, H = A4
ORANGE = HexColor("#F07B17")
ORANGE_LIGHT = HexColor("#FFF1E5")
GREEN = HexColor("#45A829")
GREEN_LIGHT = HexColor("#EDF8E9")
INK = HexColor("#1A1A1A")
MUTED = HexColor("#667066")
LINE = HexColor("#DDE4DC")
PALE = HexColor("#F6F8F5")
PALE_GREEN = HexColor("#F2F8EF")
YELLOW = HexColor("#FFF6CC")

DATA_DATE = "2026.07.26"
WEB_WORKS_URL = "https://d-neko.com/works_archive.php"
PRINT_WORKS_URL = "https://d-neko.com/entry_list.php?type=works"
PROFILE_URL = "https://d-neko.com/profile.php"
ABOUT_URL = "https://d-neko.com/about.php"
HOME_URL = "https://d-neko.com/"
CONTACT_URL = "https://d-neko.com/contact.php"
LINE_URL = "https://line.me/R/ti/p/@quy1014b"


def register_fonts() -> None:
    font_jp = resolve_font(
        "DNEKO_FONT_JP",
        (
            str(ROOT / "assets" / "fonts" / "NotoSansJP-Bold.ttf"),
            str(Path.home() / "Library" / "Fonts" / "NotoSansJP-Bold.ttf"),
            "/usr/share/fonts/opentype/noto/NotoSansCJK-Bold.ttc",
        ),
    )
    font_en = resolve_font(
        "DNEKO_FONT_EN",
        (
            str(ROOT / "assets" / "fonts" / "Roboto-Regular.ttf"),
            str(Path.home() / "Library" / "Fonts" / "Roboto-Regular.ttf"),
            "/usr/share/fonts/truetype/dejavu/DejaVuSans.ttf",
        ),
    )
    font_en_bold = resolve_font(
        "DNEKO_FONT_EN_BOLD",
        (
            str(ROOT / "assets" / "fonts" / "Roboto-Bold.ttf"),
            str(Path.home() / "Library" / "Fonts" / "Roboto-Bold.ttf"),
            "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf",
        ),
    )
    font_en_black = resolve_font(
        "DNEKO_FONT_EN_BLACK",
        (
            str(ROOT / "assets" / "fonts" / "Roboto-Black.ttf"),
            str(Path.home() / "Library" / "Fonts" / "Roboto-Black.ttf"),
            "/usr/share/fonts/truetype/dejavu/DejaVuSans-Bold.ttf",
        ),
    )
    pdfmetrics.registerFont(TTFont("JP", font_jp))
    pdfmetrics.registerFont(TTFont("EN", font_en))
    pdfmetrics.registerFont(TTFont("ENB", font_en_bold))
    pdfmetrics.registerFont(TTFont("ENX", font_en_black))


def sw(text: str, font: str, size: float) -> float:
    return pdfmetrics.stringWidth(text, font, size)


def wrap_chars(text: str, font: str, size: float, width: float) -> list[str]:
    text = re.sub(r"\s+", " ", text.strip())
    if not text:
        return []
    lines: list[str] = []
    current = ""
    for ch in text:
        candidate = current + ch
        if current and sw(candidate, font, size) > width:
            lines.append(current.rstrip())
            current = ch.lstrip()
        else:
            current = candidate
    if current:
        lines.append(current.rstrip())
    return lines


def fit_lines(
    text: str,
    font: str,
    start_size: float,
    min_size: float,
    width: float,
    max_lines: int,
) -> tuple[float, list[str]]:
    size = start_size
    while size >= min_size:
        lines = wrap_chars(text, font, size, width)
        if len(lines) <= max_lines:
            return size, lines
        size -= 0.25
    lines = wrap_chars(text, font, min_size, width)
    if len(lines) > max_lines:
        merged = lines[: max_lines - 1]
        tail = "".join(lines[max_lines - 1 :])
        while tail and sw(tail + "…", font, min_size) > width:
            tail = tail[:-1]
        lines = merged + [tail + "…"]
    return min_size, lines


def draw_text(
    c: canvas.Canvas,
    text: str,
    x: float,
    y: float,
    *,
    font: str = "JP",
    size: float = 10,
    color: Color = INK,
    align: str = "left",
) -> None:
    c.setFont(font, size)
    c.setFillColor(color)
    if align == "right":
        c.drawRightString(x, y, text)
    elif align == "center":
        c.drawCentredString(x, y, text)
    else:
        c.drawString(x, y, text)


def draw_wrapped(
    c: canvas.Canvas,
    text: str,
    x: float,
    y_top: float,
    width: float,
    *,
    font: str = "JP",
    size: float = 9,
    leading: float | None = None,
    color: Color = INK,
    max_lines: int | None = None,
) -> float:
    leading = leading or size * 1.55
    lines = wrap_chars(text, font, size, width)
    if max_lines is not None:
        lines = lines[:max_lines]
    y = y_top
    for line in lines:
        draw_text(c, line, x, y, font=font, size=size, color=color)
        y -= leading
    return y


def round_card(
    c: canvas.Canvas,
    x: float,
    y: float,
    w: float,
    h: float,
    *,
    fill: Color = white,
    stroke: Color = LINE,
    radius: float = 4 * mm,
    line_width: float = 0.7,
) -> None:
    c.setFillColor(fill)
    c.setStrokeColor(stroke)
    c.setLineWidth(line_width)
    c.roundRect(x, y, w, h, radius, fill=1, stroke=1)


def draw_image_cover(
    c: canvas.Canvas,
    path: Path,
    x: float,
    y: float,
    w: float,
    h: float,
    *,
    radius: float = 0,
) -> None:
    if not path.exists():
        c.setFillColor(PALE)
        c.rect(x, y, w, h, fill=1, stroke=0)
        return
    with Image.open(path) as im:
        iw, ih = im.size
    scale = max(w / iw, h / ih)
    dw, dh = iw * scale, ih * scale
    dx, dy = x + (w - dw) / 2, y + (h - dh) / 2
    c.saveState()
    p = c.beginPath()
    if radius:
        p.roundRect(x, y, w, h, radius)
    else:
        p.rect(x, y, w, h)
    c.clipPath(p, stroke=0, fill=0)
    c.drawImage(str(path), dx, dy, dw, dh, mask="auto")
    c.restoreState()


def draw_check(c: canvas.Canvas, x: float, y: float, text: str, width: float, size: float = 9) -> float:
    c.setFillColor(GREEN)
    c.circle(x + 3.2 * mm, y - 1.1 * mm, 2.4 * mm, fill=1, stroke=0)
    draw_text(c, "✓", x + 3.2 * mm, y - 2.6 * mm, size=7.4, color=white, align="center")
    return draw_wrapped(c, text, x + 8 * mm, y, width - 8 * mm, size=size, leading=size * 1.45)


def draw_qr(c: canvas.Canvas, value: str, x: float, y: float, size: float) -> None:
    widget = qr.QrCodeWidget(value)
    x1, y1, x2, y2 = widget.getBounds()
    sx = size / (x2 - x1)
    sy = size / (y2 - y1)
    drawing = Drawing(size, size, transform=[sx, 0, 0, sy, 0, 0])
    drawing.add(widget)
    renderPDF.draw(drawing, c, x, y)


def page_header(c: canvas.Canvas, title: str, section: str, page_no: int) -> None:
    c.setFillColor(white)
    c.rect(0, 0, W, H, fill=1, stroke=0)
    draw_text(c, section.upper(), 17 * mm, H - 16 * mm, font="ENB", size=7.5, color=GREEN)
    draw_text(c, title, 17 * mm, H - 27 * mm, size=19, color=INK)
    c.setFillColor(ORANGE)
    c.roundRect(17 * mm, H - 32 * mm, 16 * mm, 1.4 * mm, 0.7 * mm, fill=1, stroke=0)
    logo = ROOT / "images" / "logo.png"
    if logo.exists():
        c.drawImage(str(logo), W - 55 * mm, H - 25 * mm, 38 * mm, 15.8 * mm, preserveAspectRatio=True, mask="auto")
    footer(c, page_no)


def footer(c: canvas.Canvas, page_no: int) -> None:
    c.setStrokeColor(LINE)
    c.setLineWidth(0.5)
    c.line(17 * mm, 12 * mm, W - 17 * mm, 12 * mm)
    draw_text(c, f"DEZANEKO SALES GUIDE  |  {DATA_DATE}", 17 * mm, 7.5 * mm, font="EN", size=6.8, color=MUTED)
    draw_text(c, f"{page_no:02d}", W - 17 * mm, 7.5 * mm, font="ENB", size=7.2, color=ORANGE, align="right")


def new_page(c: canvas.Canvas) -> None:
    c.showPage()


def load_web_works() -> list[dict[str, str]]:
    path = ROOT / "data" / "web_design_works.csv"
    items: list[dict[str, str]] = []
    with path.open("r", encoding="utf-8-sig", newline="") as f:
        for row in csv.DictReader(f):
            name = (row.get("顧客名") or "").strip()
            url = (row.get("URL") or "").strip()
            if not name or not url:
                continue
            items.append(
                {
                    "category": (row.get("業種") or "その他").strip() or "その他",
                    "name": name,
                    "url": url,
                }
            )
    return items


def load_print_works() -> list[dict[str, str]]:
    with PRINT_WORKS_MANIFEST.open(encoding="utf-8") as source:
        payload = json.load(source)
    if not isinstance(payload, list):
        raise ValueError("data/print_works.json must contain a JSON array")

    works: list[dict[str, str]] = []
    for index, item in enumerate(payload):
        if not isinstance(item, dict):
            raise ValueError(f"print works item {index} must be an object")
        work = {
            key: str(item.get(key, "")).strip()
            for key in ("title", "image", "url")
        }
        if not all(work.values()):
            raise ValueError(f"print works item {index} is missing title, image, or url")
        works.append(work)
    return works


def download_print_images(works: list[dict[str, str]]) -> None:
    asset_dir = TMP_DIR / "print_works"
    asset_dir.mkdir(parents=True, exist_ok=True)
    for work in works:
        image_url = work["image"]
        image_host = (urlparse(image_url).hostname or "").lower()
        if image_host != "images.microcms-assets.io":
            raise ValueError(f"Unsupported print image host: {image_host}")
        suffix = Path(work["image"].split("?", 1)[0]).suffix.lower()
        if suffix not in {".jpg", ".jpeg", ".png", ".webp"}:
            suffix = ".img"
        cache_source = work["url"] + "\0" + image_url
        target = asset_dir / (hashlib.sha1(cache_source.encode()).hexdigest()[:14] + suffix)
        work["local_image"] = str(target)
        if target.exists() and target.stat().st_size > 1000:
            continue
        try:
            req = Request(image_url, headers={"User-Agent": "Mozilla/5.0"})
            with urlopen(req, timeout=30) as response:
                content_type = response.headers.get_content_type()
                if not content_type.startswith("image/"):
                    raise ValueError(f"Unexpected image content type: {content_type}")
                image_bytes = response.read(20 * 1024 * 1024 + 1)
                if len(image_bytes) > 20 * 1024 * 1024:
                    raise ValueError("Print image exceeds the 20 MB limit")
                target.write_bytes(image_bytes)
        except Exception as error:
            raise RuntimeError(
                f"Failed to download print image for {work['url']}: {image_url}"
            ) from error


def cover_page(c: canvas.Canvas, web_count: int, print_count: int) -> None:
    hero = ROOT / "images" / "home-renewal" / "hero-flyer.webp"
    draw_image_cover(c, hero, 0, 0, W, H)
    c.setFillColor(Color(1, 1, 1, alpha=0.88))
    c.roundRect(13 * mm, 24 * mm, 90 * mm, H - 48 * mm, 8 * mm, fill=1, stroke=0)
    c.drawImage(str(ROOT / "images" / "logo.png"), 22 * mm, H - 58 * mm, 61 * mm, 25 * mm, preserveAspectRatio=True, mask="auto")
    draw_text(c, "SALES GUIDE 2026", 22 * mm, H - 74 * mm, font="ENX", size=10, color=GREEN)
    c.setFillColor(ORANGE)
    c.roundRect(22 * mm, H - 81 * mm, 18 * mm, 1.5 * mm, 0.7 * mm, fill=1, stroke=0)
    draw_text(c, "チラシとホームページを、", 22 * mm, H - 105 * mm, size=20, color=INK)
    draw_text(c, "ひとつの窓口で。", 22 * mm, H - 119 * mm, size=27, color=ORANGE)
    draw_wrapped(
        c,
        "撮影・文章・デザイン・印刷・公開後の改善まで。開業1〜3年目の個人事業主に寄り添う、外部Web担当サービス。",
        22 * mm,
        H - 139 * mm,
        69 * mm,
        size=9.3,
        leading=15,
        color=INK,
    )
    y = 74 * mm
    metrics = [("20", "年", "デザイン・Web経験"), (f"{web_count:,}", "件", "掲載中のWeb制作実績"), (str(print_count), "件", "掲載中の印刷制作事例")]
    for idx, (num, unit, label) in enumerate(metrics):
        bx = 22 * mm + idx * 24 * mm
        draw_text(c, num, bx, y + 11 * mm, font="ENX", size=18, color=GREEN)
        draw_text(c, unit, bx + sw(num, "ENX", 18) + 1 * mm, y + 11.5 * mm, size=7.5, color=GREEN)
        draw_wrapped(c, label, bx, y + 3.5 * mm, 21 * mm, size=6.6, leading=8, color=MUTED)
    c.setFillColor(ORANGE)
    c.roundRect(22 * mm, 35 * mm, 68 * mm, 11 * mm, 5.5 * mm, fill=1, stroke=0)
    draw_text(c, "制作して終わりじゃない。一緒に育てる。", 56 * mm, 38.5 * mm, size=8.2, color=white, align="center")
    draw_text(c, f"掲載情報基準日 {DATA_DATE}", 22 * mm, 27 * mm, size=6.5, color=MUTED)


def challenges_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "チラシとWebを、ひとつの戦略に", "01  SOLUTION", page_no)
    y = H - 48 * mm
    draw_wrapped(
        c,
        "「何を作るか」から「どう届かせるか」まで、まとめて伴走します。",
        17 * mm,
        y,
        W - 34 * mm,
        size=12,
        leading=18,
        color=INK,
    )
    worries = [
        "ホームページとチラシを別々に頼むのが大変",
        "作ったホームページが問い合わせにつながらない",
        "写真や文章の準備で制作が止まってしまう",
        "Webと印刷物のデザインに統一感がない",
        "更新・修正のたびに費用が気になる",
        "相談できるWeb担当が身近にいない",
    ]
    top = H - 72 * mm
    card_w = (W - 42 * mm) / 2
    for i, text in enumerate(worries):
        col, row = i % 2, i // 2
        x = 17 * mm + col * (card_w + 8 * mm)
        cy = top - row * 32 * mm
        round_card(c, x, cy - 23 * mm, card_w, 24 * mm, fill=PALE, stroke=LINE, radius=4 * mm)
        c.setFillColor(GREEN)
        c.circle(x + 9 * mm, cy - 11 * mm, 3.2 * mm, fill=1, stroke=0)
        draw_text(c, "✓", x + 9 * mm, cy - 13 * mm, size=9, color=white, align="center")
        draw_wrapped(c, text, x + 16 * mm, cy - 7.5 * mm, card_w - 22 * mm, size=8.5, leading=12)
    c.setFillColor(GREEN)
    c.roundRect(17 * mm, 35 * mm, W - 34 * mm, 54 * mm, 7 * mm, fill=1, stroke=0)
    draw_text(c, "デザネコなら、窓口はひとつ。", W / 2, 76 * mm, size=17, color=white, align="center")
    draw_wrapped(
        c,
        "取材・撮影・コピー・デザイン・システム・印刷・公開後の改善まで、同じ担当者が一貫対応。小さな想いを、届くデザインへ。",
        31 * mm,
        63 * mm,
        W - 62 * mm,
        size=9.2,
        leading=14,
        color=white,
    )


def plan_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "デザインまるっとお任せプラン", "02  ALL-IN-ONE PLAN", page_no)
    c.setFillColor(ORANGE_LIGHT)
    c.roundRect(17 * mm, H - 94 * mm, W - 34 * mm, 53 * mm, 7 * mm, fill=1, stroke=0)
    draw_text(c, "集客の「入口」と「受け皿」をセットで整える", 27 * mm, H - 58 * mm, size=11, color=GREEN)
    draw_text(c, "チラシ × ホームページ", 27 * mm, H - 76 * mm, size=24, color=ORANGE)
    draw_wrapped(
        c,
        "伝える内容と見た目を統一し、紙からWebへ迷わず進める導線をつくります。",
        27 * mm,
        H - 87 * mm,
        W - 68 * mm,
        size=8.8,
        leading=13,
    )
    boxes = [
        ("01", "ブランドの顔を統一", "チラシ・名刺・Web・SNSまで、同じ世界観で制作。"),
        ("02", "公開後も数字で改善", "アクセス数・検索キーワード・問い合わせ動向を確認。"),
        ("03", "素材準備もお任せ", "取材・撮影・文章作成まで内部対応。制作が止まりません。"),
        ("04", "相談窓口がひとつ", "比嘉が最初から最後まで責任を持って伴走します。"),
    ]
    card_w = (W - 42 * mm) / 2
    top = H - 111 * mm
    for i, (num, title, body) in enumerate(boxes):
        col, row = i % 2, i // 2
        x = 17 * mm + col * (card_w + 8 * mm)
        y = top - row * 50 * mm
        round_card(c, x, y - 41 * mm, card_w, 42 * mm, fill=white, stroke=GREEN, radius=5 * mm, line_width=1.1)
        c.setFillColor(GREEN)
        c.circle(x + 11 * mm, y - 12 * mm, 6 * mm, fill=1, stroke=0)
        draw_text(c, num, x + 11 * mm, y - 14.2 * mm, font="ENB", size=8, color=white, align="center")
        draw_text(c, title, x + 21 * mm, y - 12.5 * mm, size=10.5, color=INK)
        draw_wrapped(c, body, x + 10 * mm, y - 25 * mm, card_w - 20 * mm, size=7.8, leading=11.5, color=MUTED)
    draw_text(c, "20年・1,000件超の現場経験を、あなたのお店のために。", W / 2, 42 * mm, size=11, color=ORANGE, align="center")


def price_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "ホームページ制作・運用プラン", "03  PRICE", page_no)
    x, y, w, h = 17 * mm, H - 143 * mm, W - 34 * mm, 101 * mm
    round_card(c, x, y, w, h, fill=white, stroke=ORANGE, radius=7 * mm, line_width=1.6)
    c.setFillColor(ORANGE)
    c.roundRect(x, y + h - 21 * mm, w, 21 * mm, 7 * mm, fill=1, stroke=0)
    c.rect(x, y + h - 21 * mm, w, 7 * mm, fill=1, stroke=0)
    draw_text(c, "いちばん人気  |  ホームページ制作・運用プラン", x + 10 * mm, y + h - 14 * mm, size=10, color=white)
    draw_text(c, "初期費用", x + 12 * mm, y + h - 41 * mm, size=8.5, color=MUTED)
    draw_text(c, "0円", x + 12 * mm, y + h - 58 * mm, size=27, color=GREEN)
    draw_text(c, "制作費無料", x + 13 * mm, y + h - 69 * mm, size=7.5, color=MUTED)
    c.setStrokeColor(LINE)
    c.line(x + 57 * mm, y + 21 * mm, x + 57 * mm, y + h - 29 * mm)
    draw_text(c, "月額", x + 67 * mm, y + h - 41 * mm, size=8.5, color=MUTED)
    draw_text(c, "9,800", x + 66 * mm, y + h - 60 * mm, font="ENX", size=30, color=ORANGE)
    draw_text(c, "円", x + 115 * mm, y + h - 57 * mm, size=11, color=ORANGE)
    draw_text(c, "税込・長期割", x + 67 * mm, y + h - 70 * mm, size=7.4, color=MUTED)
    c.setFillColor(GREEN_LIGHT)
    c.roundRect(x + w - 46 * mm, y + 22 * mm, 34 * mm, 51 * mm, 5 * mm, fill=1, stroke=0)
    draw_text(c, "契約縛り", x + w - 29 * mm, y + 59 * mm, size=8, color=GREEN, align="center")
    draw_text(c, "なし", x + w - 29 * mm, y + 44 * mm, size=18, color=GREEN, align="center")
    draw_text(c, "いつでも解約OK", x + w - 29 * mm, y + 31 * mm, size=7.2, color=MUTED, align="center")
    draw_text(c, "プランに含まれるもの", 17 * mm, H - 160 * mm, size=12, color=INK)
    items = [
        "オリジナルデザイン／スマホ・タブレット対応",
        "取材・撮影／キャッチコピー・文章作成",
        "サーバー・ドメイン管理／SSL対応",
        "お問い合わせフォーム／SNS連携",
        "月次レポート＆専用ダッシュボード",
        "更新対応（回数無制限）",
        "Google Map（MEO）サポート",
        "各種印刷物の相談サポート",
    ]
    for i, text in enumerate(items):
        col, row = i % 2, i // 2
        bx = 17 * mm + col * 91 * mm
        by = H - 176 * mm - row * 18 * mm
        draw_check(c, bx, by, text, 84 * mm, size=7.8)
    draw_wrapped(
        c,
        "予約システム・オンライン決済・カート機能などは、必要な機能に合わせて個別にお見積りします。",
        17 * mm,
        43 * mm,
        W - 34 * mm,
        size=7.4,
        leading=11,
        color=MUTED,
    )
    draw_text(c, f"※料金・条件は{DATA_DATE}時点の公開ホームページ表示を基準にしています。", 17 * mm, 28 * mm, size=6.4, color=MUTED)


def services_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "まるごと頼める制作メニュー", "04  SERVICES", page_no)
    services = [
        ("WEB", "ホームページ制作・運用", "構成、取材、撮影、文章、デザイン、公開、更新、アクセス解析。"),
        ("PRINT", "印刷デザイン", "名刺、ショップカード、チラシ、パンフレット、メニュー、ポスター。"),
        ("PHOTO", "写真・動画", "店舗、人物、商品、料理の出張撮影。動画撮影・編集も対応。"),
        ("BRAND", "ロゴ・ブランド統一", "ロゴ、看板、パッケージ、SNS画像まで一貫した世界観に。"),
        ("SYSTEM", "システム構築", "予約、オンライン決済、ネットショップなどの機能追加。"),
        ("AI", "AI活用サポート", "業務効率化、記事・SNS運用、画像・動画制作の活用支援。"),
    ]
    card_w = (W - 42 * mm) / 2
    top = H - 48 * mm
    for i, (tag, title, body) in enumerate(services):
        col, row = i % 2, i // 2
        x = 17 * mm + col * (card_w + 8 * mm)
        y = top - row * 55 * mm
        fill = ORANGE_LIGHT if i % 2 == 0 else GREEN_LIGHT
        accent = ORANGE if i % 2 == 0 else GREEN
        round_card(c, x, y - 47 * mm, card_w, 48 * mm, fill=fill, stroke=white, radius=6 * mm)
        draw_text(c, tag, x + 10 * mm, y - 13 * mm, font="ENX", size=7.5, color=accent)
        draw_text(c, title, x + 10 * mm, y - 26 * mm, size=11, color=INK)
        draw_wrapped(c, body, x + 10 * mm, y - 36 * mm, card_w - 20 * mm, size=7.6, leading=11, color=MUTED)
    draw_text(c, "ご相談から納品・公開まで", 17 * mm, 64 * mm, size=12, color=INK)
    steps = ["相談", "ヒアリング", "提案・見積り", "制作・確認", "納品・公開", "運用・改善"]
    step_w = (W - 34 * mm) / len(steps)
    for i, step in enumerate(steps):
        cx = 17 * mm + step_w * i + step_w / 2
        c.setFillColor(GREEN if i < 5 else ORANGE)
        c.circle(cx, 46 * mm, 5.5 * mm, fill=1, stroke=0)
        draw_text(c, str(i + 1), cx, 43.7 * mm, font="ENB", size=7.5, color=white, align="center")
        draw_text(c, step, cx, 32 * mm, size=6.8, color=INK, align="center")
        if i < len(steps) - 1:
            c.setStrokeColor(LINE)
            c.setLineWidth(1.2)
            c.line(cx + 7 * mm, 46 * mm, cx + step_w - 7 * mm, 46 * mm)


PRINT_PRICES = [
    ("名刺・ミニカード（〜91×55mm）", "片面", "5,000円〜"),
    ("名刺・ミニカード（〜91×55mm）", "両面", "10,000円〜"),
    ("名刺の情報差替え", "1点", "5,000円〜"),
    ("フライヤー・チラシ（〜A4）", "片面", "20,000円〜"),
    ("フライヤー・チラシ（〜A4）", "両面", "50,000円〜"),
    ("三つ折りパンフレット（〜A4）", "両面", "60,000円〜"),
    ("DM・ハガキ（〜A6）", "片面", "20,000円〜"),
    ("ポスター（A3〜）", "片面", "30,000円〜"),
    ("カタログ・パンフレット", "1頁", "30,000円〜"),
    ("飲食店用メニュー", "1頁", "30,000円〜"),
    ("ロゴデザイン", "1案", "20,000円〜"),
    ("出張撮影", "1時間", "15,000円〜"),
    ("看板デザイン", "1式", "50,000円〜"),
    ("のぼり旗デザイン", "1式", "30,000円〜"),
]


def print_price_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "印刷物・ロゴ・撮影の料金目安", "05  PRINT PRICE", page_no)
    x = 17 * mm
    table_w = W - 34 * mm
    col1, col2, col3 = 101 * mm, 27 * mm, table_w - 128 * mm
    top = H - 45 * mm
    row_h = 13.7 * mm
    c.setFillColor(GREEN)
    c.roundRect(x, top - row_h, table_w, row_h, 3 * mm, fill=1, stroke=0)
    draw_text(c, "制作内容", x + 5 * mm, top - 9 * mm, size=7.6, color=white)
    draw_text(c, "仕様", x + col1 + 4 * mm, top - 9 * mm, size=7.6, color=white)
    draw_text(c, "料金目安", x + table_w - 5 * mm, top - 9 * mm, size=7.6, color=white, align="right")
    for i, (label, unit, price) in enumerate(PRINT_PRICES):
        y = top - (i + 2) * row_h
        c.setFillColor(white if i % 2 == 0 else PALE_GREEN)
        c.rect(x, y, table_w, row_h, fill=1, stroke=0)
        c.setStrokeColor(LINE)
        c.setLineWidth(0.4)
        c.line(x, y, x + table_w, y)
        draw_text(c, label, x + 5 * mm, y + 4.8 * mm, size=7.2, color=INK)
        draw_text(c, unit, x + col1 + 4 * mm, y + 4.8 * mm, size=7, color=MUTED)
        draw_text(c, price, x + table_w - 5 * mm, y + 4.8 * mm, font="JP", size=7.4, color=ORANGE, align="right")
    note_y = top - (len(PRINT_PRICES) + 2) * row_h - 2 * mm
    draw_wrapped(
        c,
        "掲載料金は目安です。打合せ・企画設計・進行管理などを含みます。印刷費は部数・用紙・加工により別途。正式なお見積りは内容を伺ったうえでご案内します。",
        x,
        note_y,
        table_w,
        size=6.8,
        leading=10,
        color=MUTED,
    )


def voices_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "お客様の声と、成果につながる設計", "06  VOICE", page_no)
    voices = [
        (
            "音楽教室  ニコリミュージック",
            "新垣 里実 様",
            "「作って終わり」じゃなかった。毎年60件、問い合わせが続いています。",
            "ホームページとチラシの公開後、教室周辺だけでなく離れた地域からも問い合わせが入るように。2024年度は年間約60件、2025年10月から2026年3月までに45件の問い合わせ、そのうち34名が入会。",
            "60",
            "年間問い合わせ",
        ),
        (
            "旅行代理店  悠久の旅 沖縄",
            "代表 宇良 様",
            "「本能にぶっ刺さるチラシ」で即決契約。第2弾の受注まで生まれました。",
            "手書きラフからチラシとホームページへ。旅行の魅力を一目で伝えるデザインが即決契約につながり、好評を受けて第2弾の受注へ展開。",
            "2",
            "次の受注へ展開",
        ),
    ]
    top = H - 48 * mm
    for i, (company, name, quote, body, metric, metric_label) in enumerate(voices):
        y = top - i * 101 * mm
        round_card(c, 17 * mm, y - 89 * mm, W - 34 * mm, 90 * mm, fill=white, stroke=GREEN, radius=7 * mm, line_width=1.1)
        c.setFillColor(GREEN if i == 0 else ORANGE)
        c.roundRect(17 * mm, y - 17 * mm, W - 34 * mm, 18 * mm, 7 * mm, fill=1, stroke=0)
        c.rect(17 * mm, y - 17 * mm, W - 34 * mm, 7 * mm, fill=1, stroke=0)
        draw_text(c, company, 27 * mm, y - 11.5 * mm, size=9, color=white)
        draw_text(c, name, W - 27 * mm, y - 11.5 * mm, size=8, color=white, align="right")
        draw_wrapped(c, quote, 27 * mm, y - 32 * mm, 112 * mm, size=12, leading=17, color=INK)
        draw_wrapped(c, body, 27 * mm, y - 59 * mm, 116 * mm, size=7.3, leading=11, color=MUTED)
        c.setFillColor(ORANGE_LIGHT if i == 0 else GREEN_LIGHT)
        c.roundRect(W - 59 * mm, y - 73 * mm, 32 * mm, 42 * mm, 5 * mm, fill=1, stroke=0)
        draw_text(c, metric, W - 43 * mm, y - 53 * mm, font="ENX", size=26, color=ORANGE if i == 0 else GREEN, align="center")
        draw_text(c, "件" if i == 0 else "弾", W - 43 * mm, y - 61 * mm, size=6.5, color=MUTED, align="center")
        draw_text(c, metric_label, W - 43 * mm, y - 68 * mm, size=5.8, color=MUTED, align="center")
    draw_text(c, "※数値・コメントは添付原稿の掲載内容に基づきます。", 17 * mm, 24 * mm, size=6.2, color=MUTED)


def profile_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "制作するのは、こんな人です", "07  PROFILE", page_no)
    profile = ROOT / "images" / "profile_sns.webp"
    draw_image_cover(c, profile, 17 * mm, H - 125 * mm, 67 * mm, 67 * mm, radius=33.5 * mm)
    draw_text(c, "デザネコ代表", 94 * mm, H - 62 * mm, size=7.5, color=GREEN)
    draw_text(c, "比嘉 一茂", 94 * mm, H - 80 * mm, size=24, color=INK)
    draw_text(c, "ガーヒー @ デザインとネコ好き", 94 * mm, H - 91 * mm, size=8, color=ORANGE)
    draw_wrapped(
        c,
        "沖縄でデザイン・Web制作の現場に20年、約1,000件超の制作に携わってきた現場経験型Web制作者です。",
        94 * mm,
        H - 106 * mm,
        W - 111 * mm,
        size=8.5,
        leading=13,
    )
    c.setFillColor(PALE_GREEN)
    c.roundRect(17 * mm, H - 186 * mm, W - 34 * mm, 47 * mm, 6 * mm, fill=1, stroke=0)
    draw_text(c, "大切にしていること", 27 * mm, H - 155 * mm, size=10, color=GREEN)
    draw_wrapped(
        c,
        "大きな会社のような分業ではなく、想い・写真・文章・デザイン・公開後の改善まで、最初から最後まで同じ担当者が責任を持ちます。名刺1枚からホームページまで、人と人とをつなぐデザインを。",
        27 * mm,
        H - 168 * mm,
        W - 54 * mm,
        size=8.2,
        leading=12.4,
    )
    draw_text(c, "経歴・実績", 17 * mm, H - 204 * mm, size=12, color=INK)
    timeline = [
        ("1984", "沖縄県生まれ。20歳から独学でデザインを学ぶ"),
        ("広告", "広告代理店でスーパー・デパートのチラシや広告印刷物を担当"),
        ("飲食", "沖縄県内13店舗以上の飲食企業で、撮影・メニュー・販促物を一手に担当"),
        ("Web", "県内Web制作会社で、取材・撮影・デザイン・コーディング・文章を一貫担当"),
        ("現在", "Webと紙、AI活用まで横断して、小さなお店の発信と運用をサポート"),
    ]
    for i, (tag, body) in enumerate(timeline):
        y = H - 222 * mm - i * 14.5 * mm
        c.setFillColor(ORANGE if i == len(timeline) - 1 else GREEN)
        c.circle(23 * mm, y + 1.2 * mm, 2.2 * mm, fill=1, stroke=0)
        if i < len(timeline) - 1:
            c.setStrokeColor(LINE)
            c.line(23 * mm, y - 1.5 * mm, 23 * mm, y - 12 * mm)
        draw_text(c, tag, 30 * mm, y - 1.5 * mm, size=7.2, color=GREEN if i < len(timeline) - 1 else ORANGE)
        draw_text(c, body, 47 * mm, y - 1.5 * mm, size=7, color=INK)


def company_page(c: canvas.Canvas, page_no: int) -> None:
    page_header(c, "会社概要・よくあるご質問", "08  COMPANY", page_no)
    company_rows = [
        ("屋号", "デザネコ"),
        ("代表", "比嘉 一茂"),
        ("設立", "2015年"),
        ("所在地", "〒901-2226 沖縄県宜野湾市嘉数2-8-2"),
        ("事業内容", "印刷物／ロゴ／Web／写真・動画／AI画像／SNS運用"),
        ("取引銀行", "琉球銀行／沖縄銀行／楽天銀行"),
        ("支払方法", "PayPal、銀行振込、PayPayほか"),
    ]
    x, top, table_w = 17 * mm, H - 48 * mm, W - 34 * mm
    row_h = 14 * mm
    for i, (label, value) in enumerate(company_rows):
        y = top - (i + 1) * row_h
        c.setFillColor(PALE_GREEN if i % 2 else white)
        c.rect(x, y, table_w, row_h, fill=1, stroke=0)
        c.setStrokeColor(LINE)
        c.line(x, y, x + table_w, y)
        draw_text(c, label, x + 5 * mm, y + 5 * mm, size=7.4, color=GREEN)
        draw_text(c, value, x + 34 * mm, y + 5 * mm, size=7.3, color=INK)
    faq_top = top - (len(company_rows) + 1.5) * row_h
    draw_text(c, "よくあるご質問", 17 * mm, faq_top, size=12, color=INK)
    faqs = [
        ("制作費は本当に0円？", "ホームページ制作・運用プランは、公開中の料金表示で初期費用0円です。"),
        ("契約期間の縛りは？", "縛りなし。いつでも解約できます。"),
        ("写真や文章の準備は必要？", "取材・撮影・文章作成までサポートできます。"),
        ("印刷代も含まれる？", "デザイン料金とは別に、部数・用紙・加工に応じた印刷実費が必要です。"),
        ("遠方からでも依頼できる？", "オンライン打合せ・データ共有に対応しています。"),
        ("公開後の修正は？", "ホームページ制作・運用プランは更新対応回数無制限です。"),
    ]
    card_w = (W - 42 * mm) / 2
    for i, (qtext, answer) in enumerate(faqs):
        col, row = i % 2, i // 2
        bx = 17 * mm + col * (card_w + 8 * mm)
        by = faq_top - 14 * mm - row * 33 * mm
        round_card(c, bx, by - 26 * mm, card_w, 27 * mm, fill=PALE, stroke=LINE, radius=4 * mm)
        draw_text(c, "Q", bx + 7 * mm, by - 9 * mm, font="ENX", size=10, color=ORANGE)
        draw_text(c, qtext, bx + 15 * mm, by - 9 * mm, size=7.8, color=INK)
        draw_wrapped(c, answer, bx + 7 * mm, by - 17 * mm, card_w - 14 * mm, size=6.5, leading=9.2, color=MUTED, max_lines=2)


def print_works_pages(c: canvas.Canvas, works: list[dict[str, str]], start_page: int) -> int:
    chunks = [works[:14], works[14:28]]
    page_no = start_page
    for chunk_idx, chunk in enumerate(chunks):
        page_header(c, f"印刷物・販促物 制作事例 全{len(works)}件", "09  PRINT PORTFOLIO", page_no)
        draw_text(
            c,
            f"{chunk_idx * 14 + 1:02d} - {chunk_idx * 14 + len(chunk):02d}",
            W - 17 * mm,
            H - 39 * mm,
            font="ENB",
            size=7,
            color=MUTED,
            align="right",
        )
        card_w = (W - 42 * mm) / 2
        card_h = 31.5 * mm
        top = H - 47 * mm
        for i, work in enumerate(chunk):
            col, row = i % 2, i // 2
            x = 17 * mm + col * (card_w + 8 * mm)
            y = top - row * 33 * mm
            round_card(c, x, y - card_h, card_w, card_h, fill=white, stroke=LINE, radius=4 * mm)
            image_path = Path(work["local_image"])
            draw_image_cover(c, image_path, x + 2 * mm, y - card_h + 2 * mm, 31 * mm, card_h - 4 * mm, radius=2.5 * mm)
            draw_text(c, f"{chunk_idx * 14 + i + 1:02d}", x + 37 * mm, y - 8 * mm, font="ENX", size=6.5, color=ORANGE)
            size, lines = fit_lines(work["title"], "JP", 7.1, 5.8, card_w - 43 * mm, 5)
            yy = y - 15 * mm
            for line in lines:
                draw_text(c, line, x + 37 * mm, yy, size=size, color=INK)
                yy -= size * 1.45
        draw_text(c, f"出典：{PRINT_WORKS_URL}（{DATA_DATE}取得）", 17 * mm, 18 * mm, size=5.8, color=MUTED)
        new_page(c)
        page_no += 1
    return page_no


def website_overview_page(c: canvas.Canvas, web_works: list[dict[str, str]], page_no: int) -> None:
    page_header(c, f"ホームページ制作実績  掲載全{len(web_works):,}件", "10  WEB PORTFOLIO", page_no)
    counts = Counter(item["category"] for item in web_works)
    top_categories = counts.most_common(9)
    max_count = max(n for _, n in top_categories)
    draw_text(c, "業種別の掲載件数", 17 * mm, H - 48 * mm, size=11, color=INK)
    for i, (category, count) in enumerate(top_categories):
        y = H - 62 * mm - i * 10.5 * mm
        draw_text(c, category, 17 * mm, y, size=6.5, color=MUTED)
        bar_x = 53 * mm
        bar_w = 61 * mm * count / max_count
        c.setFillColor(GREEN_LIGHT)
        c.roundRect(bar_x, y - 1.5 * mm, 61 * mm, 4 * mm, 2 * mm, fill=1, stroke=0)
        c.setFillColor(GREEN)
        c.roundRect(bar_x, y - 1.5 * mm, bar_w, 4 * mm, 2 * mm, fill=1, stroke=0)
        draw_text(c, str(count), 118 * mm, y, font="ENB", size=6.7, color=GREEN, align="right")
    draw_wrapped(
        c,
        "飲食、医療、福祉、建設、不動産、教育、自動車、各種団体など、幅広い業種のWeb制作に携わっています。同一法人の別サイト・採用サイト・特設ページも、独立した制作実績として掲載しています。",
        130 * mm,
        H - 50 * mm,
        63 * mm,
        size=7.4,
        leading=11,
        color=INK,
    )
    draw_text(c, "代表制作サイト", 17 * mm, H - 169 * mm, size=11, color=INK)
    thumbs: list[tuple[dict[str, str], Path]] = []
    for item in web_works:
        safe = re.sub(r"[^A-Za-z0-9._-]", "_", item["url"]) + ".webp"
        path = ROOT / "images" / "web_design" / safe
        if path.exists():
            thumbs.append((item, path))
        if len(thumbs) == 12:
            break
    grid_x, grid_y = 17 * mm, H - 266 * mm
    gap = 3 * mm
    tw = (W - 34 * mm - gap * 3) / 4
    th = 28 * mm
    for i, (item, path) in enumerate(thumbs):
        col, row = i % 4, i // 4
        x = grid_x + col * (tw + gap)
        y = grid_y + (2 - row) * (th + 4 * mm)
        draw_image_cover(c, path, x, y, tw, th, radius=2 * mm)
        size, lines = fit_lines(item["name"], "JP", 5.8, 5.2, tw, 1)
        draw_text(c, lines[0], x, y - 2.8 * mm, size=size, color=MUTED)
    draw_text(c, f"全件一覧は次ページから掲載  |  出典：{WEB_WORKS_URL}", 17 * mm, 18 * mm, size=5.8, color=MUTED)


def web_appendix_pages(c: canvas.Canvas, web_works: list[dict[str, str]], start_page: int) -> int:
    per_page = 72
    chunks = [web_works[i : i + per_page] for i in range(0, len(web_works), per_page)]
    page_no = start_page
    for page_idx, chunk in enumerate(chunks):
        page_header(c, "ホームページ制作実績 会社名一覧", "APPENDIX  |  ALL WEB WORKS", page_no)
        start_num = page_idx * per_page + 1
        end_num = start_num + len(chunk) - 1
        draw_text(c, f"{start_num:03d} - {end_num:03d} / {len(web_works):03d}", W - 17 * mm, H - 39 * mm, font="ENB", size=7, color=MUTED, align="right")
        col_w = (W - 38 * mm) / 3
        row_h = 9.05 * mm
        top = H - 46 * mm
        for i, item in enumerate(chunk):
            col = i // 24
            row = i % 24
            x = 17 * mm + col * (col_w + 2 * mm)
            y_top = top - row * row_h
            c.setFillColor(PALE if row % 2 == 0 else white)
            c.roundRect(x, y_top - row_h + 0.4 * mm, col_w, row_h - 0.8 * mm, 1.2 * mm, fill=1, stroke=0)
            number = start_num + i
            draw_text(c, f"{number:03d}", x + 2 * mm, y_top - 3.1 * mm, font="ENB", size=5.5, color=ORANGE)
            category = item["category"]
            cat_size, cat_lines = fit_lines(category, "JP", 5.2, 4.6, col_w - 14 * mm, 1)
            draw_text(c, cat_lines[0], x + 11 * mm, y_top - 3.1 * mm, size=cat_size, color=GREEN)
            name_size, name_lines = fit_lines(item["name"], "JP", 6.8, 5.7, col_w - 6 * mm, 2)
            yy = y_top - 6.4 * mm
            for line in name_lines:
                draw_text(c, line, x + 2 * mm, yy, size=name_size, color=INK)
                yy -= name_size * 1.15
        draw_text(c, "※同一法人の別サイト・特設ページ・採用サイト等を含む掲載全件です。", 17 * mm, 18 * mm, size=5.6, color=MUTED)
        new_page(c)
        page_no += 1
    return page_no


def back_cover(c: canvas.Canvas, page_no: int) -> None:
    c.setFillColor(PALE_GREEN)
    c.rect(0, 0, W, H, fill=1, stroke=0)
    c.setFillColor(GREEN)
    c.rect(0, H - 78 * mm, W, 78 * mm, fill=1, stroke=0)
    c.drawImage(str(ROOT / "images" / "logo.png"), 17 * mm, H - 54 * mm, 64 * mm, 28 * mm, preserveAspectRatio=True, mask="auto")
    draw_text(c, "まずは、無料相談から。", 17 * mm, H - 100 * mm, size=24, color=INK)
    draw_wrapped(
        c,
        "まだ内容がまとまっていなくても大丈夫です。状況整理から一緒に進めます。",
        17 * mm,
        H - 115 * mm,
        W - 34 * mm,
        size=9.5,
        leading=14,
        color=MUTED,
    )
    card_w = (W - 42 * mm) / 2
    left_x, right_x = 17 * mm, 17 * mm + card_w + 8 * mm
    round_card(c, left_x, 79 * mm, card_w, 91 * mm, fill=white, stroke=GREEN, radius=7 * mm, line_width=1.1)
    round_card(c, right_x, 79 * mm, card_w, 91 * mm, fill=white, stroke=ORANGE, radius=7 * mm, line_width=1.1)
    draw_text(c, "LINE", left_x + 10 * mm, 154 * mm, font="ENX", size=11, color=GREEN)
    draw_text(c, "公式LINEで相談", left_x + 10 * mm, 143 * mm, size=9, color=INK)
    draw_qr(c, LINE_URL, left_x + 10 * mm, 92 * mm, 43 * mm)
    draw_text(c, "ID  @quy1014b", left_x + 58 * mm, 113 * mm, font="ENB", size=7, color=MUTED)
    draw_text(c, "CONTACT", right_x + 10 * mm, 154 * mm, font="ENX", size=11, color=ORANGE)
    draw_text(c, "お問い合わせフォーム", right_x + 10 * mm, 143 * mm, size=9, color=INK)
    draw_qr(c, CONTACT_URL, right_x + 10 * mm, 92 * mm, 43 * mm)
    draw_text(c, "d-neko.com/contact.php", right_x + 58 * mm, 113 * mm, font="ENB", size=6.2, color=MUTED)
    c.setFillColor(ORANGE)
    c.roundRect(17 * mm, 49 * mm, W - 34 * mm, 18 * mm, 9 * mm, fill=1, stroke=0)
    draw_text(c, "TEL  090-2964-1664     MAIL  info@d-neko.com", W / 2, 55 * mm, font="JP", size=9.5, color=white, align="center")
    draw_text(c, "デザネコ（デザインのネコの手）", 17 * mm, 35 * mm, size=7.5, color=INK)
    draw_text(c, "〒901-2226 沖縄県宜野湾市嘉数2-8-2", 17 * mm, 25 * mm, size=6.8, color=MUTED)
    draw_text(c, HOME_URL, W - 17 * mm, 25 * mm, font="ENB", size=7, color=GREEN, align="right")
    draw_text(c, f"{page_no:02d}", W - 17 * mm, 10 * mm, font="ENB", size=7, color=GREEN, align="right")


def build_pdf() -> None:
    OUT_DIR.mkdir(parents=True, exist_ok=True)
    TMP_DIR.mkdir(parents=True, exist_ok=True)
    register_fonts()
    web_works = load_web_works()
    print_works = load_print_works()
    if len(web_works) != 789:
        raise RuntimeError(f"Expected 789 web works, found {len(web_works)}")
    if len(print_works) < 27:
        raise RuntimeError(f"Expected at least 27 print works, found {len(print_works)}")
    print_works = print_works[:27]
    download_print_images(print_works)

    c = canvas.Canvas(str(OUT_PDF), pagesize=A4, pageCompression=1)
    c.setTitle("デザネコ 営業資料 2026")
    c.setAuthor("デザネコ")
    c.setSubject("ホームページ・印刷デザイン 営業資料")
    c.setKeywords("デザネコ, ホームページ制作, チラシ, 印刷デザイン, 沖縄")

    cover_page(c, len(web_works), len(print_works))
    new_page(c)
    challenges_page(c, 2)
    new_page(c)
    plan_page(c, 3)
    new_page(c)
    price_page(c, 4)
    new_page(c)
    services_page(c, 5)
    new_page(c)
    print_price_page(c, 6)
    new_page(c)
    voices_page(c, 7)
    new_page(c)
    profile_page(c, 8)
    new_page(c)
    company_page(c, 9)
    new_page(c)
    next_page = print_works_pages(c, print_works, 10)
    website_overview_page(c, web_works, next_page)
    new_page(c)
    next_page += 1
    next_page = web_appendix_pages(c, web_works, next_page)
    back_cover(c, next_page)
    c.save()
    print(f"WROTE {OUT_PDF}")
    print(f"WEB_WORKS {len(web_works)}")
    print(f"PRINT_WORKS {len(print_works)}")
    print(f"LAST_PAGE {next_page}")


if __name__ == "__main__":
    build_pdf()
