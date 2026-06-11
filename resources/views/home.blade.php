<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio Syarif Ahsani Taqwim - Full-Stack Developer, IoT Engineer, dan IT Infrastructure Specialist dari Tulungagung.">
    <title>Syarif Ahsani Taqwim | Portfolio</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
            --secondary: #8b5cf6;
            --accent: #06b6d4;
            --bg-dark: #050508;
            --bg-card: #0d0d18;
            --bg-card2: #111120;
            --border: rgba(99, 102, 241, 0.15);
            --border-hover: rgba(99, 102, 241, 0.4);
            --text-primary: #f1f5f9;
            --text-secondary: #94a3b8;
            --text-muted: #64748b;
            --gradient-1: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #06b6d4 100%);
            --gradient-2: linear-gradient(135deg, #1e1b4b 0%, #1e1035 100%);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-dark); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

        /* ===== NAVBAR ===== */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            padding: 1rem 2rem;
            background: rgba(5, 5, 8, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.4rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: color 0.3s;
            letter-spacing: 0.02em;
        }

        .nav-links a:hover { color: var(--primary); }

        .nav-hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
        }

        .nav-hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background: var(--text-primary);
            border-radius: 2px;
            transition: all 0.3s;
        }

        /* ===== HERO ===== */
        #hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 6rem 2rem 4rem;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 80% at 50% -20%, rgba(99, 102, 241, 0.25) 0%, transparent 60%),
                        radial-gradient(ellipse 50% 50% at 80% 80%, rgba(139, 92, 246, 0.15) 0%, transparent 50%);
        }

        .hero-grid {
            position: absolute;
            inset: 0;
            background-image: linear-gradient(rgba(99, 102, 241, 0.04) 1px, transparent 1px),
                              linear-gradient(90deg, rgba(99, 102, 241, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        .hero-content {
            position: relative;
            z-index: 1;
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            border-radius: 50px;
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            animation: fadeInDown 0.8s ease;
        }

        .hero-badge::before {
            content: '';
            width: 6px;
            height: 6px;
            background: #22c55e;
            border-radius: 50%;
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-name {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            margin-bottom: 1rem;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .hero-name span {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-title {
            font-size: clamp(1rem, 2.5vw, 1.3rem);
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            font-weight: 400;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-info {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
            animation: fadeInUp 0.8s ease 0.5s both;
        }

        .hero-info-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .hero-info-item svg {
            color: var(--primary);
            flex-shrink: 0;
        }

        .hero-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 0.8s ease 0.6s both;
        }

        .hero-social a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1.2rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.8rem;
            transition: all 0.3s;
        }

        .hero-social a:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
            color: var(--primary);
            transform: translateY(-2px);
        }

        .hero-cta {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.7s both;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: var(--gradient-1);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background: transparent;
            color: var(--text-primary);
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            border: 1px solid var(--border-hover);
            transition: all 0.3s;
        }

        .btn-outline:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-muted);
            font-size: 0.75rem;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-6px); }
        }

        /* ===== SECTIONS ===== */
        section {
            padding: 5rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }

        .section-tag {
            display: inline-block;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.3);
            color: var(--primary);
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: clamp(1.75rem, 4vw, 2.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Divider */
        .section-divider {
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--border), transparent);
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ===== ABOUT ===== */
        .about-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }

        .about-text p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.25rem;
            text-align: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .stat-number {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* ===== SKILLS ===== */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .skill-category {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.75rem;
            transition: all 0.3s;
            position: relative;
            overflow: hidden;
        }

        .skill-category::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--gradient-1);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .skill-category:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .skill-category:hover::before { opacity: 1; }

        .skill-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.4rem;
        }

        .skill-icon.purple { background: rgba(139, 92, 246, 0.15); }
        .skill-icon.blue { background: rgba(99, 102, 241, 0.15); }
        .skill-icon.cyan { background: rgba(6, 182, 212, 0.15); }
        .skill-icon.green { background: rgba(34, 197, 94, 0.15); }

        .skill-category h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: var(--text-primary);
        }

        .skill-category p {
            font-size: 0.85rem;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        /* ===== TECH STACK ===== */
        .tech-table-container {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        .tech-table {
            width: 100%;
            border-collapse: collapse;
        }

        .tech-table thead {
            background: rgba(99, 102, 241, 0.1);
        }

        .tech-table th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .tech-table td {
            padding: 1rem 1.5rem;
            font-size: 0.875rem;
            color: var(--text-secondary);
            border-top: 1px solid var(--border);
        }

        .tech-table tr:hover td {
            background: rgba(99, 102, 241, 0.04);
        }

        .tech-table td:first-child {
            color: var(--text-primary);
            font-weight: 500;
        }

        .tech-tag {
            display: inline-block;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: #a5b4fc;
            font-size: 0.72rem;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            margin: 0.15rem;
        }

        /* ===== TIMELINE ===== */
        .timeline {
            position: relative;
            padding: 1rem 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: 28px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: linear-gradient(to bottom, var(--primary), var(--secondary), transparent);
        }

        .timeline-item {
            display: flex;
            gap: 2rem;
            margin-bottom: 2.5rem;
            position: relative;
            opacity: 0;
            transform: translateX(-20px);
            transition: all 0.6s ease;
        }

        .timeline-item.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .timeline-dot {
            flex-shrink: 0;
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: var(--bg-card);
            border: 2px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            position: relative;
            z-index: 1;
            box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
        }

        .timeline-card {
            flex: 1;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .timeline-card:hover {
            border-color: var(--border-hover);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .timeline-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .timeline-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .timeline-date {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(99, 102, 241, 0.1);
            border: 1px solid rgba(99, 102, 241, 0.2);
            color: var(--primary);
            font-size: 0.75rem;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            white-space: nowrap;
        }

        .timeline-partner {
            color: var(--accent);
            font-size: 0.825rem;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .timeline-desc {
            color: var(--text-secondary);
            font-size: 0.875rem;
            line-height: 1.7;
        }

        .timeline-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 0.75rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.72rem;
            padding: 0.2rem 0.6rem;
            border-radius: 4px;
            font-weight: 500;
        }

        .status-badge.completed {
            background: rgba(34, 197, 94, 0.1);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.2);
        }

        .status-badge.ongoing {
            background: rgba(251, 191, 36, 0.1);
            color: #fbbf24;
            border: 1px solid rgba(251, 191, 36, 0.2);
        }

        .timeline-empty {
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
        }

        /* ===== CERTIFICATES ===== */
        .certs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .cert-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s;
            cursor: pointer;
        }

        .cert-card:hover {
            border-color: var(--border-hover);
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .cert-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: var(--bg-card2);
        }

        .cert-image-placeholder {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, var(--bg-card2), rgba(99, 102, 241, 0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        .cert-body {
            padding: 1.25rem;
        }

        .cert-title {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 0.4rem;
        }

        .cert-issuer {
            font-size: 0.8rem;
            color: var(--primary);
            margin-bottom: 0.4rem;
        }

        .cert-date {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .cert-empty {
            grid-column: 1 / -1;
            text-align: center;
            padding: 3rem;
            color: var(--text-muted);
        }

        /* ===== CLIENTS ===== */
        .clients-section {
            padding: 4rem 2rem;
            text-align: center;
            background: rgba(99, 102, 241, 0.03);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .clients-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            max-width: 1200px;
            margin: 2rem auto 0;
        }

        .client-logo-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }

        .client-logo {
            width: 100px;
            height: 70px;
            object-fit: contain;
            filter: grayscale(80%) brightness(1.5);
            transition: all 0.3s;
            padding: 0.5rem;
        }

        .client-logo:hover {
            filter: grayscale(0%) brightness(1);
            transform: scale(1.1);
        }

        .client-name-label {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .clients-empty {
            color: var(--text-muted);
            font-size: 0.9rem;
            padding: 2rem;
        }

        /* ===== FOOTER ===== */
        footer {
            background: var(--bg-card);
            border-top: 1px solid var(--border);
            padding: 2rem;
            text-align: center;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        footer a { color: var(--primary); text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.7s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ===== MODAL ===== */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(4px);
            z-index: 2000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .modal-overlay.active {
            opacity: 1;
            pointer-events: all;
        }

        .modal-img {
            max-width: 90vw;
            max-height: 85vh;
            border-radius: 12px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.8);
            object-fit: contain;
        }

        .modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50%;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .modal-close:hover { background: rgba(255, 255, 255, 0.2); }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            nav { padding: 1rem 1.25rem; }

            .nav-links {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: rgba(5, 5, 8, 0.98);
                flex-direction: column;
                padding: 1.5rem;
                border-bottom: 1px solid var(--border);
            }

            .nav-links.open { display: flex; }
            .nav-hamburger { display: flex; }

            section { padding: 3.5rem 1.25rem; }

            .about-grid { grid-template-columns: 1fr; }
            .about-stats { grid-template-columns: repeat(2, 1fr); }

            .timeline::before { left: 20px; }
            .timeline-dot { width: 42px; height: 42px; font-size: 1rem; }

            .hero-info { flex-direction: column; align-items: center; }

            .certs-grid { grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); }

            .skills-grid { grid-template-columns: 1fr; }

            .tech-table { font-size: 0.8rem; }
            .tech-table th, .tech-table td { padding: 0.75rem 1rem; }
        }

        @media (max-width: 480px) {
            .hero-cta { flex-direction: column; align-items: center; }
            .about-stats { grid-template-columns: 1fr 1fr; }
            .timeline-header { flex-direction: column; }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav id="navbar">
    <div class="nav-container">
        <a href="#hero" class="nav-logo">SAT.</a>
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
    <div class="hero-bg"></div>
    <div class="hero-grid"></div>
    <div class="hero-content">
        <div class="hero-badge">
            <span>Tersedia untuk proyek baru</span>
        </div>
        <h1 class="hero-name">
            Syarif Ahsani<br><span>Taqwim</span>
        </h1>
        <p class="hero-title">
            Full-Stack Developer &bull; IoT Engineer &bull; IT Infrastructure Specialist
        </p>
        <div class="hero-info">
            <span class="hero-info-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Ds. Batangsaren, Kauman, Tulungagung
            </span>
            <span class="hero-info-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                02 Maret 2005
            </span>
            <span class="hero-info-item">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 7V5z"/>
                </svg>
                +62 878-4294-9212
            </span>
        </div>
        <div class="hero-social">
            <a href="mailto:syarifahsanit@gmail.com" id="email-link">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                syarifahsanit@gmail.com
            </a>
            <a href="https://instagram.com/syariif.at" target="_blank" rel="noopener" id="instagram-link">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                </svg>
                @syariif.at
            </a>
        </div>
        <div class="hero-cta">
            <a href="#timeline" class="btn-primary" id="view-projects-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                Lihat Proyek
            </a>
            <a href="mailto:syarifahsanit@gmail.com" class="btn-outline" id="contact-btn">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Hubungi Saya
            </a>
        </div>
    </div>
    <div class="scroll-indicator">
        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
        </svg>
    </div>
</section>

<div class="section-divider"></div>

<!-- About Me -->
<section id="about">
    <div class="section-header fade-in">
        <span class="section-tag">Tentang Saya</span>
        <h2 class="section-title">Siapa Saya?</h2>
    </div>
    <div class="about-grid fade-in">
        <div class="about-text">
            <p>
                Halo, saya <strong style="color: var(--text-primary)">Syarif</strong>. Bagi saya, inovasi teknologi adalah harmoni antara logika perangkat lunak dan arsitektur perangkat keras.
            </p>
            <p>
                Berpengalaman di bidang <strong style="color: var(--primary)">Full-Stack Development</strong>, <strong style="color: var(--primary)">Mobile Development</strong>, dan <strong style="color: var(--primary)">Internet of Things (IoT)</strong>, saya memiliki antusiasme mendalam dalam menjembatani dunia fisik dengan ekosistem digital.
            </p>
            <p>
                Sebagai <strong style="color: var(--accent)">Founder dari SAT Project </strong>, saya mendedikasikan diri untuk merancang, mengelola, dan mengimplementasikan berbagai solusi teknologi end-to-end — mulai dari sistem otomatisasi cerdas, aplikasi manajemen terintegrasi, hingga pemeliharaan infrastruktur IT skala perusahaan.
            </p>
            <p>
                Dengan pendekatan yang selalu berfokus pada efisiensi, performa, dan skalabilitas, saya siap berkolaborasi untuk mengubah ide-ide kompleks menjadi solusi digital yang nyata dan berdampak.
            </p>
        </div>
        <div class="about-stats">
            <div class="stat-card">
                <div class="stat-number">{{ $projects->count() }}+</div>
                <div class="stat-label">Proyek Selesai</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $clients->count() }}+</div>
                <div class="stat-label">Klien Puas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">4+</div>
                <div class="stat-label">Bidang Keahlian</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $certificates->count() }}+</div>
                <div class="stat-label">Sertifikat</div>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

<!-- Skills -->
<section id="skills">
    <div class="section-header fade-in">
        <span class="section-tag">Keahlian</span>
        <h2 class="section-title">Area Kompetensi</h2>
        <p class="section-subtitle">Cakupan keahlian yang luas dari software hingga hardware dan jaringan enterprise.</p>
    </div>
    <div class="skills-grid">
        <div class="skill-category fade-in">
            <div class="skill-icon purple">💻</div>
            <h3>Software Development</h3>
            <p>Full-Stack Web Development dengan PHP/Laravel, JavaScript, HTML/CSS. Mobile Development untuk platform Android & iOS menggunakan teknologi modern.</p>
        </div>
        <div class="skill-category fade-in">
            <div class="skill-icon cyan">🔌</div>
            <h3>Internet of Things (IoT)</h3>
            <p>Perancangan perangkat keras cerdas, pemrograman mikrokontroler (ESP32, ESP8266, Arduino), dan integrasi sistem fisik ke ekosistem digital.</p>
        </div>
        <div class="skill-category fade-in">
            <div class="skill-icon blue">⚙️</div>
            <h3>IT Infrastructure & DevOps</h3>
            <p>Administrasi server Linux (SysAdmin), cloud deployment di Vercel & Cloudflare, containerisasi dengan Docker, dan pengelolaan home/enterprise server.</p>
        </div>
        <div class="skill-category fade-in">
            <div class="skill-icon green">🔐</div>
            <h3>Enterprise Networking & IT Support</h3>
            <p>Konfigurasi jaringan Cisco & MikroTik, manajemen DHCP/DNS/Firewall, serta implementasi sistem VoIP, CCTV, dan keamanan IT enterprise.</p>
        </div>
    </div>
</section>

<div class="section-divider"></div>

<!-- Tech Stack -->
<section id="techstack">
    <div class="section-header fade-in">
        <span class="section-tag">Tech Stack</span>
        <h2 class="section-title">Teknologi & Perangkat</h2>
        <p class="section-subtitle">Kumpulan teknologi, tools, sensor, server, dan alat jaringan yang pernah saya tangani.</p>
    </div>
    <div class="tech-table-container fade-in">
        <table class="tech-table">
            <thead>
                <tr>
                    <th>Kategori</th>
                    <th>Teknologi & Perangkat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Framework & Language</td>
                    <td>
                        <span class="tech-tag">PHP</span>
                        <span class="tech-tag">Laravel</span>
                        <span class="tech-tag">JavaScript</span>
                        <span class="tech-tag">HTML/CSS</span>
                        <span class="tech-tag">Mobile/iOS</span>
                    </td>
                </tr>
                <tr>
                    <td>Database & Storage</td>
                    <td>
                        <span class="tech-tag">MySQL</span>
                        <span class="tech-tag">Cloudflare D1 (SQLite)</span>
                        <span class="tech-tag">Cloudflare R2</span>
                    </td>
                </tr>
                <tr>
                    <td>IoT & Hardware</td>
                    <td>
                        <span class="tech-tag">ESP32</span>
                        <span class="tech-tag">ESP8266</span>
                        <span class="tech-tag">Arduino</span>
                        <span class="tech-tag">RFID Readers</span>
                        <span class="tech-tag">Ultrasonic Sensors</span>
                        <span class="tech-tag">Load Cell HX711</span>
                        <span class="tech-tag">GPS NEO-6M</span>
                    </td>
                </tr>
                <tr>
                    <td>Cloud & Server</td>
                    <td>
                        <span class="tech-tag">Vercel</span>
                        <span class="tech-tag">Cloudflare</span>
                        <span class="tech-tag">Docker</span>
                        <span class="tech-tag">aaPanel</span>
                        <span class="tech-tag">Linux Server</span>
                    </td>
                </tr>
                <tr>
                    <td>Hardware Modding</td>
                    <td>
                        <span class="tech-tag">Armbian</span>
                        <span class="tech-tag">STB HG680P</span>
                        <span class="tech-tag">B860H</span>
                        <span class="tech-tag">SSD Storage</span>
                        <span class="tech-tag">Home Server Setup</span>
                    </td>
                </tr>
                <tr>
                    <td>Networking & Security</td>
                    <td>
                        <span class="tech-tag">Cisco</span>
                        <span class="tech-tag">MikroTik</span>
                        <span class="tech-tag">DHCP</span>
                        <span class="tech-tag">DNS</span>
                        <span class="tech-tag">Firewall</span>
                    </td>
                </tr>
                <tr>
                    <td>Enterprise IT & Comms</td>
                    <td>
                        <span class="tech-tag">VoIP Systems</span>
                        <span class="tech-tag">CCTV Integration</span>
                        <span class="tech-tag">Enterprise IT Support</span>
                    </td>
                </tr>
                <tr>
                    <td>Integrations & APIs</td>
                    <td>
                        <span class="tech-tag">WhatsApp API Gateway</span>
                        <span class="tech-tag">Payment Gateway</span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</section>

<div class="section-divider"></div>

<!-- Timeline / Projects -->
<section id="timeline">
    <div class="section-header fade-in">
        <span class="section-tag">Portfolio</span>
        <h2 class="section-title">Timeline Proyek</h2>
        <p class="section-subtitle">Rekam jejak proyek-proyek yang telah saya kerjakan secara kronologis.</p>
    </div>

    @if($projects->isEmpty())
        <div class="timeline-empty fade-in">
            <div style="font-size: 3rem; margin-bottom: 1rem;">📁</div>
            <p>Belum ada proyek yang ditambahkan.</p>
            <p style="font-size: 0.8rem; margin-top: 0.5rem;">Login sebagai admin untuk menambahkan proyek.</p>
        </div>
    @else
        <div class="timeline">
            @foreach($projects as $index => $project)
            <div class="timeline-item">
                <div class="timeline-dot">
                    @if($project->category && str_contains(strtolower($project->category), 'iot'))
                        🔌
                    @elseif($project->category && str_contains(strtolower($project->category), 'web'))
                        🌐
                    @elseif($project->category && str_contains(strtolower($project->category), 'mobile'))
                        📱
                    @elseif($project->category && str_contains(strtolower($project->category), 'network'))
                        🔐
                    @else
                        ⚙️
                    @endif
                </div>
                <div class="timeline-card">
                    <div class="timeline-header">
                        <span class="timeline-title">{{ $project->title }}</span>
                        <span class="timeline-date">
                            <svg width="10" height="10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $project->start_date->format('M Y') }}
                            @if($project->end_date)
                                – {{ $project->end_date->format('M Y') }}
                            @else
                                – Sekarang
                            @endif
                        </span>
                    </div>
                    @if($project->partner_name)
                    <div class="timeline-partner">
                        <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/>
                        </svg>
                        Mitra: {{ $project->partner_name }}
                    </div>
                    @endif
                    <p class="timeline-desc">{{ $project->description }}</p>
                    <div class="timeline-tags">
                        <span class="status-badge {{ $project->status }}">
                            @if($project->status === 'completed') ✓ Selesai @else ⏳ Berlangsung @endif
                        </span>
                        @if($project->category)
                            <span class="tech-tag">{{ $project->category }}</span>
                        @endif
                        @if($project->tech_stack)
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="tech-tag">{{ trim($tech) }}</span>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</section>

<div class="section-divider"></div>

<!-- Certificates -->
<section id="certificates">
    <div class="section-header fade-in">
        <span class="section-tag">Sertifikat</span>
        <h2 class="section-title">Pencapaian & Sertifikasi</h2>
        <p class="section-subtitle">Sertifikat dan penghargaan yang telah saya raih.</p>
    </div>
    <div class="certs-grid">
        @if($certificates->isEmpty())
            <div class="cert-empty fade-in">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🏆</div>
                <p>Belum ada sertifikat yang ditambahkan.</p>
            </div>
        @else
            @foreach($certificates as $cert)
            <div class="cert-card fade-in" onclick="openModal('{{ $cert->image_url }}')" id="cert-{{ $cert->id }}">
                <img
                    src="{{ $cert->image_url }}"
                    alt="{{ $cert->title }}"
                    class="cert-image"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                >
                <div class="cert-image-placeholder" style="display:none;">🏆</div>
                <div class="cert-body">
                    <div class="cert-title">{{ $cert->title }}</div>
                    @if($cert->issued_by)
                        <div class="cert-issuer">{{ $cert->issued_by }}</div>
                    @endif
                    @if($cert->issued_date)
                        <div class="cert-date">
                            {{ $cert->issued_date->format('d M Y') }}
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        @endif
    </div>
</section>

<!-- Our Clients -->
@if($clients->isNotEmpty())
<div class="clients-section">
    <div class="section-header">
        <span class="section-tag">Klien</span>
        <h2 class="section-title">Our Clients</h2>
        <p class="section-subtitle">Mitra dan klien yang telah mempercayakan proyek mereka kepada saya.</p>
    </div>
    <div class="clients-grid">
        @foreach($clients as $client)
        <div class="client-logo-wrap">
            <img src="{{ asset('storage/' . $client->partner_logo) }}" alt="{{ $client->partner_name }}" class="client-logo">
            <span class="client-name-label">{{ $client->partner_name }}</span>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Footer -->
<footer>
    <p>© {{ date('Y') }} <strong>Syarif Ahsani Taqwim</strong> &mdash; Founder of SAT Project</p>
    <p style="margin-top: 0.5rem;">
        <a href="mailto:syarifahsanit@gmail.com">syarifahsanit@gmail.com</a>
        &bull;
        <a href="https://instagram.com/syariif.at" target="_blank">@syariif.at</a>
    </p>
</footer>

<!-- Modal -->
<div class="modal-overlay" id="certModal" onclick="closeModal()">
    <button class="modal-close" onclick="closeModal()" aria-label="Tutup">✕</button>
    <img src="" alt="Sertifikat" class="modal-img" id="modalImg" onclick="event.stopPropagation()">
</div>

<script>
    // Hamburger menu
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.getElementById('navLinks');
    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => navLinks.classList.remove('open')));

    // Scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.fade-in, .timeline-item').forEach(el => observer.observe(el));

    // Navbar scroll
    window.addEventListener('scroll', () => {
        const nav = document.getElementById('navbar');
        nav.style.boxShadow = window.scrollY > 50 ? '0 4px 30px rgba(0,0,0,0.4)' : '';
    });

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

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeModal();
    });
</script>
</body>
</html>
