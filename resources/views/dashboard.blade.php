<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>myClienteye Dashboard</title>

    <!-- Tailwind + Inter + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />

    <style>
        /* ─── base & sidebar ─── */
        * {
            box-sizing: border-box;
            margin: 0;
        }

        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background: #f4f7fb;
            color: #0e1a24;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: #0e1a24;
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 50;
        }

        .sidebar-brand {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 9px 14px;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            font-weight: 500;
            transition: all 0.15s;
            text-decoration: none;
            margin-bottom: 2px;
            cursor: pointer;
        }

        .sidebar-nav a:hover {
            background: rgba(255, 255, 255, 0.06);
            color: #fff;
        }

        .sidebar-nav a.active {
            background: rgba(52, 211, 153, 0.12);
            color: #34d399;
        }

        .sidebar-nav a .material-icons-outlined {
            font-size: 20px;
        }

        .sidebar-nav a .badge-count {
            margin-left: auto;
            font-size: 0.65rem;
            background: rgba(255, 255, 255, 0.08);
            padding: 1px 10px;
            border-radius: 40px;
            color: rgba(255, 255, 255, 0.4);
        }

        .sidebar-nav a.active .badge-count {
            background: rgba(52, 211, 153, 0.15);
            color: #34d399;
        }

        .sidebar-footer {
            padding: 12px 20px 18px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.2);
        }

        .main-wrap {
            flex: 1;
            min-width: 0;
            padding: 24px 32px 32px;
        }

        .stat-card {
            background: #fff;
            border-radius: 16px;
            padding: 18px 20px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
            border: 1px solid rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.2s;
        }

        .stat-card:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .stat-icon.green {
            background: #e4f5ed;
            color: #0d9e6b;
        }

        .stat-icon.blue {
            background: #e3edfa;
            color: #1f7ae0;
        }

        .stat-icon.amber {
            background: #fef0e0;
            color: #b26f0a;
        }

        .stat-icon.slate {
            background: #eef1f4;
            color: #4a5b68;
        }

        .table-wrap {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #e9edf2;
            overflow: hidden;
        }

        .table-wrap table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }

        .table-wrap thead {
            background: #fafcfe;
        }

        .table-wrap thead th {
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #50626e;
            border-bottom: 1px solid #e9edf2;
            white-space: nowrap;
        }

        .table-wrap tbody td {
            padding: 11px 16px;
            border-bottom: 1px solid #f0f4f8;
            color: #16222b;
        }

        .table-wrap tbody tr:last-child td {
            border-bottom: 0;
        }

        .table-wrap tbody tr:hover {
            background: #fafdff;
        }

        /* clickable rows */
        .table-wrap tbody tr {
            cursor: pointer;
            transition: background 0.15s;
        }

        .table-wrap tbody tr:hover {
            background: #f0f7ff !important;
        }

        .today-row {
            background-color: #ecfdf5 !important;
        }

        .today-row:hover {
            background-color: #d1fae5 !important;
        }

        .badge {
            display: inline-block;
            padding: 1px 12px;
            border-radius: 40px;
            font-size: 0.65rem;
            font-weight: 600;
            background: #eef2f5;
            color: #3d4f5a;
        }

        .badge.green {
            background: #def5ea;
            color: #0d7a54;
        }

        .badge.amber {
            background: #fdf1de;
            color: #b26f0a;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #fff;
            border: 1px solid #e2e8ee;
            border-radius: 40px;
            padding: 0 14px 0 12px;
            transition: border 0.2s, box-shadow 0.2s;
            min-width: 180px;
        }

        .search-box:focus-within {
            border-color: #34d399;
            box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.1);
        }

        .search-box input {
            border: 0;
            outline: 0;
            background: transparent;
            padding: 9px 0;
            font-size: 0.85rem;
            width: 100%;
            color: #0e1a24;
        }

        .search-box input::placeholder {
            color: #97aab6;
        }

        .filter-group label {
            font-size: 0.7rem;
            font-weight: 600;
            color: #50626e;
            margin-right: 2px;
        }

        .filter-group input[type="date"] {
            border: 1px solid #e2e8ee;
            border-radius: 6px;
            padding: 4px 8px;
            font-size: 0.8rem;
            background: #fff;
            outline: 0;
            transition: border 0.2s;
        }

        .filter-group input[type="date"]:focus {
            border-color: #34d399;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 14px;
            border-radius: 40px;
            font-size: 0.75rem;
            font-weight: 600;
            border: 0;
            cursor: pointer;
            transition: all 0.15s;
            background: #eef2f5;
            color: #1d2b33;
        }

        .btn:hover {
            background: #e2e8ee;
        }

        .btn-primary {
            background: #0e1a24;
            color: #fff;
        }

        .btn-primary:hover {
            background: #1d2b33;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #e2e8ee;
        }

        .btn-outline:hover {
            background: #f6f8fb;
        }

        .btn-sm {
            padding: 3px 10px;
            font-size: 0.7rem;
        }

        .btn-danger {
            background: #f44336;
            color: #fff;
        }

        .btn-danger:hover {
            background: #d32f2f;
        }

        .text-muted {
            color: #6a7f8b;
        }

        .pulse-dot {
            display: inline-block;
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: #34d399;
            animation: pulse 1.8s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.3;
                transform: scale(0.8);
            }
        }

        .section-calls,
        .section-tours,
        .section-timeslots {
            display: block;
        }

        .section-calls.hidden,
        .section-tours.hidden,
        .section-timeslots.hidden {
            display: none !important;
        }

        .menu-toggle {
            background: none;
            border: 0;
            font-size: 26px;
            color: #0e1a24;
            cursor: pointer;
            display: none;
            padding: 4px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 40;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                width: 280px;
                border-radius: 0;
                z-index: 50;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-wrap {
                padding: 16px;
            }

            .menu-toggle {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        }

        @media (max-width: 640px) {
            .table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-wrap table {
                font-size: 0.75rem;
                min-width: 600px;
            }
        }

        /* ─── MODAL ─── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: #fff;
            border-radius: 20px;
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            padding: 32px 32px 28px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
            animation: modalFadeIn 0.25s ease;
            position: relative;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: scale(0.96) translateY(12px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: 0;
            font-size: 28px;
            cursor: pointer;
            color: #6a7f8b;
            transition: color 0.2s;
            padding: 4px;
            line-height: 1;
        }

        .modal-close:hover {
            color: #0e1a24;
        }

        .modal-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
            padding-right: 40px;
        }

        .modal-header .material-icons-outlined {
            font-size: 28px;
            color: #0d9e6b;
        }

        .modal-header h2 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
        }

        .modal-body {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px 24px;
        }

        .modal-item {
            display: flex;
            flex-direction: column;
            border-bottom: 1px solid #f0f4f8;
            padding-bottom: 8px;
        }

        .modal-item .label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #6a7f8b;
            font-weight: 600;
        }

        .modal-item .value {
            font-size: 0.95rem;
            font-weight: 500;
            color: #0e1a24;
            margin-top: 2px;
            word-break: break-word;
        }

        @media (max-width: 480px) {
            .modal-body {
                grid-template-columns: 1fr;
            }

            .modal-card {
                padding: 24px 18px;
            }
        }

        /* ─── inline add form ─── */
        .add-form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            align-items: center;
            background: #f9fbfc;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1px solid #e9edf2;
            margin-bottom: 16px;
        }

        .add-form input[type="time"] {
            border: 1px solid #e2e8ee;
            border-radius: 6px;
            padding: 6px 10px;
            font-size: 0.9rem;
            background: #fff;
            outline: 0;
        }

        .add-form input[type="time"]:focus {
            border-color: #34d399;
        }
    </style>
