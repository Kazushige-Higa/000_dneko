<?php /* GA4 アクセス解析ダッシュボード */ ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>アクセス解析ダッシュボード | デザネコ</title>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-T46Y45V5X6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', 'G-T46Y45V5X6');
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body {
  font-family: -apple-system, BlinkMacSystemFont, "Hiragino Sans", "Yu Gothic", "Meiryo", sans-serif;
  background: #f1f5f9; color: #0f172a; line-height: 1.6; padding: 24px;
}
.container { max-width: 1400px; margin: 0 auto; }

/* ── Header ── */
.dashboard-header {
  background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
  color: #fff; padding: 28px 36px; border-radius: 16px;
  margin-bottom: 24px; box-shadow: 0 10px 30px rgba(79,70,229,.2);
}
.dashboard-header h1 { font-size: 22px; font-weight: 700; margin-bottom: 6px; }
.header-meta { display: flex; gap: 20px; flex-wrap: wrap; font-size: 13px; opacity: .9; }
.header-actions { margin-top: 14px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.refresh-btn {
  padding: 6px 16px; border-radius: 999px; background: rgba(255,255,255,.15);
  color: #fff; border: 1px solid rgba(255,255,255,.3); font-size: 13px; cursor: pointer;
}
.refresh-btn:hover { background: rgba(255,255,255,.25); }

/* ── KPI Cards ── */
.kpi-grid { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 24px; }
.kpi-card {
  background: #fff; padding: 22px; border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.06); border-top: 3px solid transparent;
}
.kpi-card.pv     { border-top-color: #4f46e5; }
.kpi-card.users  { border-top-color: #06b6d4; }
.kpi-card.cvr    { border-top-color: #10b981; }
.kpi-card.time   { border-top-color: #f59e0b; }
.kpi-label { font-size: 11px; color: #64748b; font-weight: 700; letter-spacing: .06em; text-transform: uppercase; }
.kpi-value { font-size: 28px; font-weight: 700; margin: 5px 0 4px; }
.kpi-change { font-size: 12px; font-weight: 600; }
.kpi-change.up   { color: #10b981; }
.kpi-change.down { color: #ef4444; }

/* ── Grid layouts ── */
.grid-2       { display: grid; grid-template-columns: 2fr 1fr; gap: 16px; margin-bottom: 16px; }
.grid-2-equal { display: grid; grid-template-columns: 1fr 1fr;  gap: 16px; margin-bottom: 16px; }
.grid-3       { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-bottom: 16px; }
.grid-4       { display: grid; grid-template-columns: repeat(4,1fr); gap: 16px; margin-bottom: 16px; }
.mb16 { margin-bottom: 16px; }

/* ── Panel ── */
.panel {
  background: #fff; padding: 22px; border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0,0,0,.06);
}
.panel-head {
  display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;
}
.panel h2 {
  font-size: 14px; font-weight: 700; color: #0f172a;
  display: flex; align-items: center; gap: 8px; margin-bottom: 0;
}
.panel h2::before {
  content: ""; width: 3px; height: 14px; background: #4f46e5; border-radius: 2px; flex-shrink: 0;
}
.chart-wrap { position: relative; height: 260px; }
.chart-wrap.sm { height: 200px; }

/* ── Period tabs ── */
.tab-group { display: flex; gap: 4px; }
.tab-btn {
  padding: 4px 12px; border-radius: 999px; background: #f1f5f9;
  color: #64748b; border: none; font-size: 12px; cursor: pointer; font-weight: 500;
}
.tab-btn.active { background: #4f46e5; color: #fff; }

/* ── Source list ── */
.source-list { margin-top: 12px; display: flex; flex-direction: column; gap: 7px; }
.source-item { display: flex; justify-content: space-between; align-items: center; font-size: 13px; }
.source-label { display: flex; align-items: center; gap: 7px; color: #334155; }
.source-dot { width: 9px; height: 9px; border-radius: 50%; flex-shrink: 0; }
.source-val { font-weight: 600; color: #0f172a; }
.source-pct { color: #94a3b8; font-weight: 400; font-size: 12px; }

/* ── Tables ── */
table { width: 100%; border-collapse: collapse; font-size: 13px; }
th, td { text-align: left; padding: 9px 8px; border-bottom: 1px solid #e2e8f0; }
th { font-size: 11px; color: #64748b; font-weight: 700; letter-spacing: .05em; white-space: nowrap; }
td.num { text-align: right; font-variant-numeric: tabular-nums; font-weight: 500; }
td.rank { width: 28px; color: #94a3b8; font-weight: 700; }
tr:hover td { background: #f8fafc; }
.path { color: #475569; font-family: "SF Mono", Menlo, monospace; font-size: 11px; }
.page-title { font-weight: 500; color: #0f172a; font-size: 13px; }

/* ── Engagement bar (inline) ── */
.bar-cell { min-width: 80px; }
.inline-bar { display: flex; align-items: center; gap: 6px; }
.inline-bar-bg { flex: 1; background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; min-width: 40px; }
.inline-bar-fill { height: 100%; border-radius: 3px; }
.bar-val { font-size: 12px; font-weight: 600; min-width: 36px; text-align: right; }

/* ── Region bars ── */
.region-list { display: flex; flex-direction: column; gap: 9px; }
.region-item { display: grid; grid-template-columns: 80px 1fr 50px; align-items: center; gap: 10px; font-size: 13px; }
.region-bar-bg { background: #e2e8f0; height: 8px; border-radius: 4px; overflow: hidden; }
.region-bar { background: linear-gradient(90deg, #4f46e5, #7c3aed); height: 100%; border-radius: 4px; }
.region-count { text-align: right; color: #64748b; font-variant-numeric: tabular-nums; }

/* ── Event list ── */
.event-list { display: flex; flex-direction: column; gap: 8px; }
.event-item { display: grid; grid-template-columns: 1fr 120px 56px; align-items: center; gap: 8px; font-size: 13px; }
.event-name { color: #334155; font-family: "SF Mono", Menlo, monospace; font-size: 12px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
.event-bar-bg { background: #e2e8f0; height: 6px; border-radius: 3px; overflow: hidden; }
.event-bar-fill { background: #7c3aed; height: 100%; border-radius: 3px; }
.event-count { text-align: right; font-weight: 600; font-variant-numeric: tabular-nums; color: #0f172a; }

/* ── Notes ── */
.note { font-size: 11px; color: #94a3b8; margin-top: 10px; line-height: 1.6; }
.no-data { color: #94a3b8; font-size: 13px; padding: 16px 0; text-align: center; }

/* ── Footer ── */
.dashboard-footer { text-align: center; color: #94a3b8; font-size: 12px; margin-top: 24px; padding: 16px; }

/* ── Responsive ── */
@media (max-width: 1100px) {
  .grid-4 { grid-template-columns: repeat(2,1fr); }
}
@media (max-width: 960px) {
  .kpi-grid { grid-template-columns: repeat(2,1fr); }
  .grid-2, .grid-2-equal, .grid-3 { grid-template-columns: 1fr; }
}
@media (max-width: 560px) {
  body { padding: 12px; }
  .kpi-grid, .grid-4 { grid-template-columns: 1fr; }
  .dashboard-header { padding: 20px; }
  .dashboard-header h1 { font-size: 18px; }
}
</style>
</head>
<body>
<div class="container">

<!-- ── Header ── -->
<div class="dashboard-header">
  <h1>アクセス解析ダッシュボード</h1>
  <div class="header-meta">
    <span>対象サイト: デザネコ (d-neko.com)</span>
    <span id="lastUpdated">最終更新: 取得中…</span>
    <span>データソース: Google Analytics 4</span>
  </div>
  <div class="header-actions">
    <button class="refresh-btn" onclick="forceRefresh()">↺ 最新データを取得</button>
  </div>
</div>

<!-- ── KPI Cards ── -->
<div class="kpi-grid">
  <div class="kpi-card pv">
    <div class="kpi-label">ページビュー (PV)</div>
    <div class="kpi-value" id="kpiPv">–</div>
    <div class="kpi-change" id="kpiPvChange"></div>
  </div>
  <div class="kpi-card users">
    <div class="kpi-label">ユーザー数 (UU)</div>
    <div class="kpi-value" id="kpiUsers">–</div>
    <div class="kpi-change" id="kpiUsersChange"></div>
  </div>
  <div class="kpi-card cvr">
    <div class="kpi-label">コンバージョン率</div>
    <div class="kpi-value" id="kpiCvr">–</div>
    <div class="kpi-change" id="kpiCvrChange"></div>
  </div>
  <div class="kpi-card time">
    <div class="kpi-label">平均エンゲージメント時間</div>
    <div class="kpi-value" id="kpiEng">–</div>
    <div class="kpi-change" id="kpiEngChange"></div>
  </div>
</div>

<!-- ── PV推移 + 流入元 ── -->
<div class="grid-2">
  <div class="panel">
    <div class="panel-head">
      <h2>ページビュー推移</h2>
      <div class="tab-group">
        <button class="tab-btn active" data-period="daily"   onclick="switchPeriod(this)">日別</button>
        <button class="tab-btn"        data-period="weekly"  onclick="switchPeriod(this)">週別</button>
        <button class="tab-btn"        data-period="monthly" onclick="switchPeriod(this)">月別</button>
      </div>
    </div>
    <div class="chart-wrap"><canvas id="pvTrendChart"></canvas></div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>流入元</h2></div>
    <div class="chart-wrap sm"><canvas id="sourceChart"></canvas></div>
    <div class="source-list" id="sourceList"></div>
  </div>
</div>

<!-- ── 男女比 / 年齢 / デバイス / 新規vsリピーター ── -->
<div class="grid-4">
  <div class="panel">
    <div class="panel-head"><h2>男女比</h2></div>
    <div class="chart-wrap sm"><canvas id="genderChart"></canvas></div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>年齢層</h2></div>
    <div class="chart-wrap sm"><canvas id="ageChart"></canvas></div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>デバイス比率</h2></div>
    <div class="chart-wrap sm"><canvas id="deviceChart"></canvas></div>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>新規 vs リピーター</h2></div>
    <div class="chart-wrap sm"><canvas id="nvrChart"></canvas></div>
  </div>
</div>

<!-- ── ページ別パフォーマンス ── -->
<div class="panel mb16">
  <div class="panel-head"><h2>ページ別パフォーマンス（過去30日 TOP10）</h2></div>
  <table>
    <thead>
      <tr>
        <th style="width:28px"></th>
        <th>ページ</th>
        <th style="text-align:right;width:60px">PV</th>
        <th style="width:140px">エンゲージメント率</th>
        <th style="width:120px">直帰率</th>
        <th style="text-align:right;width:110px">平均エンゲージ時間</th>
      </tr>
    </thead>
    <tbody id="pageMetricsBody"></tbody>
  </table>
  <p class="note">※ GA4の直帰率 = エンゲージメントセッション以外の割合（10秒未満 / CV無し / 1ページのみ閲覧）。UAの直帰率とは定義が異なります。<br>※ 平均エンゲージ時間 = そのページでのユーザーエンゲージメント時間 ÷ PV数</p>
</div>

<!-- ── 流入元×コンバージョン + イベント別集計 ── -->
<div class="grid-2-equal">
  <div class="panel">
    <div class="panel-head"><h2>流入元 × コンバージョン</h2></div>
    <table>
      <thead>
        <tr>
          <th>流入元</th>
          <th style="text-align:right">セッション</th>
          <th style="text-align:right">CV数</th>
          <th style="text-align:right">CVR</th>
        </tr>
      </thead>
      <tbody id="sourceConvBody"></tbody>
    </table>
    <p class="note">※ コンバージョンはGA4プロパティで設定したキーイベントの合計件数です。</p>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>イベント別集計（TOP15）</h2></div>
    <div class="event-list" id="eventList"></div>
  </div>
</div>

<!-- ── 検索キーワード + オーガニックランディング ── -->
<div class="grid-2-equal">
  <div class="panel">
    <div class="panel-head"><h2>検索キーワード（サイト内検索）</h2></div>
    <div id="keywordsSection"></div>
    <p class="note">※ オーガニック検索キーワード（Googleで何を検索してアクセスしたか）はGoogleのプライバシー保護により取得不可です。外部キーワードは <strong>Google Search Console</strong> で確認できます。</p>
  </div>
  <div class="panel">
    <div class="panel-head"><h2>検索流入のランディングページ TOP10</h2></div>
    <table>
      <thead><tr><th></th><th>ページ</th><th style="text-align:right">セッション</th></tr></thead>
      <tbody id="organicLandingBody"></tbody>
    </table>
    <p class="note">※ オーガニック検索から最初に訪れたページ一覧。どのページが検索流入を受けているかが分かります。</p>
  </div>
</div>

<!-- ── 地域別アクセス ── -->
<div class="panel mb16">
  <div class="panel-head"><h2>地域別アクセス（都道府県 TOP10 ／ 日本国内）</h2></div>
  <div class="region-list" id="regionList"></div>
</div>

<!-- ── Footer ── -->
<div class="dashboard-footer">
  <span id="footerNote">Google Analytics 4 Data API から取得した実データを表示しています（過去30日間）。</span>
</div>

</div><!-- /container -->

<script>
/* ===== Chart.js グローバル設定 ===== */
Chart.defaults.font.family = '-apple-system, BlinkMacSystemFont, "Hiragino Sans", "Yu Gothic", sans-serif';
Chart.defaults.font.size   = 12;
Chart.defaults.color       = '#475569';

const PALETTE = ['#4f46e5','#06b6d4','#10b981','#f59e0b','#ef4444','#a78bfa','#ec4899','#84cc16'];
const charts  = {};
let trendCache = {};

/* ===== ユーティリティ ===== */
function fmtInt(n) { return Number(n || 0).toLocaleString(); }
function fmtDuration(sec) {
  sec = Math.round(Number(sec) || 0);
  const m = Math.floor(sec / 60), s = sec % 60;
  return m > 0 ? m + '分' + s + '秒' : s + '秒';
}
function setChange(el, change, unit, isPoint) {
  if (change === null || change === undefined || isNaN(change)) {
    el.textContent = '前月データなし'; el.className = 'kpi-change'; return;
  }
  const up = change >= 0;
  el.textContent = (up ? '▲ ' : '▼ ') + Math.abs(change) + (isPoint ? 'pt' : (unit || '%')) + '（前月比）';
  el.className = 'kpi-change ' + (up ? 'up' : 'down');
}
function escapeHtml(s) {
  return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
}

/* ===== 期間切り替え ===== */
function switchPeriod(btn) {
  document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
  btn.classList.add('active');
  const period = btn.dataset.period;
  const d = trendCache[period];
  if (d) drawLine('pvTrendChart', d.labels, d.data);
}

/* ===== データ反映 ===== */
function render(d) {
  /* KPI */
  document.getElementById('kpiPv').textContent    = fmtInt(d.kpi.pv.value);
  setChange(document.getElementById('kpiPvChange'), d.kpi.pv.change);
  document.getElementById('kpiUsers').textContent = fmtInt(d.kpi.users.value);
  setChange(document.getElementById('kpiUsersChange'), d.kpi.users.change);
  document.getElementById('kpiCvr').textContent   = (d.kpi.cvr.value ?? 0) + '%';
  setChange(document.getElementById('kpiCvrChange'), d.kpi.cvr.change, null, true);
  document.getElementById('kpiEng').textContent   = fmtDuration(d.kpi.engagement.seconds);
  setChange(document.getElementById('kpiEngChange'), d.kpi.engagement.change);

  /* 最終更新日時 */
  if (d.generated_at) {
    const dt = new Date(d.generated_at);
    document.getElementById('lastUpdated').textContent =
      '最終更新: ' + dt.toLocaleString('ja-JP', {year:'numeric',month:'long',day:'numeric',hour:'2-digit',minute:'2-digit'});
  }
  if (d.stale) {
    document.getElementById('footerNote').textContent = '※ 最新の取得に失敗したため、前回取得データを表示しています。';
  }

  /* PV推移 (日別/週別/月別) */
  trendCache = {
    daily:   d.trend   || {labels:[],data:[]},
    weekly:  d.weekly  || {labels:[],data:[]},
    monthly: d.monthly || {labels:[],data:[]},
  };
  drawLine('pvTrendChart', trendCache.daily.labels, trendCache.daily.data);

  /* 流入元 */
  drawDonut('sourceChart', d.source.labels, d.source.data, PALETTE, '55%');
  drawSourceList(d.source);

  /* 男女比 */
  const gColors = d.gender.labels.map(l => l === '女性' ? '#ec4899' : '#3b82f6');
  drawDonut('genderChart', d.gender.labels, d.gender.data, gColors, '65%');

  /* 年齢層 */
  drawBar('ageChart', d.age.labels, d.age.data, '#7c3aed');

  /* デバイス */
  drawDonut('deviceChart', d.device.labels, d.device.data, PALETTE, '65%');

  /* 新規vsリピーター */
  drawDonut('nvrChart', (d.new_vs_returning||{}).labels||[], (d.new_vs_returning||{}).data||[],
    ['#4f46e5','#06b6d4'], '65%');

  /* ページ別パフォーマンス */
  drawPageMetrics(d.page_metrics || []);

  /* 流入元×コンバージョン */
  drawSourceConv(d.source_conv || []);

  /* イベント */
  drawEvents(d.events || []);

  /* 検索キーワード */
  drawKeywords(d.keywords || []);

  /* オーガニックランディング */
  drawOrganicLanding(d.organic_landing || []);

  /* 地域 */
  drawRegions(d.region || []);
}

/* ===== グラフ描画 ===== */
function drawLine(id, labels, data) {
  if (charts[id]) charts[id].destroy();
  charts[id] = new Chart(document.getElementById(id), {
    type: 'line',
    data: { labels, datasets: [{
      label: 'PV', data,
      borderColor: '#4f46e5', backgroundColor: 'rgba(79,70,229,.1)',
      fill: true, tension: 0.35, pointRadius: 2, pointHoverRadius: 5, borderWidth: 2.5,
    }]},
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { color: '#e2e8f0' } },
        x: { grid: { display: false }, ticks: { maxTicksLimit: 12 } },
      },
    },
  });
}

function drawDonut(id, labels, data, colors, cutout) {
  if (charts[id]) charts[id].destroy();
  if (!labels || !labels.length) {
    const ctx = document.getElementById(id);
    if (ctx) { const c = ctx.getContext('2d'); c.clearRect(0,0,ctx.width,ctx.height); }
    return;
  }
  charts[id] = new Chart(document.getElementById(id), {
    type: 'doughnut',
    data: { labels, datasets: [{ data, backgroundColor: colors, borderWidth: 0 }] },
    options: {
      responsive: true, maintainAspectRatio: false, cutout,
      plugins: { legend: { position: 'bottom', labels: { boxWidth: 11, padding: 8 } } },
    },
  });
}

function drawBar(id, labels, data, color) {
  if (charts[id]) charts[id].destroy();
  charts[id] = new Chart(document.getElementById(id), {
    type: 'bar',
    data: { labels, datasets: [{ data, backgroundColor: color || '#4f46e5', borderRadius: 5 }] },
    options: {
      responsive: true, maintainAspectRatio: false,
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, grid: { color: '#e2e8f0' } },
        x: { grid: { display: false } },
      },
    },
  });
}

function drawSourceList(source) {
  const el = document.getElementById('sourceList');
  if (!el) return;
  el.innerHTML = '';
  const total = (source.data || []).reduce((a,b) => a+b, 0) || 1;
  (source.labels || []).forEach((label, i) => {
    const count = source.data[i] || 0;
    const pct = (count / total * 100).toFixed(1);
    const item = document.createElement('div');
    item.className = 'source-item';
    item.innerHTML = `
      <span class="source-label">
        <span class="source-dot" style="background:${PALETTE[i % PALETTE.length]}"></span>
        ${escapeHtml(label)}
      </span>
      <span class="source-val">${fmtInt(count)} <span class="source-pct">(${pct}%)</span></span>`;
    el.appendChild(item);
  });
}

function drawPageMetrics(items) {
  const tbody = document.getElementById('pageMetricsBody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!items.length) {
    tbody.innerHTML = '<tr><td colspan="6" class="no-data">データがありません</td></tr>'; return;
  }
  items.forEach((p, i) => {
    const engColor  = p.engagement >= 70 ? '#10b981' : p.engagement >= 40 ? '#f59e0b' : '#ef4444';
    const bounceColor = p.bounce <= 30 ? '#10b981' : p.bounce <= 60 ? '#f59e0b' : '#ef4444';
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td class="rank">${i + 1}</td>
      <td>
        <div class="page-title">${escapeHtml(p.title)}</div>
        <div class="path">${escapeHtml(p.path)}</div>
      </td>
      <td class="num">${fmtInt(p.pv)}</td>
      <td class="bar-cell">
        <div class="inline-bar">
          <div class="inline-bar-bg">
            <div class="inline-bar-fill" style="width:${Math.min(p.engagement,100)}%;background:${engColor}"></div>
          </div>
          <span class="bar-val" style="color:${engColor}">${p.engagement}%</span>
        </div>
      </td>
      <td class="bar-cell">
        <div class="inline-bar">
          <div class="inline-bar-bg">
            <div class="inline-bar-fill" style="width:${Math.min(p.bounce,100)}%;background:${bounceColor}"></div>
          </div>
          <span class="bar-val" style="color:${bounceColor}">${p.bounce}%</span>
        </div>
      </td>
      <td class="num">${fmtDuration(p.avg_time)}</td>`;
    tbody.appendChild(tr);
  });
}

function drawSourceConv(items) {
  const tbody = document.getElementById('sourceConvBody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!items.length) {
    tbody.innerHTML = '<tr><td colspan="4" class="no-data">データがありません</td></tr>'; return;
  }
  items.forEach(item => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${escapeHtml(item.channel)}</td>
      <td class="num">${fmtInt(item.sessions)}</td>
      <td class="num">${fmtInt(item.conversions)}</td>
      <td class="num">${item.cvr}%</td>`;
    tbody.appendChild(tr);
  });
}

function drawEvents(items) {
  const el = document.getElementById('eventList');
  if (!el) return;
  el.innerHTML = '';
  if (!items.length) { el.innerHTML = '<p class="no-data">イベントデータがありません</p>'; return; }
  const max = Math.max(...items.map(e => e.count), 1);
  items.forEach(item => {
    const pct = (item.count / max * 100).toFixed(1);
    const div = document.createElement('div');
    div.className = 'event-item';
    div.innerHTML = `
      <span class="event-name" title="${escapeHtml(item.name)}">${escapeHtml(item.name)}</span>
      <div class="event-bar-bg">
        <div class="event-bar-fill" style="width:${pct}%"></div>
      </div>
      <span class="event-count">${fmtInt(item.count)}</span>`;
    el.appendChild(div);
  });
}

function drawKeywords(keywords) {
  const el = document.getElementById('keywordsSection');
  if (!el) return;
  if (!keywords.length) {
    el.innerHTML = '<p class="no-data">サイト内検索のデータがありません。<br>GA4でサイト内検索の計測を設定すると表示されます。</p>';
    return;
  }
  const table = document.createElement('table');
  table.innerHTML = '<thead><tr><th></th><th>キーワード</th><th style="text-align:right">セッション</th></tr></thead>';
  const tbody = document.createElement('tbody');
  keywords.forEach((k, i) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `<td class="rank">${i+1}</td><td>${escapeHtml(k.term)}</td><td class="num">${fmtInt(k.sessions)}</td>`;
    tbody.appendChild(tr);
  });
  table.appendChild(tbody);
  el.appendChild(table);
}

function drawOrganicLanding(items) {
  const tbody = document.getElementById('organicLandingBody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!items.length) {
    tbody.innerHTML = '<tr><td colspan="3" class="no-data">データがありません</td></tr>'; return;
  }
  items.forEach((p, i) => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td class="rank">${i+1}</td>
      <td><div class="path">${escapeHtml(p.path)}</div></td>
      <td class="num">${fmtInt(p.sessions)}</td>`;
    tbody.appendChild(tr);
  });
}

function drawRegions(regions) {
  const list = document.getElementById('regionList');
  list.innerHTML = '';
  if (!regions.length) { list.innerHTML = '<div class="no-data">データがありません</div>'; return; }
  const max = Math.max(...regions.map(r => r.count), 1);
  regions.forEach(r => {
    const el = document.createElement('div');
    el.className = 'region-item';
    el.innerHTML = `
      <span style="color:#334155;font-weight:500">${escapeHtml(r.name)}</span>
      <div class="region-bar-bg">
        <div class="region-bar" style="width:${(r.count/max*100).toFixed(1)}%"></div>
      </div>
      <span class="region-count">${fmtInt(r.count)}</span>`;
    list.appendChild(el);
  });
}

function showError(msg) {
  document.getElementById('lastUpdated').textContent = '最終更新: 取得失敗';
  document.getElementById('footerNote').innerHTML =
    '⚠️ データの取得に失敗しました。サービスアカウント鍵の配置・権限設定をご確認ください。<br><span style="font-size:11px">' + escapeHtml(msg || '') + '</span>';
}

function forceRefresh() {
  fetch('ga4_api.php?refresh=1')
    .then(r => r.json())
    .then(d => { if (d.error && !d.kpi) { showError(d.error); return; } render(d); })
    .catch(e => showError(e.message));
}

/* ===== 初回データ取得 ===== */
fetch('ga4_api.php')
  .then(r => r.json())
  .then(d => { if (d.error && !d.kpi) { showError(d.error); return; } render(d); })
  .catch(e => showError(e.message));
</script>
</body>
</html>
