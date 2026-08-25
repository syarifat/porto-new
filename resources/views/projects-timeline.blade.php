<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Proyek | SAT Portfolio</title>
    <meta name="description" content="Rekam jejak proyek Syarif Ahsani Taqwim secara kronologis interaktif.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --bg: #0f0f0d; --surface: #161614; --surface2: #1e1e1b;
            --border: rgba(255,255,255,0.07); --text1: #e8e6e0; --text2: #9d9b94;
            --text3: #5a5855; --accent: #d97706; --accent2: #f59e0b; --green: #10b981;
        }
        html, body { height: 100%; background: var(--bg); color: var(--text1); font-family: 'Inter', sans-serif; overflow: hidden; }

        /* Header */
        .tl-header { position: fixed; top: 0; left: 0; right: 0; height: 56px; background: rgba(15,15,13,0.88); backdrop-filter: blur(12px); border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; padding: 0 1.5rem; z-index: 100; }
        .tl-header-left { display: flex; align-items: center; gap: 1rem; }
        .tl-back { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; color: var(--text2); text-decoration: none; padding: 0.35rem 0.75rem; border: 1px solid var(--border); border-radius: 6px; transition: all 0.2s; }
        .tl-back:hover { border-color: rgba(217,119,6,0.4); color: var(--accent); }
        .tl-header-title { font-size: 0.88rem; font-weight: 700; color: var(--text1); letter-spacing: -0.02em; }
        .tl-counter { font-size: 0.75rem; color: var(--text3); }

        /* Canvas */
        .tl-canvas { position: fixed; top: 56px; left: 0; right: 0; bottom: 72px; overflow-x: auto; overflow-y: hidden; cursor: grab; }
        .tl-canvas:active { cursor: grabbing; }
        .tl-canvas::-webkit-scrollbar { height: 4px; }
        .tl-canvas::-webkit-scrollbar-thumb { background: rgba(217,119,6,0.3); border-radius: 2px; }
        .tl-inner { position: relative; height: 100%; }
        .tl-svg { position: absolute; inset: 0; pointer-events: none; }

        /* Dots */
        .tl-dot-wrap { position: absolute; transform: translate(-50%, -50%); display: flex; flex-direction: column; align-items: center; gap: 8px; cursor: pointer; z-index: 10; }
        .tl-dot { width: 16px; height: 16px; border-radius: 50%; background: var(--surface2); border: 2px solid rgba(255,255,255,0.15); position: relative; transition: transform 0.25s cubic-bezier(0.16,1,0.3,1), border-color 0.25s, box-shadow 0.25s; flex-shrink: 0; }
        .tl-dot::after { content: ''; position: absolute; inset: 3px; border-radius: 50%; background: var(--text3); transition: background 0.2s; }
        .tl-dot.ongoing { border-color: var(--accent); }
        .tl-dot.ongoing::after { background: var(--accent); }
        .tl-dot.ongoing::before { content: ''; position: absolute; inset: -5px; border-radius: 50%; border: 1.5px solid rgba(217,119,6,0.5); animation: pulse 2s infinite; }
        @keyframes pulse { 0%,100% { opacity:0.6; transform:scale(1); } 50% { opacity:0; transform:scale(2.2); } }
        .tl-dot-wrap:hover .tl-dot { border-color: var(--accent); transform: scale(1.5); box-shadow: 0 0 16px rgba(217,119,6,0.5); }
        .tl-dot-wrap:hover .tl-dot::after { background: var(--accent); }
        .tl-dot-label { text-align: center; pointer-events: none; max-width: 140px; }
        .tl-dot-name { font-size: 0.72rem; font-weight: 700; color: var(--text1); line-height: 1.25; transition: color 0.2s; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .tl-dot-wrap:hover .tl-dot-name { color: var(--accent); }
        .tl-dot-year { font-size: 0.6rem; color: var(--text3); margin-top: 2px; }

        /* Bottom bar */
        .tl-bar-outer { position: fixed; bottom: 0; left: 0; right: 0; height: 72px; background: rgba(15,15,13,0.9); backdrop-filter: blur(12px); border-top: 1px solid var(--border); overflow: hidden; z-index: 100; }
        .tl-bar { position: relative; height: 100%; }
        .tl-bar-line { position: absolute; top: 50%; left: 0; right: 0; height: 1px; background: linear-gradient(to right, transparent, rgba(217,119,6,0.25) 10%, rgba(217,119,6,0.25) 90%, transparent); }
        .tl-bar-tick { position: absolute; display: flex; flex-direction: column; align-items: center; gap: 4px; top: 50%; transform: translate(-50%, -50%); }
        .tl-bar-tick-line { width: 1px; height: 12px; background: rgba(217,119,6,0.35); }
        .tl-bar-year { font-size: 0.65rem; font-weight: 700; color: var(--text3); letter-spacing: 0.05em; }

        /* Scroll hint */
        .tl-hint { position: fixed; right: 1.25rem; top: 50%; transform: translateY(-50%); display: flex; flex-direction: column; align-items: center; gap: 0.35rem; pointer-events: none; z-index: 50; animation: hintFade 4s ease 0.5s both; }
        @keyframes hintFade { 0% { opacity:0; } 20% { opacity:0.5; } 80% { opacity:0.5; } 100% { opacity:0; } }
        .tl-hint-txt { font-size: 0.58rem; color: var(--text3); letter-spacing: 0.1em; writing-mode: vertical-rl; transform: rotate(180deg); }

        /* Modal */
        .proj-modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.72); backdrop-filter: blur(10px); z-index: 9000; display: flex; align-items: center; justify-content: center; padding: 1.5rem; opacity: 0; visibility: hidden; transition: opacity 0.25s ease, visibility 0.25s ease; }
        .proj-modal-overlay.active { opacity: 1; visibility: visible; }
        .proj-modal-box { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; max-width: 560px; width: 100%; max-height: 88vh; overflow-y: auto; transform: scale(0.94) translateY(16px); transition: transform 0.35s cubic-bezier(0.16,1,0.3,1); position: relative; }
        .proj-modal-overlay.active .proj-modal-box { transform: scale(1) translateY(0); }
        .proj-modal-close { position: absolute; top: 0.85rem; right: 0.85rem; width: 28px; height: 28px; background: rgba(0,0,0,0.5); border: 1px solid rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #fff; font-size: 0.8rem; transition: background 0.2s; z-index: 10; }
        .proj-modal-close:hover { background: rgba(0,0,0,0.8); }
        .proj-modal-hero { width: 100%; height: 180px; object-fit: cover; border-radius: 16px 16px 0 0; display: block; }
        .proj-modal-hero-ph { width: 100%; height: 140px; background: linear-gradient(135deg, var(--surface2), rgba(217,119,6,0.08)); border-radius: 16px 16px 0 0; display: flex; align-items: center; justify-content: center; font-size: 3rem; }
        .proj-modal-body { padding: 1.5rem; }
        .proj-modal-title { font-size: 1.05rem; font-weight: 800; color: var(--text1); line-height: 1.3; letter-spacing: -0.02em; margin-bottom: 0.2rem; }
        .proj-modal-meta { font-size: 0.72rem; color: var(--text3); margin-bottom: 0.8rem; }
        .proj-modal-partner { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 1rem; padding: 0.6rem 0.8rem; background: var(--surface2); border-radius: 8px; border: 1px solid var(--border); }
        .proj-modal-partner-logo { width: 36px; height: 36px; object-fit: contain; border-radius: 6px; background: #fff; padding: 2px; flex-shrink: 0; }
        .proj-modal-partner-name { font-size: 0.82rem; font-weight: 600; color: var(--text2); }
        .proj-modal-partner-lbl { font-size: 0.68rem; color: var(--text3); }
        .proj-modal-desc { font-size: 0.83rem; color: var(--text2); line-height: 1.72; margin-bottom: 1.25rem; }
        .proj-modal-chips { display: flex; flex-wrap: wrap; gap: 0.35rem; }
        .status-chip { display: inline-flex; align-items: center; gap: 0.3rem; font-size: 0.65rem; font-weight: 600; letter-spacing: 0.05em; padding: 0.18rem 0.55rem; border-radius: 3px; }
        .status-chip.completed { background: rgba(16,185,129,0.1); color: var(--green); border: 1px solid rgba(16,185,129,0.25); }
        .status-chip.ongoing { background: rgba(217,119,6,0.1); color: var(--accent); border: 1px solid rgba(217,119,6,0.3); }
        .chip { display: inline-flex; align-items: center; font-size: 0.68rem; color: var(--text2); background: var(--surface2); border: 1px solid var(--border); border-radius: 4px; padding: 0.15rem 0.5rem; }
    </style>
</head>
<body>

<header class="tl-header">
    <div class="tl-header-left">
        <a href="{{ route('home') }}#timeline" class="tl-back">
            <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
        <span class="tl-header-title">Timeline Proyek</span>
    </div>
    <span class="tl-counter">{{ $projects->count() }} proyek</span>
</header>

<div class="tl-hint">
    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="rgba(217,119,6,0.5)" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
    <span class="tl-hint-txt">GESER</span>
</div>

<div class="tl-canvas" id="tlCanvas">
    <div class="tl-inner" id="tlInner">
        <svg class="tl-svg" id="tlSvg"></svg>
        @foreach($projects as $i => $project)
        <div class="tl-dot-wrap"
             data-id="{{ $project->id }}"
             data-index="{{ $i }}"
             onclick="openModal({{ $project->id }})">
            <div class="tl-dot-label" id="label-top-{{ $i }}">
                <div class="tl-dot-name"></div>
                <div class="tl-dot-year"></div>
            </div>
            <div class="tl-dot {{ $project->status === 'ongoing' ? 'ongoing' : '' }}"></div>
            <div class="tl-dot-label" id="label-bot-{{ $i }}">
                <div class="tl-dot-name"></div>
                <div class="tl-dot-year"></div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="tl-bar-outer">
    <div class="tl-bar" id="tlBar">
        <div class="tl-bar-line"></div>
    </div>
</div>

<!-- Modal -->
<div class="proj-modal-overlay" id="projModal" onclick="if(event.target===this)closeModal()">
    <div class="proj-modal-box">
        <button class="proj-modal-close" onclick="closeModal()">&#10005;</button>
        <img id="pm-hero" class="proj-modal-hero" alt="" style="display:none;">
        <div id="pm-hero-ph" class="proj-modal-hero-ph">&#128193;</div>
        <div class="proj-modal-body">
            <div id="pm-title" class="proj-modal-title"></div>
            <div id="pm-meta"  class="proj-modal-meta"></div>
            <div id="pm-partner" class="proj-modal-partner" style="display:none;">
                <img id="pm-logo" class="proj-modal-partner-logo" alt="" style="display:none;">
                <div>
                    <div class="proj-modal-partner-lbl">Mitra</div>
                    <div id="pm-partner-name" class="proj-modal-partner-name"></div>
                </div>
            </div>
            <p id="pm-desc" class="proj-modal-desc"></p>
            <div id="pm-chips" class="proj-modal-chips"></div>
        </div>
    </div>
</div>

<script>
const PROJECTS = @json($projectsJson);
const COL_W = 210, PAD_L = 140, PAD_R = 140;
const ROW_TOP = 0.27, ROW_BOT = 0.63;

function init() {
    const canvas = document.getElementById('tlCanvas');
    const inner  = document.getElementById('tlInner');
    const bar    = document.getElementById('tlBar');
    const svg    = document.getElementById('tlSvg');
    const dots   = Array.from(inner.querySelectorAll('.tl-dot-wrap'));
    const n      = dots.length;
    if (!n) return;

    const totalW  = PAD_L + (n - 1) * COL_W + PAD_R;
    const canvasH = canvas.clientHeight;

    inner.style.width = totalW + 'px';
    svg.setAttribute('viewBox', `0 0 ${totalW} ${canvasH}`);
    svg.setAttribute('width', totalW);
    svg.setAttribute('height', canvasH);
    bar.style.width = totalW + 'px';

    const pts = [];
    dots.forEach((dot, i) => {
        const data = PROJECTS[i];
        if (!data) return;
        const x = PAD_L + i * COL_W;
        const y = i % 2 === 0 ? canvasH * ROW_TOP : canvasH * ROW_BOT;
        dot.style.left = x + 'px';
        dot.style.top  = y + 'px';

        const topName = document.querySelector('#label-top-' + i + ' .tl-dot-name');
        const topYear = document.querySelector('#label-top-' + i + ' .tl-dot-year');
        const botName = document.querySelector('#label-bot-' + i + ' .tl-dot-name');
        const botYear = document.querySelector('#label-bot-' + i + ' .tl-dot-year');

        if (i % 2 === 0) {
            // top row: name above, year below dot
            topName.textContent = data.title;
            topYear.textContent = '';
            botName.textContent = '';
            botYear.textContent = data.date;
        } else {
            // bottom row: year above, name below dot
            topName.textContent = '';
            topYear.textContent = data.date;
            botName.textContent = data.title;
            botYear.textContent = '';
        }
        pts.push({ x, y });
    });

    drawPath(svg, pts, totalW, canvasH);
    drawBarTicks(bar);

    canvas.addEventListener('scroll', () => { bar.parentElement.scrollLeft = canvas.scrollLeft; });
}

function drawPath(svg, pts, W, H) {
    if (pts.length < 2) return;
    const midY = H * 0.5;
    let d = `M ${pts[0].x} ${pts[0].y}`;
    for (let i = 0; i < pts.length - 1; i++) {
        const a = pts[i], b = pts[i + 1];
        const mx = (a.x + b.x) / 2;
        d += ` C ${mx} ${a.y} ${mx} ${b.y} ${b.x} ${b.y}`;
    }

    const glow = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    glow.setAttribute('d', d); glow.setAttribute('fill', 'none');
    glow.setAttribute('stroke', 'rgba(217,119,6,0.12)'); glow.setAttribute('stroke-width', '10');
    glow.setAttribute('stroke-linecap', 'round'); svg.appendChild(glow);

    const path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
    path.setAttribute('d', d); path.setAttribute('fill', 'none');
    path.setAttribute('stroke', 'rgba(217,119,6,0.4)'); path.setAttribute('stroke-width', '1.5');
    path.setAttribute('stroke-dasharray', '6 9'); path.setAttribute('stroke-linecap', 'round');
    svg.appendChild(path);

    pts.forEach(p => {
        const vl = document.createElementNS('http://www.w3.org/2000/svg', 'line');
        vl.setAttribute('x1', p.x); vl.setAttribute('y1', p.y);
        vl.setAttribute('x2', p.x); vl.setAttribute('y2', midY);
        vl.setAttribute('stroke', 'rgba(217,119,6,0.07)');
        vl.setAttribute('stroke-width', '1'); vl.setAttribute('stroke-dasharray', '3 5');
        svg.appendChild(vl);
    });
}

function drawBarTicks(bar) {
    const seenYears = new Set();
    PROJECTS.forEach((p, i) => {
        const yr = p.start_year;
        if (seenYears.has(yr)) return;
        seenYears.add(yr);
        const x = PAD_L + i * COL_W;
        const tick = document.createElement('div');
        tick.className = 'tl-bar-tick';
        tick.style.left = x + 'px';
        tick.innerHTML = '<div class="tl-bar-tick-line"></div><div class="tl-bar-year">' + yr + '</div>';
        bar.appendChild(tick);
    });
}

function openModal(id) {
    const data = PROJECTS.find(p => p.id == id);
    if (!data) return;
    const modal = document.getElementById('projModal');
    const heroImg = document.getElementById('pm-hero'), heroPh = document.getElementById('pm-hero-ph');
    if (data.partner_logo) { heroImg.src = data.partner_logo; heroImg.style.display = 'block'; heroPh.style.display = 'none'; }
    else { heroImg.style.display = 'none'; heroPh.style.display = 'flex'; }
    document.getElementById('pm-title').textContent = data.title;
    document.getElementById('pm-meta').textContent  = data.date;
    const pw = document.getElementById('pm-partner'), pl = document.getElementById('pm-logo'), pn = document.getElementById('pm-partner-name');
    if (data.partner_name) { pw.style.display = 'flex'; pn.textContent = data.partner_name; if (data.partner_logo) { pl.src = data.partner_logo; pl.style.display = 'block'; } else pl.style.display = 'none'; } else pw.style.display = 'none';
    document.getElementById('pm-desc').textContent = data.description;
    const chips = document.getElementById('pm-chips');
    chips.innerHTML = '';
    const sc = document.createElement('span');
    sc.className = 'status-chip ' + data.status;
    sc.textContent = data.status === 'completed' ? '\u2713 Selesai' : '\u00b7 Berlangsung';
    chips.appendChild(sc);
    if (data.category) { const c = document.createElement('span'); c.className = 'chip'; c.textContent = data.category; chips.appendChild(c); }
    (data.tech_stack || []).forEach(t => { const c = document.createElement('span'); c.className = 'chip'; c.textContent = t; chips.appendChild(c); });
    modal.classList.add('active');
}

function closeModal() { document.getElementById('projModal').classList.remove('active'); }
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// Drag scroll
(function() {
    const el = document.getElementById('tlCanvas');
    let down = false, startX, sl;
    el.addEventListener('mousedown', e => { down = true; startX = e.pageX - el.offsetLeft; sl = el.scrollLeft; });
    el.addEventListener('mouseleave', () => down = false);
    el.addEventListener('mouseup',    () => down = false);
    el.addEventListener('mousemove',  e => { if (!down) return; e.preventDefault(); el.scrollLeft = sl - (e.pageX - el.offsetLeft - startX) * 1.4; });
})();

document.getElementById('tlBar').parentElement.style.overflow = 'hidden';
window.addEventListener('load', init);
window.addEventListener('resize', () => { document.getElementById('tlSvg').innerHTML = ''; const b = document.getElementById('tlBar'); Array.from(b.querySelectorAll('.tl-bar-tick')).forEach(t => t.remove()); init(); });
</script>
</body>
</html>