</head>

<body>

    <!-- overlay (mobile) -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <!-- sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="flex items-center gap-3">
                <span class="material-icons-outlined text-green-400 text-2xl">people</span>
                <span class="text-white text-lg font-bold tracking-tight">myClienteye</span>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a id="nav-overview" class="active" onclick="switchView('overview')">
                <span class="material-icons-outlined">dashboard</span> Overview
            </a>
            <a id="nav-calls" onclick="switchView('calls')">
                <span class="material-icons-outlined">call</span> Call Requests
                <span class="badge-count" id="side-call-badge">0</span>
            </a>
            <a id="nav-tours" onclick="switchView('tours')">
                <span class="material-icons-outlined">map</span> Tour Requests
                <span class="badge-count" id="side-tour-badge">0</span>
            </a>
            <a id="nav-timeslots" onclick="switchView('timeslots')">
                <span class="material-icons-outlined">schedule</span> Time Slots
                <span class="badge-count" id="side-timeslot-badge">0</span>
            </a>
        </nav>
        <div class="sidebar-footer">
            <div class="flex items-center gap-2"><span class="pulse-dot"></span><span>Live</span></div>
            <div class="mt-0.5 opacity-40">Updated <span id="side-updated">—</span></div>
        </div>
    </aside>

    <!-- main -->
    <div class="main-wrap">

        <!-- top bar -->
        <header class="flex flex-wrap items-center justify-between gap-3 mb-6">
            <div class="flex items-center gap-3">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <span class="material-icons-outlined">menu</span>
                </button>
                <div>
                    <h1 class="text-xl font-bold text-[#0e1a24] tracking-tight" id="page-title">Dashboard</h1>
                    <p class="text-xs text-muted hidden sm:block" id="page-subtitle">Overview of all requests</p>
                </div>
            </div>
            <div class="flex items-center gap-3 flex-wrap">
                <div class="search-box">
                    <span class="material-icons-outlined text-[#97aab6] text-lg">search</span>
                    <input id="global-search" type="search" placeholder="Search name, phone, city…" />
                </div>
                <div class="text-xs text-muted flex items-center gap-1">
                    <span class="material-icons-outlined text-sm">refresh</span>
                    <span id="last-updated">—</span>
                </div>
            </div>
        </header>

        <!-- stats -->
        <section class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-7">
            <div class="stat-card flex items-center gap-4">
                <div class="stat-icon green"><span class="material-icons-outlined">call</span></div>
                <div>
                    <div class="text-xs font-semibold text-muted uppercase tracking-wider">Calls</div>
                    <div class="text-2xl font-bold" id="call-count">—</div>
                </div>
            </div>
            <div class="stat-card flex items-center gap-4">
                <div class="stat-icon blue"><span class="material-icons-outlined">map</span></div>
                <div>
                    <div class="text-xs font-semibold text-muted uppercase tracking-wider">Tours</div>
                    <div class="text-2xl font-bold" id="tour-count">—</div>
                </div>
            </div>
            <div class="stat-card flex items-center gap-4">
                <div class="stat-icon amber"><span class="material-icons-outlined">today</span></div>
                <div>
                    <div class="text-xs font-semibold text-muted uppercase tracking-wider">Today</div>
                    <div class="text-2xl font-bold" id="today-count">—</div>
                </div>
            </div>
            <div class="stat-card flex items-center gap-4">
                <div class="stat-icon slate"><span class="material-icons-outlined">schedule</span></div>
                <div>
                    <div class="text-xs font-semibold text-muted uppercase tracking-wider">Updated</div>
                    <div class="text-base font-semibold" id="last-updated-short">—</div>
                </div>
            </div>
        </section>

        <!-- calls -->
        <section id="call-requests" class="section-calls mb-8">
            <h2 class="text-base font-bold flex items-center gap-2 mb-3">
                <span class="material-icons-outlined text-[#0d9e6b] text-xl">call</span>
                Call Requests
                <span class="text-sm font-normal text-muted ml-1" id="call-subcount">(—)</span>
            </h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>WhatsApp</th>
                            <th>Email</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Period</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="call-rows">
                        <tr>
                            <td colspan="7" class="text-center text-muted py-8">Loading…</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- tours -->
        <section id="tour-requests" class="section-tours">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                <h2 class="text-base font-bold flex items-center gap-2">
                    <span class="material-icons-outlined text-[#1f7ae0] text-xl">map</span>
                    Tour Requests
                    <span class="text-sm font-normal text-muted ml-1" id="tour-subcount">(—)</span>
                </h2>
                <div class="flex items-center gap-2 flex-wrap filter-group">
                    <label>From</label><input id="start-date" type="date" />
                    <label>To</label><input id="end-date" type="date" />
                    <button class="btn btn-primary" id="apply-filter">Apply</button>
                    <button class="btn btn-outline" id="clear-filter">Clear</button>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purpose</th>
                            <th>Group</th>
                            <th>Country</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tour-rows">
                        <tr>
                            <td colspan="9" class="text-center text-muted py-8">Loading…</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- time slots -->
        <section id="time-slots" class="section-timeslots hidden">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                <h2 class="text-base font-bold flex items-center gap-2">
                    <span class="material-icons-outlined text-[#b26f0a] text-xl">schedule</span>
                    Time Slots
                    <span class="text-sm font-normal text-muted ml-1" id="timeslot-subcount">(—)</span>
                </h2>
                <div class="add-form">
                    <label for="new-time" class="text-sm font-semibold">Add New:</label>
                    <input type="time" id="new-time" step="1800" value="09:00" />
                    <button class="btn btn-primary" id="add-timeslot">Add</button>
                </div>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="timeslot-rows">
                        <tr>
                            <td colspan="3" class="text-center text-muted py-8">Loading…</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

        <footer class="mt-10 pt-4 border-t border-[#e9edf2] text-xs text-muted flex flex-wrap justify-between gap-2">
            <span>myClienteye &bull; Auto-refresh 10s</span>
            <span>v2.3</span>
        </footer>
    </div>

    <!-- ─── DETAIL MODAL ─── -->
    <div id="detailModal" class="modal-overlay" onclick="closeModal(event)">
        <div class="modal-card" onclick="event.stopPropagation()">
            <button class="modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
            <div class="modal-header">
                <span class="material-icons-outlined" id="modal-icon">info</span>
                <h2 id="modal-heading">Details</h2>
            </div>
            <div class="modal-body" id="modal-body">
                <!-- filled by JavaScript -->
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict';

            // ─── today in local timezone ───
            const today = new Date().toISOString().slice(0, 10);

            // ─── sample data (fallback) ───
            const SAMPLE_CALLS = [
                {
                    id: 1, full_name: 'Kwame Mensah', whatsapp_number: '+233501234567', email: 'kwame.mensah@example.com',
                    call_date: today, call_time: '14:30', period: 'PM', notes: 'Interested in organic farms',
                    created_at: '2026-07-09T10:00:00', updated_at: '2026-07-09T10:00:00'
                },
                {
                    id: 2, full_name: 'Ama Serwaa', whatsapp_number: '+233541234568', email: 'ama.s@example.com',
                    call_date: '2026-07-09', call_time: '09:15', period: 'AM', notes: 'Wants to visit cocoa plantation',
                    created_at: '2026-07-08T08:30:00', updated_at: '2026-07-08T08:30:00'
                },
                {
                    id: 3, full_name: 'Yaw Asante', whatsapp_number: '+233571234569', email: 'yaw.a@example.com',
                    call_date: '2026-07-08', call_time: '11:45', period: 'AM', notes: 'Looking for irrigation solutions',
                    created_at: '2026-07-07T14:20:00', updated_at: '2026-07-07T14:20:00'
                },
            ];
            const SAMPLE_TOURS = [
                {
                    id: 1, first_name: 'John', other_names: 'Doe', purpose: 'Vacation and sightseeing',
                    number_of_people_visiting: 3, country: 'United States', city: 'New York',
                    phone_number: '+15551234567', tour_date: today, tour_time: '14:30',
                    special_requests: 'Need wheelchair access', created_at: '2026-07-09T09:00:00',
                    updated_at: '2026-07-09T09:00:00'
                },
                {
                    id: 2, first_name: 'Ama', other_names: 'Kumi', purpose: 'Educational research',
                    number_of_people_visiting: 1, country: 'Ghana', city: 'Accra', phone_number: '+233241234567',
                    tour_date: '2026-10-05', tour_time: '09:00', special_requests: 'Bring camera equipment',
                    created_at: '2026-07-01T11:00:00', updated_at: '2026-07-01T11:00:00'
                },
                {
                    id: 3, first_name: 'Carlos', other_names: 'Silva', purpose: 'Team-building retreat',
                    number_of_people_visiting: 45, country: 'Brazil', city: 'São Paulo', phone_number: '+5511998765432',
                    tour_date: '2026-12-25', tour_time: '10:30', special_requests: 'Lunch for 45',
                    created_at: '2026-06-15T16:30:00', updated_at: '2026-06-15T16:30:00'
                },
                {
                    id: 4, first_name: 'Yuki', other_names: 'Tanaka', purpose: 'Family weekend',
                    number_of_people_visiting: 5, country: 'Japan', city: 'Tokyo', phone_number: '+81355551234',
                    tour_date: '2026-08-08', tour_time: '13:15', special_requests: 'Kids activities',
                    created_at: '2026-07-05T12:00:00', updated_at: '2026-07-05T12:00:00'
                },
            ];

            const API_CALLS = '/api/v1/call-requests';
            const API_TOURS = ['/api/v1/tours', '/api/v1/tour', '/api/v1/tour/'];
            const API_TIMESLOTS = '/api/v1/time-slots';

            // ─── DOM refs ───
            const callSection = document.getElementById('call-requests');
            const tourSection = document.getElementById('tour-requests');
            const timeslotSection = document.getElementById('time-slots');
            const callRows = document.getElementById('call-rows');
            const tourRows = document.getElementById('tour-rows');
            const timeslotRows = document.getElementById('timeslot-rows');
            const callCountEl = document.getElementById('call-count');
            const tourCountEl = document.getElementById('tour-count');
            const todayCountEl = document.getElementById('today-count');
            const callSubcount = document.getElementById('call-subcount');
            const tourSubcount = document.getElementById('tour-subcount');
            const timeslotSubcount = document.getElementById('timeslot-subcount');
            const lastUpdatedEl = document.getElementById('last-updated');
            const lastUpdatedShort = document.getElementById('last-updated-short');
            const sideUpdated = document.getElementById('side-updated');
            const sideCallBadge = document.getElementById('side-call-badge');
            const sideTourBadge = document.getElementById('side-tour-badge');
            const sideTimeslotBadge = document.getElementById('side-timeslot-badge');
            const searchInput = document.getElementById('global-search');
            const startDate = document.getElementById('start-date');
            const endDate = document.getElementById('end-date');
            const applyBtn = document.getElementById('apply-filter');
            const clearBtn = document.getElementById('clear-filter');
            const pageTitle = document.getElementById('page-title');
            const pageSubtitle = document.getElementById('page-subtitle');
            const navOverview = document.getElementById('nav-overview');
            const navCalls = document.getElementById('nav-calls');
            const navTours = document.getElementById('nav-tours');
            const navTimeslots = document.getElementById('nav-timeslots');

            const modalOverlay = document.getElementById('detailModal');
            const modalHeading = document.getElementById('modal-heading');
            const modalIcon = document.getElementById('modal-icon');
            const modalBody = document.getElementById('modal-body');

            let callsData = [],
                toursData = [],
                timeslotsData = [],
                filter = { start: '', end: '', search: '' },
                searchTimer = null,
                currentView = 'overview';

            // ─── Modal functions ───
            function openModal(item, type) {
                const iconMap = { call: 'call', tour: 'map', timeslot: 'schedule' };
                const titleMap = {
                    call: 'Call Request Details', tour: 'Tour Request Details',
                    timeslot: 'Time Slot Details'
                };
                modalIcon.textContent = iconMap[type] || 'info';
                modalHeading.textContent = titleMap[type] || 'Details';

                let html = '';
                const priority = ['id', 'time', 'is_available', 'created_at', 'updated_at'];
                const keys = Object.keys(item);
                keys.sort((a, b) => {
                    const ia = priority.indexOf(a);
                    const ib = priority.indexOf(b);
                    if (ia === -1 && ib === -1) return a.localeCompare(b);
                    if (ia === -1) return 1;
                    if (ib === -1) return -1;
                    return ia - ib;
                });

                for (const key of keys) {
                    let value = item[key];
                    if (value === null || value === undefined || value === '') value = '—';
                    if (key === 'is_available') value = value ? 'Available' : 'Booked';
                    if (key.includes('date') && value !== '—') value = fmtDate(value);
                    const label = key.replace(/_/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
                    html += `
                        <div class="modal-item">
                            <span class="label">${label}</span>
                            <span class="value">${safe(value)}</span>
                        </div>
                    `;
                }
                modalBody.innerHTML = html;
                modalOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            window.closeModal = function (e) {
                if (e && e.target !== e.currentTarget) return;
                modalOverlay.classList.remove('active');
                document.body.style.overflow = '';
            };

            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeModal();
            });

            // ─── view switching ───
            window.switchView = function (view) {
                currentView = view;
                [navOverview, navCalls, navTours, navTimeslots].forEach(el => el.classList.remove('active'));
                if (view === 'overview') {
                    navOverview.classList.add('active');
                    pageTitle.textContent = 'Dashboard';
                    pageSubtitle.textContent = 'Overview of all requests';
                    callSection.classList.remove('hidden');
                    tourSection.classList.remove('hidden');
                    timeslotSection.classList.add('hidden');
                } else if (view === 'calls') {
                    navCalls.classList.add('active');
                    pageTitle.textContent = 'Call Requests';
                    pageSubtitle.textContent = 'View all call requests';
                    callSection.classList.remove('hidden');
                    tourSection.classList.add('hidden');
                    timeslotSection.classList.add('hidden');
                } else if (view === 'tours') {
                    navTours.classList.add('active');
                    pageTitle.textContent = 'Tour Requests';
                    pageSubtitle.textContent = 'View all tour requests';
                    callSection.classList.add('hidden');
                    tourSection.classList.remove('hidden');
                    timeslotSection.classList.add('hidden');
                } else if (view === 'timeslots') {
                    navTimeslots.classList.add('active');
                    pageTitle.textContent = 'Time Slots';
                    pageSubtitle.textContent = 'Manage time slots';
                    callSection.classList.add('hidden');
                    tourSection.classList.add('hidden');
                    timeslotSection.classList.remove('hidden');
                }
                if (window.innerWidth <= 768) {
                    document.getElementById('sidebar').classList.remove('open');
                    document.getElementById('sidebarOverlay').classList.remove('active');
                }
                applySearchAndRender();
            };

            // ─── helpers ───
            function safe(v) { return v == null || v === '' ? '—' : String(v); }

            function fmtDate(d) {
                if (!d) return '—';
                const x = new Date(d);
                return isNaN(x.getTime()) ? d : x.toLocaleDateString('en-US', {
                    month: 'short', day: 'numeric',
                    year: 'numeric'
                });
            }

            function fmtTime(t) { return t || '—'; }

            function isToday(d) {
                if (!d) return false;
                const x = new Date(d);
                if (isNaN(x.getTime())) return false;
                const t = new Date();
                return x.getDate() === t.getDate() && x.getMonth() === t.getMonth() && x.getFullYear() === t.getFullYear();
            }

            function updateTimestamp() {
                const t = new Date().toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
                lastUpdatedEl.textContent = t;
                lastUpdatedShort.textContent = t;
                sideUpdated.textContent = t;
            }

            function updateBadges() {
                sideCallBadge.textContent = callsData.length;
                sideTourBadge.textContent = toursData.length;
                sideTimeslotBadge.textContent = timeslotsData.length;
            }

            // ─── Delete functions ───
            async function deleteCall(id) {
                if (!confirm('Delete this call request?')) return;
                try {
                    const res = await fetch(`${API_CALLS}/${id}`, { method: 'DELETE' });
                    if (res.ok) {
                        await fetchCalls();
                    } else {
                        alert('Failed to delete');
                    }
                } catch (e) { alert('Error: ' + e.message); }
            }

            async function deleteTour(id) {
                if (!confirm('Delete this tour request?')) return;
                try {
                    // Try the plural endpoint first, fallback to singular if needed
                    let res = await fetch(`/api/v1/tours/${id}`, { method: 'DELETE' });
                    if (!res.ok) {
                        // fallback to singular
                        res = await fetch(`/api/v1/tour/${id}`, { method: 'DELETE' });
                    }
                    if (res.ok) {
                        await fetchTours({ start: filter.start, end: filter.end });
                    } else {
                        alert('Failed to delete');
                    }
                } catch (e) { alert('Error: ' + e.message); }
            }

            // ─── render functions ───
            function renderCallTable(data) {
                const c = data.length;
                callCountEl.textContent = c;
                callSubcount.textContent = `(${c})`;
                updateBadges();
                if (!c) {
                    callRows.innerHTML =
                        `<tr><td colspan="7" class="text-center text-muted py-8">No call requests</td></tr>`;
                    return;
                }
                callRows.innerHTML = data.map((it, index) => {
                    const todayClass = isToday(it.call_date) ? 'class="today-row"' : '';
                    return `
                        <tr ${todayClass} data-index="${index}" data-type="call">
                            <td class="font-medium">${safe(it.full_name)}</td>
                            <td>${safe(it.whatsapp_number)}</td>
                            <td class="truncate max-w-[130px]">${safe(it.email)}</td>
                            <td>${fmtDate(it.call_date)}</td>
                            <td>${fmtTime(it.call_time)}</td>
                            <td><span class="badge ${it.period === 'AM' ? 'green' : 'amber'}">${safe(it.period)}</span></td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-call" data-id="${it.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                }).join('');
                attachRowClick('#call-rows tr', data, 'call');
                // Delete events
                document.querySelectorAll('.delete-call').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        deleteCall(this.dataset.id);
                    });
                });
            }

            function renderTourTable(data) {
                const c = data.length;
                tourCountEl.textContent = c;
                tourSubcount.textContent = `(${c})`;
                updateBadges();
                const todayTours = data.filter(it => isToday(it.tour_date || it.date));
                const todayCalls = callsData.filter(it => isToday(it.call_date));
                todayCountEl.textContent = todayTours.length + todayCalls.length;
                if (!c) {
                    tourRows.innerHTML =
                        `<tr><td colspan="9" class="text-center text-muted py-8">No tour requests</td></tr>`;
                    return;
                }
                tourRows.innerHTML = data.map((it, index) => {
                    const dateVal = it.tour_date || it.date;
                    const todayClass = isToday(dateVal) ? 'class="today-row"' : '';
                    return `
                        <tr ${todayClass} data-index="${index}" data-type="tour">
                            <td class="font-medium">${safe(it.first_name)} ${safe(it.other_names)}</td>
                            <td><span class="badge">${safe(it.purpose)}</span></td>
                            <td>${safe(it.number_of_people_visiting)}</td>
                            <td>${safe(it.country)}</td>
                            <td>${safe(it.city)}</td>
                            <td>${safe(it.phone_number || it.whatsapp_number)}</td>
                            <td>${fmtDate(dateVal)}</td>
                            <td>${fmtTime(it.tour_time || it.time)}</td>
                            <td>
                                <button class="btn btn-danger btn-sm delete-tour" data-id="${it.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                }).join('');
                attachRowClick('#tour-rows tr', data, 'tour');
                // Delete events
                document.querySelectorAll('.delete-tour').forEach(btn => {
                    btn.addEventListener('click', function (e) {
                        e.stopPropagation();
                        deleteTour(this.dataset.id);
                    });
                });
            }

            function renderTimeSlotTable(data) {
                const c = data.length;
                timeslotSubcount.textContent = `(${c})`;
                sideTimeslotBadge.textContent = c;
                if (!c) {
                    timeslotRows.innerHTML =
                        `<tr><td colspan="3" class="text-center text-muted py-8">No time slots</td></tr>`;
                    return;
                }
                timeslotRows.innerHTML = data.map((it, index) => {
                    const statusBadge = it.is_available ? 'green' : 'amber';
                    const statusText = it.is_available ? 'Available' : 'Booked';
                    return `
                        <tr data-index="${index}" data-type="timeslot">
                            <td>${it.time}</td>
                            <td><span class="badge ${statusBadge}">${statusText}</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm toggle-slot" data-id="${it.id}" data-available="${it.is_available}">
                                    ${it.is_available ? 'Book' : 'Free'}
                                </button>
                                <button class="btn btn-danger btn-sm delete-slot" data-id="${it.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                }).join('');
                // Attach row click for detail modal
                document.querySelectorAll('#timeslot-rows tr').forEach((row, idx) => {
                    row.addEventListener('click', function (e) {
                        if (e.target.closest('button')) return;
                        const index = parseInt(this.dataset.index);
                        const item = data[index];
                        if (item) openModal(item, 'timeslot');
                    });
                });
                // Toggle buttons
                document.querySelectorAll('.toggle-slot').forEach(btn => {
                    btn.addEventListener('click', async function (e) {
                        e.stopPropagation();
                        const id = this.dataset.id;
                        const current = this.dataset.available === 'true';
                        try {
                            const res = await fetch(`${API_TIMESLOTS}/${id}`, {
                                method: 'PUT',
                                headers: { 'Content-Type': 'application/json' },
                                body: JSON.stringify({ is_available: !current })
                            });
                            if (res.ok) {
                                fetchTimeSlots();
                            } else {
                                alert('Failed to update');
                            }
                        } catch (err) { alert('Error: ' + err.message); }
                    });
                });
                // Delete buttons
                document.querySelectorAll('.delete-slot').forEach(btn => {
                    btn.addEventListener('click', async function (e) {
                        e.stopPropagation();
                        if (!confirm('Delete this time slot?')) return;
                        const id = this.dataset.id;
                        try {
                            const res = await fetch(`${API_TIMESLOTS}/${id}`, { method: 'DELETE' });
                            if (res.ok) {
                                fetchTimeSlots();
                            } else {
                                alert('Failed to delete');
                            }
                        } catch (err) { alert('Error: ' + err.message); }
                    });
                });
            }

            function attachRowClick(selector, data, type) {
                document.querySelectorAll(selector).forEach((row, idx) => {
                    row.addEventListener('click', function () {
                        const index = parseInt(this.dataset.index);
                        const item = data[index];
                        if (item) openModal(item, type);
                    });
                });
            }

            // ─── Search & filter ───
            function applySearchAndRender() {
                const q = filter.search.toLowerCase().trim();
                const fc = callsData.filter(it => !q || (it.full_name || '').toLowerCase().includes(q) || (it
                    .whatsapp_number || '').toLowerCase().includes(q) || (it.email || '').toLowerCase().includes(q));
                renderCallTable(fc);
                const ft = toursData.filter(it => !q || (it.first_name || '').toLowerCase().includes(q) || (it
                    .other_names || '').toLowerCase().includes(q) || (it.city || '').toLowerCase().includes(q) || (it
                        .country || '').toLowerCase().includes(q) || (it.phone_number || '').toLowerCase().includes(q) || (it
                            .whatsapp_number || '').toLowerCase().includes(q));
                renderTourTable(ft);
                renderTimeSlotTable(timeslotsData);
            }

            // ─── API fetches ───
            async function fetchCalls() {
                try {
                    const res = await fetch(API_CALLS, { cache: 'no-store' });
                    if (!res.ok) throw new Error();
                    const json = await res.json();
                    const arr = Array.isArray(json) ? json : (json.data || []);
                    callsData = arr.length ? arr : SAMPLE_CALLS;
                } catch (e) { callsData = SAMPLE_CALLS; }
                applySearchAndRender();
            }

            async function fetchTours({ start = '', end = '' } = {}) {
                const qs = new URLSearchParams();
                if (start) qs.set('start_date', start);
                if (end) qs.set('end_date', end);
                for (const candidate of API_TOURS) {
                    try {
                        const url = qs.toString() ? `${candidate}?${qs.toString()}` : candidate;
                        const res = await fetch(url, { cache: 'no-store' });
                        if (!res.ok) continue;
                        const json = await res.json();
                        const arr = Array.isArray(json) ? json : (Array.isArray(json.data) ? json.data : null);
                        if (arr !== null) {
                            toursData = arr;
                            applySearchAndRender();
                            return;
                        }
                    } catch (e) { }
                }
                toursData = SAMPLE_TOURS;
                applySearchAndRender();
            }

            async function fetchTimeSlots() {
                try {
                    const res = await fetch(API_TIMESLOTS, { cache: 'no-store' });
                    if (!res.ok) throw new Error();
                    const json = await res.json();
                    const arr = Array.isArray(json) ? json : (json.data || []);
                    timeslotsData = arr;
                } catch (e) {
                    timeslotsData = [];
                }
                renderTimeSlotTable(timeslotsData);
            }

            async function addTimeSlot(time) {
                try {
                    const res = await fetch(API_TIMESLOTS, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ time: time, is_available: true })
                    });
                    if (res.ok) {
                        fetchTimeSlots();
                        return true;
                    } else {
                        const err = await res.json();
                        alert('Failed to add: ' + (err.message || 'Unknown error'));
                        return false;
                    }
                } catch (e) {
                    alert('Error: ' + e.message);
                    return false;
                }
            }

            async function loadAll() {
                await Promise.all([
                    fetchCalls(),
                    fetchTours({ start: filter.start, end: filter.end }),
                    fetchTimeSlots()
                ]);
                updateTimestamp();
            }

            // ─── events ───
            searchInput.addEventListener('input', function (e) {
                clearTimeout(searchTimer);
                filter.search = e.target.value;
                searchTimer = setTimeout(applySearchAndRender, 200);
            });

            applyBtn.addEventListener('click', function () {
                filter.start = startDate.value;
                filter.end = endDate.value;
                fetchTours({ start: filter.start, end: filter.end });
            });

            clearBtn.addEventListener('click', function () {
                startDate.value = '';
                endDate.value = '';
                filter.start = '';
                filter.end = '';
                fetchTours();
            });

            document.getElementById('add-timeslot').addEventListener('click', function () {
                const timeInput = document.getElementById('new-time');
                const time = timeInput.value;
                if (!time) {
                    alert('Please select a time');
                    return;
                }
                addTimeSlot(time).then(success => {
                    if (success) timeInput.value = '09:00';
                });
            });

            window.toggleSidebar = function () {
                document.getElementById('sidebar').classList.toggle('open');
                document.getElementById('sidebarOverlay').classList.toggle('active');
            };
            window.closeSidebar = function () {
                document.getElementById('sidebar').classList.remove('open');
                document.getElementById('sidebarOverlay').classList.remove('active');
            };
            window.addEventListener('resize', function () {
                if (window.innerWidth > 768) {
                    document.getElementById('sidebar').classList.remove('open');
                    document.getElementById('sidebarOverlay').classList.remove('active');
                }
            });

            // ─── start ───
            loadAll();
            setInterval(() => {
                fetchCalls();
                fetchTours({ start: filter.start, end: filter.end });
                fetchTimeSlots();
                updateTimestamp();
            }, 10000);
        })();
    </script>
</body>

</html>
