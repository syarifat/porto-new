<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Syarif Ahsani Taqwim, Full-Stack Developer, IoT Engineer, dan IT Infrastructure Specialist. Membangun sistem end-to-end yang benar-benar berjalan.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Syarif Ahsani Taqwim</title>

    <!-- Google Fonts: Inter + DM Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;1,9..40,300&display=swap" rel="stylesheet">

    <style>
        /* ===== TOKENS ===== */
        :root {
            --bg:           #0f0f0d;
            --surface:      #171714;
            --surface-2:    #1e1e1a;
            --border:       rgba(255,255,255,0.07);
            --border-hover: rgba(255,255,255,0.14);
            --text-1:       #e8e6e0;
            --text-2:       #8a8780;
            --text-3:       #52504b;
            --accent:       #d97706;
            --accent-dim:   rgba(217,119,6,0.1);
            --accent-border:rgba(217,119,6,0.25);
            --green:        #4d7c59;
            --green-text:   #6aad7a;
            --shadow-sm:    0 1px 3px rgba(0,0,0,0.5), 0 1px 2px rgba(0,0,0,0.3);
            --shadow-md:    0 4px 16px rgba(0,0,0,0.45), 0 1px 3px rgba(0,0,0,0.3);
            --r:            6px;
            --r-lg:         10px;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text-1);
            overflow-x: hidden;
            line-height: 1.65;
            font-size: 15px;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: var(--bg); }
        ::-webkit-scrollbar-thumb { background: var(--text-3); border-radius: 2px; }

        /* ===== NAVBAR ===== */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1.1rem 2.5rem;
            background: rgba(15,15,13,0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border);
            transition: border-color 0.3s;
        }

        .nav-container {
            max-width: 1180px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Inter', sans-serif;
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-1);
            text-decoration: none;
            letter-spacing: -0.02em;
        }

        .nav-logo .logo-dot  { color: var(--accent); }
        .nav-logo .logo-x    { color: var(--text-3); font-weight: 400; font-size: 0.8rem; margin: 0 0.1rem; }
        .nav-logo .logo-icon { width: 18px; height: 18px; display: block; flex-shrink: 0; opacity: 0.85; }

        .nav-links {
            display: flex;
            gap: 2.5rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-2);
            text-decoration: none;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            transition: color 0.2s;
        }

        .nav-links a:hover { color: var(--text-1); }

        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
            background: none;
            border: none;
        }

        .nav-hamburger span {
            display: block;
            width: 20px;
            height: 1.5px;
            background: var(--text-2);
            border-radius: 1px;
            transition: all 0.3s;
        }

        /* ===== HERO ===== */
        #hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 7rem 2.5rem 5rem;
            position: relative;
        }

        .hero-inner {
            max-width: 1180px;
            margin: 0 auto;
            width: 100%;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 5rem;
            align-items: center;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--text-3);
            margin-bottom: 2rem;
        }

        .hero-eyebrow::before {
            content: '';
            display: inline-block;
            width: 6px;
            height: 6px;
            background: var(--green);
            border-radius: 50%;
            animation: blink 2.8s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.2; }
        }

        h1.hero-name {
            font-family: 'Inter', sans-serif;
            font-size: clamp(3.4rem, 6.5vw, 6.5rem);
            font-weight: 800;
            line-height: 0.93;
            letter-spacing: -0.04em;
            color: var(--text-1);
            margin-bottom: 2rem;
        }

        h1.hero-name .dim { color: var(--text-3); }

        .hero-desc {
            font-size: 1rem;
            color: var(--text-2);
            line-height: 1.78;
            max-width: 460px;
            font-weight: 300;
        }

        /* Right column */
        .hero-right {
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
        }

        .avail-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(77,124,89,0.1);
            border: 1px solid rgba(77,124,89,0.22);
            padding: 0.35rem 0.85rem;
            border-radius: var(--r);
            font-size: 0.72rem;
            font-weight: 500;
            color: var(--green-text);
            width: fit-content;
            letter-spacing: 0.03em;
        }

        .hero-roles {
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
        }

        .role-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.875rem;
            color: var(--text-2);
        }

        .role-row::before {
            content: '';
            display: block;
            width: 20px;
            height: 1px;
            background: var(--accent);
            flex-shrink: 0;
        }

        .hero-meta {
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border);
        }

        .meta-row {
            font-size: 0.8rem;
            color: var(--text-3);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .meta-row a {
            color: var(--text-2);
            text-decoration: none;
            transition: color 0.2s;
        }

        .meta-row a:hover { color: var(--text-1); }

        .hero-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.5rem;
            background: var(--accent);
            color: #0f0f0d;
            text-decoration: none;
            border-radius: var(--r);
            font-weight: 600;
            font-size: 0.82rem;
            letter-spacing: 0.01em;
            transition: opacity 0.2s, transform 0.2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover { opacity: 0.85; transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.65rem 1.5rem;
            background: transparent;
            color: var(--text-2);
            text-decoration: none;
            border-radius: var(--r);
            font-weight: 500;
            font-size: 0.82rem;
            border: 1px solid var(--border-hover);
            transition: border-color 0.2s, color 0.2s, transform 0.2s;
        }

        .btn-ghost:hover {
            border-color: var(--text-3);
            color: var(--text-1);
            transform: translateY(-1px);
        }

        .scroll-hint {
            position: absolute;
            bottom: 2.5rem;
            left: 2.5rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.65rem;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-3);
        }

        .scroll-hint::after {
            content: '';
            display: block;
            width: 36px;
            height: 1px;
            background: var(--text-3);
        }

        /* ===== SECTION STRUCTURE ===== */
        .site-section {
            padding: 6rem 2.5rem;
            max-width: 1180px;
            margin: 0 auto;
        }

        .section-rule {
            width: 100%;
            height: 1px;
            background: var(--border);
            max-width: 1180px;
            margin: 0 auto;
        }

        .section-label {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.6rem;
        }

        .section-num {
            font-family: 'Inter', sans-serif;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            color: var(--accent);
        }

        .section-tag-txt {
            font-size: 0.68rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-3);
        }

        h2.section-title {
            font-family: 'Inter', sans-serif;
            font-size: clamp(2.2rem, 4.5vw, 3.5rem);
            font-weight: 800;
            line-height: 1.0;
            letter-spacing: -0.035em;
            color: var(--text-1);
            margin-bottom: 1rem;
        }

        .section-sub {
            font-size: 0.95rem;
            color: var(--text-2);
            font-weight: 300;
            max-width: 500px;
            line-height: 1.78;
        }

        /* ===== ABOUT ===== */
        .about-layout {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6rem;
            align-items: start;
        }

        .about-body {
            margin-top: 2.5rem;
        }

        .about-body p {
            color: var(--text-2);
            margin-bottom: 1rem;
            line-height: 1.82;
            font-size: 0.93rem;
            font-weight: 300;
        }

        .about-body strong { color: var(--text-1); font-weight: 500; }
        .about-body .hl { color: var(--accent); font-weight: 500; }

        /* Stats — collapsed border grid */
        .stats-block {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border: 1px solid var(--border);
        }

        .stat-item {
            padding: 1.75rem;
            transition: background 0.2s;
        }

        .stat-item:hover { background: var(--surface); }

        .stat-item:nth-child(2) { border-left: 1px solid var(--border); }
        .stat-item:nth-child(3) { border-top: 1px solid var(--border); }
        .stat-item:nth-child(4) { border-top: 1px solid var(--border); border-left: 1px solid var(--border); }

        .stat-num {
            font-family: 'Inter', sans-serif;
            font-size: 3.25rem;
            font-weight: 800;
            letter-spacing: -0.05em;
            color: var(--text-1);
            line-height: 1;
            margin-bottom: 0.3rem;
        }

        .stat-num sup {
            font-size: 1.3rem;
            color: var(--accent);
            vertical-align: super;
        }

        .stat-lbl {
            font-size: 0.7rem;
            color: var(--text-3);
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        /* ===== SKILLS — BENTO ===== */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
        }

        .bento-card {
            background: var(--surface);
            padding: 2rem 2rem 2.25rem;
            transition: background 0.2s;
        }

        .bento-card:hover { background: var(--surface-2); }

        /* Card 1 spans 2 of 3 cols */
        .bento-card.wide { grid-column: span 2; }
        /* Card 2 spans 2 rows */
        .bento-card.tall { grid-row: span 2; }

        .bento-eyebrow {
            font-size: 0.62rem;
            font-weight: 600;
            letter-spacing: 0.13em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.8rem;
        }

        .bento-card h3 {
            font-family: 'Inter', sans-serif;
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: -0.025em;
            color: var(--text-1);
            margin-bottom: 0.7rem;
            line-height: 1.2;
        }

        .bento-card p {
            font-size: 0.84rem;
            color: var(--text-2);
            line-height: 1.72;
            font-weight: 300;
        }

        .bento-glyph {
            margin-bottom: 1rem;
            line-height: 1;
            color: var(--text-3);
        }

        .bento-glyph svg {
            width: 28px;
            height: 28px;
            display: block;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .bento-card:hover .bento-glyph svg {
            transform: scale(1.08);
            color: var(--accent);
        }

        /* ===== TECH STACK ===== */
        .tech-wrap {
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        table.tech-tbl {
            width: 100%;
            border-collapse: collapse;
        }

        .tech-tbl thead tr {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .tech-tbl th {
            padding: 0.85rem 1.5rem;
            text-align: left;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--text-3);
        }

        .tech-tbl td {
            padding: 0.8rem 1.5rem;
            font-size: 0.84rem;
            color: var(--text-2);
            border-top: 1px solid var(--border);
            vertical-align: middle;
        }

        .tech-tbl tbody tr { background: var(--bg); transition: background 0.15s; }
        .tech-tbl tbody tr:hover { background: var(--surface); }

        .tech-tbl td:first-child {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-1);
            white-space: nowrap;
            width: 185px;
        }

        .chip {
            display: inline-block;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text-2);
            font-size: 0.7rem;
            padding: 0.18rem 0.6rem;
            border-radius: 3px;
            margin: 0.12rem 0.08rem;
            transition: border-color 0.15s, color 0.15s;
        }

        .chip:hover { border-color: var(--border-hover); color: var(--text-1); }

        /* ===== TIMELINE ===== */
        .timeline-wrap {
            position: relative;
            padding-left: 2rem;
        }

        .t-line {
            position: absolute;
            left: 0;
            top: 10px;
            bottom: 0;
            width: 1px;
            background: var(--border);
        }

        .project-entry {
            position: relative;
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .project-entry.visible { opacity: 1; transform: translateY(0); }

        /* Amber diamond marker */
        .project-entry::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.85rem;
            width: 5px;
            height: 5px;
            background: var(--accent);
            transform: rotate(45deg);
            border-radius: 1px;
        }

        .proj-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            padding: 1.4rem 1.5rem;
            box-shadow: var(--shadow-sm);
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .proj-card:hover {
            border-color: var(--border-hover);
            box-shadow: var(--shadow-md);
        }

        .proj-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 0.4rem;
        }

        .proj-title {
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text-1);
        }

        .proj-date {
            font-size: 0.7rem;
            color: var(--text-3);
            white-space: nowrap;
            margin-top: 0.15rem;
        }

        .proj-partner {
            font-size: 0.76rem;
            color: var(--text-3);
            margin-bottom: 0.5rem;
        }

        .proj-partner strong { color: var(--text-2); font-weight: 500; }

        .proj-desc {
            font-size: 0.84rem;
            color: var(--text-2);
            line-height: 1.72;
            font-weight: 300;
            margin-bottom: 0.875rem;
        }

        .proj-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.3rem;
        }

        .status-chip {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            padding: 0.18rem 0.55rem;
            border-radius: 3px;
        }

        .status-chip.completed {
            background: rgba(74,124,89,0.12);
            color: var(--green-text);
            border: 1px solid rgba(74,124,89,0.22);
        }

        .status-chip.ongoing {
            background: var(--accent-dim);
            color: var(--accent);
            border: 1px solid var(--accent-border);
        }

        .timeline-empty {
            padding: 4rem 0;
            color: var(--text-3);
            font-size: 0.875rem;
        }

        /* ===== CERTIFICATES ===== */
        .certs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(256px, 1fr));
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: var(--r-lg);
            overflow: hidden;
        }

        .cert-card {
            background: var(--surface);
            cursor: pointer;
            transition: background 0.2s;
            overflow: hidden;
        }

        .cert-card:hover { background: var(--surface-2); }

        .cert-img-wrap {
            width: 100%;
            height: 155px;
            overflow: hidden;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
        }

        .cert-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.45s ease;
        }

        .cert-card:hover .cert-img-wrap img { transform: scale(1.05); }

        .cert-ph {
            width: 100%;
            height: 155px;
            display: none;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            border-bottom: 1px solid var(--border);
            background: var(--surface-2);
        }

        .cert-body {
            padding: 1rem 1.2rem;
        }

        .cert-name {
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-1);
            margin-bottom: 0.25rem;
            line-height: 1.3;
        }

        .cert-issuer {
            font-size: 0.72rem;
            color: var(--accent);
            margin-bottom: 0.2rem;
        }

        .cert-date {
            font-size: 0.68rem;
            color: var(--text-3);
        }

        .certs-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3.5rem;
            color: var(--text-3);
            font-size: 0.875rem;
        }

        /* ===== CLIENTS ===== */
        .clients-section {
            padding: 3.5rem 2.5rem;
            border-top: 1px solid var(--border);
        }

        .clients-inner {
            max-width: 1180px;
            margin: 0 auto;
        }

        .clients-lbl {
            font-size: 0.65rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-3);
            margin-bottom: 2rem;
            text-align: center;
        }

        .clients-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem 2.5rem;
            align-items: flex-start;
            justify-content: center;
        }

        .client-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            width: 140px;
            text-align: center;
        }

        .client-logo {
            width: 88px;
            height: 52px;
            object-fit: contain;
            filter: brightness(0.45) saturate(0);
            transition: filter 0.3s;
        }

        .client-logo:hover {
            filter: brightness(1) saturate(1);
        }

        .client-name {
            font-size: 0.65rem;
            color: var(--text-3);
            letter-spacing: 0.04em;
            line-height: 1.35;
        }

        /* ===== FOOTER ===== */
        footer {
            padding: 2rem 2.5rem;
            border-top: 1px solid var(--border);
        }

        .footer-inner {
            max-width: 1180px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-family: 'Inter', sans-serif;
            font-size: 0.82rem;
            font-weight: 800;
            color: var(--text-3);
            letter-spacing: -0.01em;
        }

        .footer-brand .logo-dot  { color: var(--accent); }
        .footer-brand .logo-x    { color: var(--text-3); font-weight: 400; font-size: 0.7rem; margin: 0 0.1rem; opacity: 0.5; }
        .footer-brand .logo-icon { width: 14px; height: 14px; display: block; flex-shrink: 0; opacity: 0.4; }

        .footer-links {
            display: flex;
            gap: 2rem;
            align-items: center;
        }

        .footer-links a {
            font-size: 0.76rem;
            color: var(--text-3);
            text-decoration: none;
            transition: color 0.2s;
        }

        .footer-links a:hover { color: var(--text-2); }

        .footer-copy {
            font-size: 0.7rem;
            color: var(--text-3);
        }

        /* ===== ANIMATIONS ===== */
        .fade-up {
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-up.visible { opacity: 1; transform: translateY(0); }

        /* ===== MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.92);
            backdrop-filter: blur(10px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        .modal-overlay.active { opacity: 1; pointer-events: all; }

        .modal-img {
            max-width: 90vw;
            max-height: 85vh;
            border-radius: var(--r-lg);
            object-fit: contain;
            box-shadow: 0 30px 80px rgba(0,0,0,0.85);
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 34px;
            height: 34px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--r);
            color: var(--text-2);
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, color 0.2s;
        }

        .modal-close:hover { background: var(--surface-2); color: var(--text-1); }

        /* ===== AI CHAT WIDGET ===== */
        .ai-chat-btn {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            z-index: 999;
            background: var(--surface);
            border: 1px solid rgba(217, 119, 6, 0.4);
            color: var(--text-1);
            padding: 0.75rem 1.25rem;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5), 0 0 15px rgba(217, 119, 6, 0.15);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .ai-chat-btn:hover {
            transform: translateY(-3px) scale(1.03);
            border-color: var(--accent);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.6), 0 0 25px rgba(217, 119, 6, 0.3);
        }

        .ai-chat-pulse {
            width: 8px;
            height: 8px;
            background: var(--accent);
            border-radius: 50%;
            box-shadow: 0 0 8px var(--accent);
            animation: aiPulse 2s infinite;
        }

        @keyframes aiPulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(217, 119, 6, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(217, 119, 6, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(217, 119, 6, 0); }
        }

        .ai-chat-box {
            position: fixed;
            bottom: 5.5rem;
            right: 2rem;
            width: 380px;
            max-width: calc(100vw - 2.5rem);
            height: 520px;
            max-height: calc(100vh - 7.5rem);
            background: rgba(23, 23, 20, 0.95);
            backdrop-filter: blur(16px);
            border: 1px solid var(--border-hover);
            border-radius: var(--r-lg);
            z-index: 1000;
            display: flex;
            flex-direction: column;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.7), 0 0 30px rgba(217, 119, 6, 0.1);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.95);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            overflow: hidden;
        }

        .ai-chat-box.open {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .ai-chat-header {
            padding: 0.9rem 1.1rem;
            background: var(--surface-2);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .ai-chat-header-info {
            display: flex;
            align-items: center;
            gap: 0.65rem;
        }

        .ai-avatar {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: var(--accent-dim);
            border: 1px solid rgba(217, 119, 6, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--accent);
            flex-shrink: 0;
        }

        .ai-chat-title {
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-1);
            line-height: 1.2;
        }

        .ai-chat-subtitle {
            font-size: 0.7rem;
            color: var(--text-3);
        }

        .ai-chat-close {
            background: transparent;
            border: none;
            color: var(--text-3);
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.25rem;
            border-radius: var(--r);
            transition: color 0.2s;
        }

        .ai-chat-close:hover { color: var(--text-1); }

        .ai-chat-body {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
            font-size: 0.84rem;
        }

        .ai-chat-body::-webkit-scrollbar { width: 4px; }
        .ai-chat-body::-webkit-scrollbar-thumb { background: var(--border-hover); border-radius: 2px; }

        .ai-msg {
            display: flex;
            gap: 0.5rem;
            max-width: 88%;
        }

        .ai-msg.user {
            align-self: flex-end;
            flex-direction: row-reverse;
        }

        .ai-msg-bubble {
            padding: 0.65rem 0.9rem;
            border-radius: 14px;
            line-height: 1.5;
            word-break: break-word;
            font-size: 0.83rem;
        }

        .ai-msg.bot .ai-msg-bubble {
            background: var(--surface-2);
            color: var(--text-1);
            border: 1px solid var(--border);
            border-top-left-radius: 4px;
        }

        .ai-msg.user .ai-msg-bubble {
            background: var(--accent);
            color: #fff;
            border-top-right-radius: 4px;
            font-weight: 500;
        }

        .ai-pills {
            padding: 0.5rem 0.8rem;
            display: flex;
            gap: 0.4rem;
            overflow-x: auto;
            border-top: 1px solid var(--border);
            background: var(--bg);
        }

        .ai-pills::-webkit-scrollbar { display: none; }

        .ai-pill {
            white-space: nowrap;
            background: var(--surface-2);
            border: 1px solid var(--border);
            color: var(--text-2);
            font-size: 0.72rem;
            padding: 0.35rem 0.7rem;
            border-radius: 999px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .ai-pill:hover {
            border-color: var(--accent);
            color: var(--accent);
            background: var(--accent-dim);
        }

        .ai-chat-footer {
            padding: 0.65rem 0.85rem;
            background: var(--surface-2);
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .ai-chat-input {
            flex: 1;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 999px;
            padding: 0.55rem 0.9rem;
            color: var(--text-1);
            font-size: 0.82rem;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color 0.2s;
        }

        .ai-chat-input:focus { border-color: var(--accent); }

        .ai-chat-send {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: var(--accent);
            border: none;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: transform 0.2s, opacity 0.2s;
            flex-shrink: 0;
        }

        .ai-chat-send:hover { opacity: 0.9; transform: scale(1.05); }

        .ai-typing-dots {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 0.4rem 0.2rem;
        }

        .ai-typing-dot {
            width: 6px;
            height: 6px;
            background: var(--text-3);
            border-radius: 50%;
            animation: aiTyping 1.4s infinite ease-in-out both;
        }

        .ai-typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .ai-typing-dot:nth-child(2) { animation-delay: -0.16s; }

        @keyframes aiTyping {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }

        @media (max-width: 480px) {
            .ai-chat-btn { bottom: 1.25rem; right: 1.25rem; padding: 0.6rem 1rem; }
            .ai-chat-box { bottom: 4.75rem; right: 0.75rem; left: 0.75rem; width: auto; height: 75vh; }
        }

        /* ===== DOT CANVAS ===== */
        #dot-canvas {
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
        }

        /* Content layers sit above canvas */
        .site-section, .section-rule, .clients-section, footer, #hero {
            position: relative;
            z-index: 1;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 920px) {
            .hero-inner        { grid-template-columns: 1fr; gap: 2.5rem; }
            .about-layout      { grid-template-columns: 1fr; gap: 3rem; }
            .bento-grid        { grid-template-columns: 1fr 1fr; }
            .bento-card.wide   { grid-column: span 2; }
            .bento-card.tall   { grid-row: span 1; }
        }

        @media (max-width: 768px) {
            /* Nav */
            nav { padding: 1rem 1.5rem; }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(15,15,13,0.98);
                flex-direction: column;
                gap: 0;
                border-bottom: 1px solid var(--border);
            }

            .nav-links li              { border-bottom: 1px solid var(--border); }
            .nav-links a               { display: block; padding: 0.9rem 1.5rem; letter-spacing: 0.05em; }
            .nav-links.open            { display: flex; }
            .nav-hamburger             { display: flex; }

            /* Hero */
            #hero                      { padding: 6rem 1.5rem 4rem; }
            .scroll-hint               { display: none; }
            .hero-right                { gap: 1.25rem; }
            .hero-meta                 { padding-top: 0.75rem; }
            .meta-row                  { font-size: 0.75rem; word-break: break-all; }

            /* Sections */
            .site-section              { padding: 3.5rem 1.5rem; }
            .section-rule              { margin: 0 1.5rem; width: auto; }

            /* About stats */
            .stats-block               { grid-template-columns: 1fr 1fr; border: none; }
            .stat-item                 { border: 1px solid var(--border); border-right: none; border-bottom: none; }
            .stat-item:nth-child(2n)   { border-right: 1px solid var(--border); }
            .stat-item:nth-child(n+3)  { border-bottom: 1px solid var(--border); }
            .stat-item:last-child      { border-bottom: 1px solid var(--border); }
            .stat-num                  { font-size: 2.5rem; }

            /* Bento */
            .bento-grid                { grid-template-columns: 1fr; }
            .bento-card.wide           { grid-column: span 1; }
            .bento-card                { padding: 1.5rem; }

            /* Tech table — horizontal scroll on mobile */
            .tech-wrap                 { overflow-x: auto; -webkit-overflow-scrolling: touch; }
            .tech-tbl                  { font-size: 0.75rem; min-width: 460px; }
            .tech-tbl th,
            .tech-tbl td               { padding: 0.65rem 0.875rem; }
            .tech-tbl td:first-child   { width: 135px; }

            /* Timeline */
            .timeline-wrap             { padding-left: 1.5rem; }
            .project-entry::before     { left: -1.5rem; }

            /* Certs */
            .certs-grid                { grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }

            /* Clients */
            .clients-section           { padding: 2.5rem 1.5rem; }
            .clients-grid              { gap: 1rem 2rem; }

            /* Footer */
            footer                     { padding: 1.5rem; }
            .footer-inner              { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .footer-links              { flex-wrap: wrap; gap: 0.75rem 1.5rem; }
        }

        @media (max-width: 480px) {
            h1.hero-name               { font-size: 2.6rem; letter-spacing: -0.03em; }
            h2.section-title           { font-size: 2rem; }
            .hero-actions              { flex-direction: column; }
            .hero-actions .btn-primary,
            .hero-actions .btn-ghost   { width: 100%; justify-content: center; }
            .certs-grid                { grid-template-columns: 1fr; }
            .bento-card                { padding: 1.25rem; }
            .stat-num                  { font-size: 2.2rem; }
            .stat-item                 { padding: 1.25rem; }
            .proj-top                  { flex-direction: column; gap: 0.25rem; }
            .btn-load-more             { width: 100%; justify-content: center; }
        }

        /* Text Justification */
        p, .proj-desc, .bio-desc, .section-sub {
            text-align: justify;
        }

        /* Load More Button & Pagination */
        .project-entry.hidden-chunk {
            display: none !important;
        }

        .btn-load-more {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            cursor: pointer;
            padding: 0.8rem 1.8rem;
            border: 1px solid var(--border);
            border-radius: 9999px;
            background: transparent;
            color: var(--text-2);
            font-family: 'Inter', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            transition: all 0.25s ease;
            outline: none;
        }

        .btn-load-more:hover {
            border-color: var(--border-hover);
            background: var(--surface);
            color: var(--text-1);
        }

        .btn-load-more:active {
            transform: scale(0.97);
        }

        .btn-load-more svg {
            transition: transform 0.25s ease;
        }

        .btn-load-more:hover svg {
            transform: translateY(2px);
        }
    </style>
</head>
<body>
<canvas id="dot-canvas" aria-hidden="true"></canvas>

<!-- Navbar -->
<nav id="navbar">
    <div class="nav-container">
        <a href="#hero" class="nav-logo">
            SAT<span class="logo-dot">.</span>
            <span class="logo-x">×</span>
            <img class="logo-icon" src="/logosat-white.svg" alt="SAT logo mark" width="18" height="18">
        </a>
        <button class="nav-hamburger" id="hamburger" aria-label="Menu">
            <span></span><span></span><span></span>
        </button>
        <ul class="nav-links" id="navLinks">
            <li><a href="#about">Tentang</a></li>
            <li><a href="#skills">Keahlian</a></li>
            <li><a href="#techstack">Tech Stack</a></li>
            <li><a href="#timeline">Proyek</a></li>
            <li><a href="#certificates">Sertifikat</a></li>
        </ul>
    </div>
</nav>

<!-- Hero -->
<section id="hero">
    <div class="hero-inner">

        <!-- Left: big name -->
        <div>
            <h1 class="hero-name">
                Syarif<br>
                Ahsani<br>
                <span class="dim">Taqwim</span>
            </h1>
            <p class="hero-desc">
                Saya bangun hal-hal yang benar-benar berjalan. Dari server fisik, rangkaian IoT, sampai interface yang nyaman dipakai orang.
            </p>
        </div>

        <!-- Right: info & CTA -->
        <div class="hero-right">
            <div class="hero-roles">
                <div class="role-row">Full-Stack Developer</div>
                <div class="role-row">IoT Engineer</div>
                <div class="role-row">IT Infrastructure &amp; DevOps</div>
            </div>

            <div class="hero-meta">
                <div class="meta-row">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Tulungagung, Jawa Timur
                </div>
                <div class="meta-row">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <a href="mailto:syarifahsanit@gmail.com" id="email-link">syarifahsanit@gmail.com</a>
                </div>
                <div class="meta-row">
                    <svg width="11" height="11" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    <a href="https://instagram.com/syariif.at" target="_blank" rel="noopener" id="instagram-link">@syariif.at</a>
                </div>
                <div class="meta-row">
                    <svg width="11" height="11" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/></svg>
                    +62 878-4294-9212
                </div>
            </div>

            <div class="hero-actions">
                <a href="#timeline" class="btn-primary" id="view-projects-btn">Lihat Proyek</a>
                <a href="mailto:syarifahsanit@gmail.com" class="btn-ghost" id="contact-btn">Hubungi Saya →</a>
            </div>
        </div>
    </div>
    <div class="scroll-hint">Gulir ke bawah</div>
</section>

<div class="section-rule"></div>

<!-- About -->
<section class="site-section" id="about">
    <div class="about-layout">
        <div>
            <div class="section-label fade-up">
                <span class="section-num">01</span>
                <span class="section-tag-txt">Tentang Saya</span>
            </div>
            <h2 class="section-title fade-up">Siapa<br>saya.</h2>
            <div class="about-body fade-up">
                <p>
                    Halo, saya <strong>Syarif</strong>. Bagi saya, teknologi yang bagus bukan yang paling canggih. Tapi yang paling relevan dengan masalah yang ada.
                </p>
                <p>
                    Saya bekerja di persimpangan antara <span class="hl">Full-Stack Development</span>, <span class="hl">Mobile Development</span>, dan <span class="hl">Internet of Things</span>. Senang membangun sistem yang menghubungkan dunia fisik ke ekosistem digital.
                </p>
                <p>
                    Sebagai <strong>Founder SAT Project</strong>, saya mengelola dan mengimplementasikan solusi end-to-end: dari otomatisasi cerdas, manajemen server, sampai infrastruktur IT perusahaan.
                </p>
                <p>
                    Kalau ada masalah teknis yang perlu dipecahkan, saya tertarik untuk mendengarnya.
                </p>
            </div>
        </div>
        <div class="stats-block fade-up">
            <div class="stat-item">
                <div class="stat-num">{{ $projects->count() }}<sup>+</sup></div>
                <div class="stat-lbl">Proyek Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">{{ $clients->count() }}<sup>+</sup></div>
                <div class="stat-lbl">Klien Puas</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">4<sup>+</sup></div>
                <div class="stat-lbl">Bidang Keahlian</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">{{ $certificates->count() }}<sup>+</sup></div>
                <div class="stat-lbl">Sertifikat</div>
            </div>
        </div>
    </div>
</section>

<div class="section-rule"></div>

<!-- Skills -->
<section class="site-section" id="skills">
    <div class="section-label fade-up">
        <span class="section-num">02</span>
        <span class="section-tag-txt">Keahlian</span>
    </div>
    <h2 class="section-title fade-up">Area<br>Kompetensi.</h2>
    <p class="section-sub fade-up" style="margin-bottom: 2.5rem;">Dari kode di cloud sampai sinyal di papan sirkuit.</p>

    <div class="bento-grid fade-up">
        <!-- Card 1: col 1–2, row 1 (wide) -->
        <div class="bento-card wide">
            <div class="bento-glyph">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="3" width="20" height="13" rx="2"/>
                    <line x1="12" y1="16" x2="12" y2="20"/>
                    <line x1="8" y1="20" x2="16" y2="20"/>
                    <path d="M8 8l-2 2 2 2"/>
                    <path d="M16 8l2 2-2 2"/>
                    <line x1="13" y1="7" x2="11" y2="13"/>
                </svg>
            </div>
            <div class="bento-eyebrow">Software</div>
            <h3>Full-Stack &amp; Mobile Development</h3>
            <p>PHP/Laravel untuk backend yang solid. JavaScript di sisi klien. Mobile development untuk Android &amp; iOS. Dari skema database sampai halaman yang nyaman dipakai orang awam.</p>
        </div>
        <!-- Card 2: col 3, row 1–2 (tall) -->
        <div class="bento-card tall">
            <div class="bento-glyph">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="5" y="5" width="14" height="14" rx="2"/>
                    <path d="M9 9h6v6H9z"/>
                    <path d="M9 1v4M15 1v4M9 19v4M15 19v4M1 9h4M1 15h4M19 9h4M19 15h4"/>
                </svg>
            </div>
            <div class="bento-eyebrow">IoT</div>
            <h3>Internet of Things</h3>
            <p>Perancangan perangkat keras cerdas: ESP32, ESP8266, Arduino. Integrasi sensor (RFID, ultrasonik, GPS NEO-6M, load cell HX711) ke dashboard yang bisa dimonitor real-time lewat web.</p>
        </div>
        <!-- Card 3: col 1, row 2 -->
        <div class="bento-card">
            <div class="bento-glyph">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="2" width="20" height="6" rx="1"/>
                    <rect x="2" y="9" width="20" height="6" rx="1"/>
                    <rect x="2" y="16" width="20" height="6" rx="1"/>
                    <circle cx="6" cy="5" r="1" fill="currentColor"/>
                    <circle cx="10" cy="5" r="1" fill="currentColor"/>
                    <circle cx="6" cy="12" r="1" fill="currentColor"/>
                    <circle cx="10" cy="12" r="1" fill="currentColor"/>
                    <circle cx="6" cy="19" r="1" fill="currentColor"/>
                    <circle cx="10" cy="19" r="1" fill="currentColor"/>
                </svg>
            </div>
            <div class="bento-eyebrow">Infrastructure</div>
            <h3>IT Infra &amp; DevOps</h3>
            <p>SysAdmin Linux, Docker, Vercel &amp; Cloudflare. Pengelolaan home server dan enterprise server dari nol.</p>
        </div>
        <!-- Card 4: col 2, row 2 -->
        <div class="bento-card">
            <div class="bento-glyph">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="3"/>
                    <circle cx="12" cy="4" r="2.5"/>
                    <circle cx="4" cy="18" r="2.5"/>
                    <circle cx="20" cy="18" r="2.5"/>
                    <line x1="12" y1="6.5" x2="12" y2="9"/>
                    <line x1="5.7" y1="16.3" x2="9.8" y2="13.7"/>
                    <line x1="18.3" y1="16.3" x2="14.2" y2="13.7"/>
                </svg>
            </div>
            <div class="bento-eyebrow">Networking</div>
            <h3>Enterprise Networking</h3>
            <p>Cisco &amp; MikroTik, DHCP/DNS/Firewall, VoIP, CCTV, dan keamanan jaringan perusahaan skala menengah.</p>
        </div>
    </div>
</section>

<div class="section-rule"></div>

<!-- Tech Stack -->
<section class="site-section" id="techstack">
    <div class="section-label fade-up">
        <span class="section-num">03</span>
        <span class="section-tag-txt">Tech Stack</span>
    </div>
    <h2 class="section-title fade-up">Tools<br>&amp; Teknologi.</h2>
    <p class="section-sub fade-up" style="margin-bottom: 2.5rem;">Semua teknologi, hardware, dan platform yang pernah saya tangani langsung.</p>

    <div class="tech-wrap fade-up">
        <table class="tech-tbl">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Teknologi &amp; Perangkat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Framework &amp; Language</td>
                    <td>
                        <span class="chip">PHP</span>
                        <span class="chip">Laravel</span>
                        <span class="chip">JavaScript</span>
                        <span class="chip">Next.js</span>
                        <span class="chip">Flutter</span>
                        <span class="chip">Kotlin</span>
                        <span class="chip">Golang</span>
                        <span class="chip">Gin Gonic</span>
                        <span class="chip">Goravel</span>
                        <span class="chip">Python</span>
                        <span class="chip">Django</span>
                    </td>
                </tr>
                <tr>
                    <td>Database &amp; Storage</td>
                    <td>
                        <span class="chip">MySQL</span>
                        <span class="chip">SQLite</span>
                        <span class="chip">Cloudflare D1</span>
                        <span class="chip">Cloudflare R2</span>
                        <span class="chip">Firebase</span>
                        <span class="chip">Firestore</span>
                        <span class="chip">Supabase</span>
                    </td>
                </tr>
                <tr>
                    <td>IoT Projects</td>
                    <td>
                        <span class="chip">SiPredi — Presensi RFID</span>
                        <span class="chip">Fingersync — Presensi Fingerprint</span>
                        <span class="chip">AquaTherm — Water Heater IoT</span>
                        <span class="chip">Greenova — Smart Garden</span>
                        <span class="chip">NexaHome — Smart Home</span>
                        <span class="chip">Tobacco Techno — Mesin Pemanas Tembakau</span>
                    </td>
                </tr>
                <tr>
                    <td>Cloud &amp; Server</td>
                    <td>
                        <span class="chip">aaPanel</span>
                        <span class="chip">Docker</span>
                        <span class="chip">Colify</span>
                        <span class="chip">Vercel</span>
                        <span class="chip">Netlify</span>
                        <span class="chip">Cloudflare</span>
                    </td>
                </tr>
                <tr>
                    <td>Networking &amp; Security</td>
                    <td>
                        <span class="chip">Cisco</span>
                        <span class="chip">MikroTik</span>
                        <span class="chip">DHCP Server</span>
                        <span class="chip">Firewall Server</span>
                        <span class="chip">DNS Server</span>
                        <span class="chip">Cloud Server</span>
                        <span class="chip">VoIP Server</span>
                        <span class="chip">Print Server</span>
                        <span class="chip">CCTV Integration</span>
                    </td>
                </tr>
                <tr>
                    <td>Integrations &amp; APIs</td>
                    <td>
                        <span class="chip">WhatsApp Gateway</span>
                        <span class="chip">Payment Gateway</span>
                        <span class="chip">REST API</span>
                        <span class="chip">Webhook</span>
                        <span class="chip">Firebase FCM</span>
                        <span class="chip">OAuth Google</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<div class="section-rule"></div>

<!-- Timeline / Projects -->
<section class="site-section" id="timeline">
    <div class="section-label fade-up">
        <span class="section-num">04</span>
        <span class="section-tag-txt">Portfolio</span>
    </div>
    <h2 class="section-title fade-up">Timeline<br>Proyek.</h2>
    <p class="section-sub fade-up" style="margin-bottom: 3rem;">Rekam jejak pekerjaan yang telah dikerjakan, secara kronologis.</p>

    @if($projects->isEmpty())
        <div class="timeline-empty fade-up">
            <p>Belum ada proyek yang ditambahkan.</p>
        </div>
    @else
        <div class="timeline-wrap">
            <div class="t-line"></div>
            @foreach($projects as $index => $project)
            <div class="project-entry @if($index >= 3) hidden-chunk @endif">
                <div class="proj-card">
                    <div class="proj-top">
                        <span class="proj-title">{{ $project->title }}</span>
                        <span class="proj-date">
                            {{ $project->start_date->format('M Y') }}
                            @if($project->end_date)
                                s/d {{ $project->end_date->format('M Y') }}
                            @else
                                s/d Sekarang
                            @endif
                        </span>
                    </div>
                    @if($project->partner_name)
                    <div class="proj-partner">Mitra: <strong>{{ $project->partner_name }}</strong></div>
                    @endif
                    <p class="proj-desc">{{ $project->description }}</p>
                    <div class="proj-chips">
                        <span class="status-chip {{ $project->status }}">
                            @if($project->status === 'completed') ✓ Selesai @else · Berlangsung @endif
                        </span>
                        @if($project->category)
                            <span class="chip">{{ $project->category }}</span>
                        @endif
                        @if($project->tech_stack)
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="chip">{{ trim($tech) }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($projects->count() > 3)
            <div class="load-more-wrap fade-up" style="text-align: center; margin-top: 3rem;">
                <button id="btn-load-more" class="btn-load-more">
                    <span>Lihat Proyek Lainnya</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
            </div>
        @endif
    @endif
</section>

<div class="section-rule"></div>

<!-- Certificates -->
<section class="site-section" id="certificates">
    <div class="section-label fade-up">
        <span class="section-num">05</span>
        <span class="section-tag-txt">Sertifikat</span>
    </div>
    <h2 class="section-title fade-up">Pencapaian<br>&amp; Sertifikasi.</h2>
    <p class="section-sub fade-up" style="margin-bottom: 2.5rem;">Bukti belajar yang tersertifikasi.</p>

    <div class="certs-grid fade-up">
        @if($certificates->isEmpty())
            <div class="certs-empty">
                <p>Belum ada sertifikat yang ditambahkan.</p>
            </div>
        @else
            @foreach($certificates as $cert)
            <div class="cert-card" onclick="openModal('{{ $cert->image_url }}')" id="cert-{{ $cert->id }}">
                <div class="cert-img-wrap">
                    <img
                        src="{{ $cert->image_url }}"
                        alt="{{ $cert->title }}"
                        onerror="this.closest('.cert-img-wrap').style.display='none'; this.closest('.cert-card').querySelector('.cert-ph').style.display='flex';"
                    >
                </div>
                <div class="cert-ph">🏆</div>
                <div class="cert-body">
                    <div class="cert-name">{{ $cert->title }}</div>
                    @if($cert->issued_by)
                        <div class="cert-issuer">{{ $cert->issued_by }}</div>
                    @endif
                    @if($cert->issued_date)
                        <div class="cert-date">{{ $cert->issued_date->format('d M Y') }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>

<!-- Clients -->
@if($clients->isNotEmpty())
<div class="clients-section">
    <div class="clients-inner">
        <div class="clients-lbl">Telah Bekerja Sama Dengan</div>
        <div class="clients-grid">
            @foreach($clients as $client)
            <div class="client-item">
                <img src="{{ asset('storage/' . $client->partner_logo) }}" alt="{{ $client->partner_name }}" class="client-logo">
                <span class="client-name">{{ $client->partner_name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

<!-- Footer -->
<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            SAT<span class="logo-dot">.</span>
            <span class="logo-x">×</span>
            <img class="logo-icon" src="/logosat-white.svg" alt="SAT logo mark" width="14" height="14">
        </div>
        <div class="footer-links">
            <a href="mailto:syarifahsanit@gmail.com">syarifahsanit@gmail.com</a>
            <a href="https://instagram.com/syariif.at" target="_blank" rel="noopener">@syariif.at</a>
        </div>
        <div class="footer-copy">© {{ date('Y') }} Syarif Ahsani Taqwim</div>
    </div>
</footer>

<!-- Modal -->
<div class="modal-overlay" id="certModal" onclick="closeModal()">
    <button class="modal-close" onclick="closeModal()" aria-label="Tutup">✕</button>
    <img src="" alt="Sertifikat" class="modal-img" id="modalImg" onclick="event.stopPropagation()">
</div>

<!-- AI Chat Floating Button -->
<button class="ai-chat-btn" id="aiChatToggle" aria-label="Tanya SAT AI">
    <div class="ai-chat-pulse"></div>
    <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
    </svg>
    <span>Tanya SAT AI</span>
</button>

<!-- AI Chat Box -->
<div class="ai-chat-box" id="aiChatBox" aria-hidden="true">
    <div class="ai-chat-header">
        <div class="ai-chat-header-info">
            <div class="ai-avatar">
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div>
                <div class="ai-chat-title">SAT Assistant</div>
                <div class="ai-chat-subtitle">● Online</div>
            </div>
        </div>
        <button class="ai-chat-close" id="aiChatClose" aria-label="Tutup Chat">✕</button>
    </div>

    <div class="ai-chat-body" id="aiChatBody">
        <div class="ai-msg bot">
            <div class="ai-msg-bubble">
                Halo! Saya <strong>SAT Assistant</strong> 👋. Ada yang ingin Anda ketahui tentang Syarif, keahliannya, atau proyek yang pernah ia garap?
            </div>
        </div>
    </div>

    <div class="ai-pills">
        <button class="ai-pill" onclick="sendQuickPill('Siapa Syarif Ahsani Taqwim?')">👋 Siapa Syarif?</button>
        <button class="ai-pill" onclick="sendQuickPill('Apa saja keahlian utamanya?')">⚡ Keahlian Utama</button>
        <button class="ai-pill" onclick="sendQuickPill('Ada proyek IoT apa saja?')">📡 Proyek IoT</button>
        <button class="ai-pill" onclick="sendQuickPill('Bagaimana cara menghubungi Syarif?')">📞 Kontak WA</button>
    </div>

    <div class="ai-chat-footer">
        <input type="text" class="ai-chat-input" id="aiChatInput" placeholder="Tulis pertanyaan Anda..." autocomplete="off">
        <button class="ai-chat-send" id="aiChatSend" aria-label="Kirim Pesan">
            <svg width="15" height="15" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9-7-9-7v5l-9 2 9 2v5z"/>
            </svg>
        </button>
    </div>
</div>

<script>
    // Hamburger
    const hamburger = document.getElementById('hamburger');
    const navLinks  = document.getElementById('navLinks');
    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });

    document.querySelectorAll('.fade-up, .project-entry').forEach(el => observer.observe(el));

    // Load More Projects Pagination
    (function() {
        const btnLoadMore = document.getElementById('btn-load-more');
        if (btnLoadMore) {
            btnLoadMore.addEventListener('click', () => {
                const hiddenProjects = document.querySelectorAll('.project-entry.hidden-chunk');
                const chunkSize = 3;
                const showCount = Math.min(chunkSize, hiddenProjects.length);
                for (let i = 0; i < showCount; i++) {
                    hiddenProjects[i].classList.remove('hidden-chunk');
                }
                
                const remainingHidden = document.querySelectorAll('.project-entry.hidden-chunk');
                if (remainingHidden.length === 0) {
                    btnLoadMore.closest('.load-more-wrap').style.display = 'none';
                }
            });
            
            const totalHidden = document.querySelectorAll('.project-entry.hidden-chunk');
            if (totalHidden.length === 0) {
                btnLoadMore.closest('.load-more-wrap').style.display = 'none';
            }
        }
    })();

    // Modal
    function openModal(imgSrc) {
        document.getElementById('modalImg').src = imgSrc;
        document.getElementById('certModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('certModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

    // ===== AI CHAT WIDGET =====
    const aiChatToggle = document.getElementById('aiChatToggle');
    const aiChatBox    = document.getElementById('aiChatBox');
    const aiChatClose  = document.getElementById('aiChatClose');
    const aiChatBody   = document.getElementById('aiChatBody');
    const aiChatInput  = document.getElementById('aiChatInput');
    const aiChatSend   = document.getElementById('aiChatSend');

    let chatHistory = [];
    let isAiThinking = false;

    function toggleAiChat() {
        const isOpen = aiChatBox.classList.toggle('open');
        aiChatBox.setAttribute('aria-hidden', !isOpen);
        if (isOpen) {
            aiChatInput.focus();
        }
    }

    aiChatToggle.addEventListener('click', toggleAiChat);
    aiChatClose.addEventListener('click', toggleAiChat);

    function appendMessage(role, text) {
        const msgDiv = document.createElement('div');
        msgDiv.className = `ai-msg ${role}`;
        
        const bubble = document.createElement('div');
        bubble.className = 'ai-msg-bubble';
        
        if (role === 'bot') {
            bubble.innerHTML = text.replace(/\n/g, '<br>');
        } else {
            bubble.textContent = text;
        }

        msgDiv.appendChild(bubble);
        aiChatBody.appendChild(msgDiv);
        aiChatBody.scrollTop = aiChatBody.scrollHeight;

        chatHistory.push({ role: role === 'bot' ? 'assistant' : 'user', content: text });
    }

    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'ai-msg bot';
        typingDiv.id = 'aiTypingIndicator';
        typingDiv.innerHTML = `
            <div class="ai-msg-bubble">
                <div class="ai-typing-dots">
                    <div class="ai-typing-dot"></div>
                    <div class="ai-typing-dot"></div>
                    <div class="ai-typing-dot"></div>
                </div>
            </div>
        `;
        aiChatBody.appendChild(typingDiv);
        aiChatBody.scrollTop = aiChatBody.scrollHeight;
    }

    function removeTypingIndicator() {
        const indicator = document.getElementById('aiTypingIndicator');
        if (indicator) indicator.remove();
    }

    async function sendAiMessage() {
        const message = aiChatInput.value.trim();
        if (!message || isAiThinking) return;

        appendMessage('user', message);
        aiChatInput.value = '';
        isAiThinking = true;
        showTypingIndicator();

        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

        try {
            const res = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken || ''
                },
                body: JSON.stringify({
                    message: message,
                    history: chatHistory.slice(-6)
                })
            });

            const data = await res.json();
            removeTypingIndicator();
            isAiThinking = false;

            if (res.ok && data.success) {
                appendMessage('bot', data.reply);
            } else {
                appendMessage('bot', data.error || 'Maaf, terjadi masalah saat memproses pesan.');
            }

        } catch (err) {
            removeTypingIndicator();
            isAiThinking = false;
            appendMessage('bot', 'Maaf, gagal terhubung ke server. Silakan periksa koneksi internet Anda.');
        }
    }

    aiChatSend.addEventListener('click', sendAiMessage);
    aiChatInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') sendAiMessage();
    });

    window.sendQuickPill = function(questionText) {
        if (!aiChatBox.classList.contains('open')) {
            toggleAiChat();
        }
        aiChatInput.value = questionText;
        sendAiMessage();
    };

    // ===== CANVAS DOT RIPPLE =====
    (function() {
        const canvas = document.getElementById('dot-canvas');
        const ctx    = canvas.getContext('2d');
        const S      = 26;        // grid spacing (px)
        const DOT_R  = 0.85;     // dot radius
        const WAVE_R = 160;      // ripple influence radius (px)
        const BASE_A = 0.04;     // base dot opacity
        let mx = -9999, my = -9999;

        function resize() {
            canvas.width  = window.innerWidth;
            canvas.height = window.innerHeight;
        }
        resize();
        window.addEventListener('resize', resize);

        document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
        document.addEventListener('mouseleave', () => { mx = -9999; my = -9999; });

        function draw(ts) {
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            const cols = Math.ceil(canvas.width  / S) + 1;
            const rows = Math.ceil(canvas.height / S) + 1;

            for (let r = 0; r <= rows; r++) {
                for (let c = 0; c <= cols; c++) {
                    const bx = c * S;
                    const by = r * S;

                    const dx   = bx - mx;
                    const dy   = by - my;
                    const dist = Math.sqrt(dx * dx + dy * dy);

                    let alpha = BASE_A;
                    let ox = 0, oy = 0;

                    if (dist < WAVE_R) {
                        // Quadratic falloff so edge fades smoothly
                        const norm    = dist / WAVE_R;
                        const falloff = (1 - norm) * (1 - norm);
                        // Phase: rings travel outward over time
                        const phase   = dist * 0.1 - ts * 0.0038;
                        const wave    = Math.sin(phase) * falloff;

                        // Brightness oscillates around base
                        alpha = BASE_A + wave * 0.20;
                        alpha = Math.max(0.01, Math.min(0.28, alpha));

                        // Slight radial displacement — dots push in/out
                        if (dist > 1) {
                            const push = wave * 2.8;
                            ox = (dx / dist) * push;
                            oy = (dy / dist) * push;
                        }
                    }

                    ctx.beginPath();
                    ctx.arc(bx + ox, by + oy, DOT_R, 0, Math.PI * 2);
                    ctx.fillStyle = `rgba(255,255,255,${alpha.toFixed(3)})`;
                    ctx.fill();
                }
            }

            requestAnimationFrame(draw);
        }

        requestAnimationFrame(draw);
    })();
</script>
</body>
</html>
