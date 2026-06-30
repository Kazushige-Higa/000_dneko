/**
 * visitor_tracker.js — 個別訪問者行動トラッキング
 *
 * ・Cookie ID を発行/読み込み（有効期限 90日）
 * ・ページ閲覧・スクロール深度・滞在時間・CTAクリックを検知
 * ・/visitor_tracker.php へ POST して熱量スコアを更新
 */

(function () {
  'use strict';

  /* ---- 設定 ---- */
  const API_URL     = '/visitor_tracker.php';
  const COOKIE_NAME = 'dneko_vid';
  const COOKIE_DAYS = 90;

  /* ---- analyticsページは計測しない ---- */
  if (location.pathname.startsWith('/analytics')) return;

  /* ================================================================
   * Cookie ユーティリティ
   * ================================================================ */
  function getCookie(name) {
    const match = document.cookie.match(new RegExp('(?:^|; )' + name + '=([^;]*)'));
    return match ? decodeURIComponent(match[1]) : null;
  }

  function setCookie(name, value, days) {
    const expires = new Date(Date.now() + days * 864e5).toUTCString();
    document.cookie = name + '=' + encodeURIComponent(value)
      + '; expires=' + expires
      + '; path=/; SameSite=Lax';
  }

  function generateId() {
    return 'v-' + Date.now().toString(36) + '-' + Math.random().toString(36).slice(2, 9);
  }

  /* ---- 訪問者ID取得 or 発行 ---- */
  let visitorId = getCookie(COOKIE_NAME);
  if (!visitorId) {
    visitorId = generateId();
    setCookie(COOKIE_NAME, visitorId, COOKIE_DAYS);
  } else {
    // 有効期限を延長
    setCookie(COOKIE_NAME, visitorId, COOKIE_DAYS);
  }

  /* ================================================================
   * イベント送信
   * ================================================================ */
  function send(event) {
    const payload = {
      visitor_id: visitorId,
      event:      event,
      page:       location.pathname,
    };
    // Beacon API（ページ離脱時も確実に送信）
    if (navigator.sendBeacon) {
      navigator.sendBeacon(API_URL, JSON.stringify(payload));
    } else {
      fetch(API_URL, {
        method:  'POST',
        headers: { 'Content-Type': 'application/json' },
        body:    JSON.stringify(payload),
        keepalive: true,
      }).catch(() => {});
    }
  }

  /* ================================================================
   * ページ種別を判定してイベントを発火
   * ================================================================ */
  const path = location.pathname;

  function detectPageType() {
    if (/\/(service_design|service_blog|works)/.test(path)) return 'service_page';
    if (/\/voice/.test(path))   return 'voice_page';
    if (/\/law/.test(path))     return 'law_page';
    if (/\/profile/.test(path)) return 'profile_page';
    if (/\/entry/.test(path))   return 'works_page';
    return null;
  }

  /* ---- ページ閲覧（基本 +1） ---- */
  send('pageview');

  /* ---- ページ種別ボーナス ---- */
  const pageType = detectPageType();
  if (pageType) send(pageType);

  /* ================================================================
   * スクロール深度
   * ================================================================ */
  let scrollSent50 = false;
  let scrollSent90 = false;

  function onScroll() {
    const el       = document.documentElement;
    const scrolled  = el.scrollTop + window.innerHeight;
    const total     = el.scrollHeight;
    if (total <= 0) return;
    const pct = (scrolled / total) * 100;

    if (!scrollSent50 && pct >= 50) { scrollSent50 = true; send('scroll_50'); }
    if (!scrollSent90 && pct >= 90) { scrollSent90 = true; send('scroll_90'); }
  }

  window.addEventListener('scroll', onScroll, { passive: true });

  /* ================================================================
   * 滞在時間
   * ================================================================ */
  let stay60Sent  = false;
  let stay120Sent = false;

  setTimeout(function () {
    if (!stay60Sent)  { stay60Sent  = true; send('stay_60');  }
  }, 60000);

  setTimeout(function () {
    if (!stay120Sent) { stay120Sent = true; send('stay_120'); }
  }, 120000);

  /* ================================================================
   * CTAクリック
   * ================================================================ */
  document.addEventListener('click', function (e) {
    const el = e.target.closest('a, button');
    if (!el) return;

    const href = el.href || '';
    const text = (el.textContent || '').trim();

    // LINE クリック
    if (/line\.me|lin\.ee/.test(href) || /LINE/.test(text)) {
      send('line_click');
      return;
    }

    // お問い合わせクリック
    if (/contact|form|お問い合わせ|相談/.test(href + text)) {
      send('contact_click');
      return;
    }
  }, true);

})();
