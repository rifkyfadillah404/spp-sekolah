<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Metronic (CDN) -->
    <link rel="stylesheet" href="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.css"/>
    <link rel="stylesheet" href="https://preview.keenthemes.com/metronic8/demo1/assets/css/style.bundle.css"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --primary-light: #a5b4fc;
            --secondary-color: #f1f5f9;
            --accent-color: #06b6d4;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 75px;
            --border-radius: 12px;
            --border-radius-sm: 8px;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 20px 25px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-accent: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            color: #1e293b;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(180deg, #ffffff 0%, #fafbff 100%);
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(99, 102, 241, 0.1);
            box-shadow: var(--shadow-lg);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 200px;
            background: var(--gradient-primary);
            opacity: 0.05;
            border-radius: 0 0 50px 0;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar .nav-link {
            color: #64748b;
            padding: 14px 20px;
            margin: 4px 12px;
            border-radius: var(--border-radius);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-weight: 500;
            font-size: 14px;
            display: flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(99, 102, 241, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .sidebar .nav-link:hover::before {
            left: 100%;
        }

        .sidebar .nav-link:hover {
            color: var(--primary-color);
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.08) 0%, rgba(165, 180, 252, 0.05) 100%);
            transform: translateX(4px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.15);
        }

        .sidebar .nav-link.active {
            color: #ffffff;
            background: var(--gradient-primary);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.3);
            transform: translateX(4px);
        }

        .sidebar .nav-link.active::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 20px;
            background: #ffffff;
            border-radius: 2px 0 0 2px;
        }

        .sidebar .nav-link i {
            width: 22px;
            text-align: center;
            margin-right: 14px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.1);
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .sidebar:not(.collapsed) .nav-link span {
            opacity: 1;
            transform: translateX(0);
            transition: all 0.3s ease 0.1s;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
            margin: 4px 8px;
            padding: 14px 8px;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
            min-height: 100vh;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        .top-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 24px;
            margin-bottom: 24px;
        }

        .sidebar-brand {
            padding: 32px 20px;
            margin-bottom: 24px;
            text-align: center;
            position: relative;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(165, 180, 252, 0.02) 100%);
            border-radius: 0 0 var(--border-radius) var(--border-radius);
        }

        .sidebar-brand::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20px;
            right: 20px;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            opacity: 0.3;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: white;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-brand .brand-icon {
            margin-bottom: 0;
        }

        .sidebar-brand h4 {
            color: var(--primary-color);
            margin: 0;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.02em;
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .sidebar-brand h4 {
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .nav-section {
            margin: 24px 0;
            position: relative;
        }

        .nav-section-title {
            color: #94a3b8;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0 20px 8px;
            margin-bottom: 8px;
            position: relative;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
            pointer-events: none;
        }

        .nav-section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 20px;
            width: 30px;
            height: 2px;
            background: var(--gradient-primary);
            border-radius: 1px;
            opacity: 0.6;
        }

        .card {
            border: 1px solid #e2e8f0;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-sm);
            background: #ffffff;
            transition: all 0.2s ease;
        }

        .card:hover {
            box-shadow: var(--shadow-md);
        }

        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            padding: 16px 20px;
            font-weight: 600;
            color: #374151;
        }

        .btn {
            border-radius: var(--border-radius);
            padding: 8px 16px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .table {
            border-radius: var(--border-radius);
            overflow: hidden;
        }

        .table thead th {
            background-color: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            color: #374151;
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 12px;
        }

        .submenu {
            background: #f8fafc;
            border-radius: var(--border-radius);
            margin: 4px 8px;
            padding: 4px 0;
        }

        .submenu .nav-link {
            margin: 1px 8px;
            padding: 8px 12px;
            font-size: 13px;
        }

        .stat-card {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
            border-radius: var(--border-radius);
            padding: 24px;
            margin-bottom: 24px;
        }

        .stat-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .stat-card p {
            margin: 0;
            opacity: 0.9;
        }

        /* Mobile overlay */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                z-index: 1001;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Enhanced scrollbar */
        .sidebar::-webkit-scrollbar {
            width: 4px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, var(--primary-color), var(--primary-dark));
            border-radius: 2px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, var(--primary-dark), var(--primary-color));
        }

        /* Tooltip for collapsed sidebar */
        .nav-tooltip {
            position: absolute;
            left: 100%;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            margin-left: 10px;
            z-index: 1000;
        }

        .nav-tooltip::before {
            content: '';
            position: absolute;
            right: 100%;
            top: 50%;
            transform: translateY(-50%);
            border: 5px solid transparent;
            border-right-color: rgba(0, 0, 0, 0.8);
        }

        .sidebar.collapsed .nav-link:hover .nav-tooltip {
            opacity: 1;
            visibility: visible;
        }
    </style>
<style>
/* Metronic-like simple dark aside overrides (cleaner, calmer sidebar) */
/* refined */
:root{
  --aside-bg:#1e1e2d;
  --aside-border:#2b2b40;
  --aside-link:#a1a5b7;
  --aside-link-hover:#ffffff;
  --aside-active-bg:#2a2a3c;
  --aside-active-indicator:#3e97ff;
  --aside-width:260px;
  --aside-width-collapsed:78px;
}
.sidebar{
  width:var(--aside-width) !important;
  background:var(--aside-bg) !important;
  border-right:1px solid var(--aside-border) !important;
  box-shadow:none !important;
  overflow-x:hidden;
}
.sidebar::before{ display:none !important; }
.sidebar.collapsed{ width:var(--aside-width-collapsed) !important; }
.sidebar-brand{
  background:transparent !important;
  padding:16px 14px !important;
  margin-bottom:6px !important;
}
.sidebar-brand h4{
  color:#fff !important;
  opacity:1 !important;
  transform:none !important;
  font-size:1.1rem !important;
  margin:0 !important;
}
.sidebar.collapsed .sidebar-brand h4{ display:none !important; }
.brand-icon{
  background:#2b2b40 !important;
  box-shadow:none !important;
}
.nav-section-title{
  color:#565674 !important;
  padding:0 14px 6px !important;
  margin:10px 0 6px !important;
}
.sidebar .nav-link{
  color:var(--aside-link) !important;
  margin:2px 8px !important;
  padding:10px 10px !important;
  border-radius:8px !important;
  background:transparent !important;
  transform:none !important;
  box-shadow:none !important;
}
.sidebar .nav-link::before{ display:none !important; }
.sidebar .nav-link:hover{
  color:var(--aside-link-hover) !important;
  background:var(--aside-active-bg) !important;
}
.sidebar .nav-link.active{
  color:#ffffff !important;
  background:var(--aside-active-bg) !important;
  position:relative;
}
.sidebar .nav-link.active::after{
  content:''; position:absolute; left:-6px; top:50%; transform:translateY(-50%);
  width:3px; height:18px; background:var(--aside-active-indicator); border-radius:2px;
}
.sidebar .nav-link i{
  font-size:1rem !important;
  margin-right:12px !important;
}
.sidebar.collapsed .nav-link span{ display:none !important; }
.sidebar.collapsed .nav-link{ justify-content:center !important; }
.main-content{ margin-left:var(--aside-width) !important; }
.main-content.expanded{ margin-left:var(--aside-width-collapsed) !important; }
.top-navbar{ position:sticky; top:0; z-index:10; }
.nav-tooltip{ background:#2b2b40 !important; }
.nav-tooltip::before{ border-right-color:#2b2b40 !important; }
@media (max-width: 768px){
  .main-content{ margin-left:0 !important; }
}
</style>
<style>
/* ===== METRONIC TABLE STYLING ===== */
.table {
    --kt-table-striped-bg: #f9f9f9;
    --kt-table-striped-color: #5e6278;
    --kt-table-active-bg: #f1faff;
    --kt-table-active-color: #5e6278;
    --kt-table-hover-bg: #f1faff;
    --kt-table-hover-color: #5e6278;
    margin-bottom: 0;
    color: #5e6278;
    vertical-align: top;
    border-color: #eff2f5;
}

.table > :not(caption) > * > * {
    padding: 1rem 0.75rem;
    background-color: var(--kt-table-bg);
    border-bottom-width: 1px;
    box-shadow: inset 0 0 0 9999px var(--kt-table-accent-bg);
}

.table > tbody {
    vertical-align: inherit;
}

.table > thead {
    vertical-align: bottom;
}

.table-rounded {
    border-radius: 0.475rem;
    overflow: hidden;
}

.table-row-bordered > tbody > tr > td {
    border-top: 1px solid #eff2f5;
}

.table-row-gray-300 > tbody > tr {
    border-bottom: 1px solid #eff2f5;
}

.table-row-gray-300 > tbody > tr:last-child {
    border-bottom: 0;
}

.table > thead > tr > th {
    font-weight: 600;
    font-size: 0.825rem;
    color: #a1a5b7;
    border-bottom: 1px solid #eff2f5;
    padding: 1rem 0.75rem;
    text-transform: uppercase;
    letter-spacing: 0.035em;
}

.table > tbody > tr > td {
    font-weight: 500;
    color: #5e6278;
    padding: 1rem 0.75rem;
    vertical-align: middle;
}

.table-hover > tbody > tr:hover > * {
    --kt-table-accent-bg: var(--kt-table-hover-bg);
    color: var(--kt-table-hover-color);
}

/* ===== METRONIC SYMBOLS & AVATARS ===== */
.symbol {
    display: inline-flex;
    flex-shrink: 0;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 0.475rem;
    background-color: #f1faff;
    color: #009ef7;
    font-weight: 600;
    font-size: 1rem;
    line-height: 0;
}

.symbol.symbol-35px {
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
}

.symbol.symbol-40px {
    width: 40px;
    height: 40px;
    font-size: 1rem;
}

.symbol.symbol-45px {
    width: 45px;
    height: 45px;
    font-size: 1.1rem;
}

.symbol.symbol-circle {
    border-radius: 50%;
}

.symbol-label {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
    color: inherit;
    font-weight: 600;
}

/* ===== METRONIC TEXT UTILITIES ===== */
.text-gray-800 {
    color: #1e2129 !important;
}

.text-gray-600 {
    color: #5e6278 !important;
}

.text-gray-500 {
    color: #a1a5b7 !important;
}

.text-gray-400 {
    color: #b5b5c3 !important;
}

.text-muted {
    color: #a1a5b7 !important;
}

.fw-bold {
    font-weight: 600 !important;
}

.fw-semibold {
    font-weight: 500 !important;
}

.fs-6 {
    font-size: 1.075rem !important;
}

.fs-7 {
    font-size: 0.95rem !important;
}

.fs-8 {
    font-size: 0.85rem !important;
}

/* ===== METRONIC BADGES ===== */
.badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.35rem 0.65rem;
    font-size: 0.75rem;
    font-weight: 500;
    line-height: 1.5;
    border-radius: 0.425rem;
    text-transform: none;
    letter-spacing: 0;
}

.badge-light-success {
    color: #0a7d3c;
    background-color: #c9f7f5;
    border: 1px solid #c9f7f5;
}

.badge-light-warning {
    color: #7c6a00;
    background-color: #fff8dd;
    border: 1px solid #fff8dd;
}

.badge-light-danger {
    color: #a61e1e;
    background-color: #ffe2e5;
    border: 1px solid #ffe2e5;
}

.badge-light-info {
    color: #006a9b;
    background-color: #c7f9ff;
    border: 1px solid #c7f9ff;
}

.badge-light-primary {
    color: #0040a3;
    background-color: #e1f0ff;
    border: 1px solid #e1f0ff;
}

.badge-success {
    color: #ffffff;
    background-color: #50cd89;
    border: 1px solid #50cd89;
}

.badge-warning {
    color: #ffffff;
    background-color: #ffc700;
    border: 1px solid #ffc700;
}

.badge-danger {
    color: #ffffff;
    background-color: #f1416c;
    border: 1px solid #f1416c;
}

.badge-info {
    color: #ffffff;
    background-color: #7239ea;
    border: 1px solid #7239ea;
}

.badge-primary {
    color: #ffffff;
    background-color: #009ef7;
    border: 1px solid #009ef7;
}

/* ===== METRONIC BUTTONS ===== */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 500;
    line-height: 1.5;
    color: #5e6278;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    cursor: pointer;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: 0.65rem 1.25rem;
    font-size: 1.075rem;
    border-radius: 0.475rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.925rem;
    border-radius: 0.425rem;
}

.btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: calc(1.5em + 1.3rem + 2px);
    padding: 0.65rem;
}

.btn-icon.btn-sm {
    width: calc(1.5em + 1rem + 2px);
    padding: 0.5rem;
}

.btn-light {
    color: #7e8299;
    background-color: #f5f8fa;
    border-color: #f5f8fa;
}

.btn-light:hover {
    color: #5e6278;
    background-color: #e9ecef;
    border-color: #e9ecef;
}

.btn-light-primary {
    color: #009ef7;
    background-color: #f1faff;
    border-color: #f1faff;
}

.btn-light-primary:hover {
    color: #ffffff;
    background-color: #009ef7;
    border-color: #009ef7;
}

.btn-light-success {
    color: #50cd89;
    background-color: #e8fff3;
    border-color: #e8fff3;
}

.btn-light-success:hover {
    color: #ffffff;
    background-color: #50cd89;
    border-color: #50cd89;
}

.btn-light-warning {
    color: #ffc700;
    background-color: #fff8dd;
    border-color: #fff8dd;
}

.btn-light-warning:hover {
    color: #ffffff;
    background-color: #ffc700;
    border-color: #ffc700;
}

.btn-light-danger {
    color: #f1416c;
    background-color: #ffe2e5;
    border-color: #ffe2e5;
}

.btn-light-danger:hover {
    color: #ffffff;
    background-color: #f1416c;
    border-color: #f1416c;
}

/* ===== METRONIC DROPDOWN ===== */
.dropdown-menu {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 1000;
    min-width: 200px;
    padding: 0.5rem 0;
    margin: 0.125rem 0 0;
    font-size: 1.075rem;
    color: #5e6278;
    text-align: left;
    list-style: none;
    background-color: #ffffff;
    background-clip: padding-box;
    border: 0 solid rgba(0, 0, 0, 0.15);
    border-radius: 0.475rem;
    box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
}

.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.65rem 1.25rem;
    clear: both;
    font-weight: 500;
    color: #5e6278;
    text-align: inherit;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out;
}

.dropdown-item:hover,
.dropdown-item:focus {
    color: #009ef7;
    background-color: #f1faff;
}

.dropdown-item.active,
.dropdown-item:active {
    color: #ffffff;
    text-decoration: none;
    background-color: #009ef7;
}

.dropdown-divider {
    height: 0;
    margin: 0.5rem 0;
    overflow: hidden;
    border-top: 1px solid #eff2f5;
}

/* ===== METRONIC FORM CONTROLS ===== */
.form-check-input {
    width: 1.25rem;
    height: 1.25rem;
    margin-top: 0.125rem;
    vertical-align: top;
    background-color: #ffffff;
    background-repeat: no-repeat;
    background-position: center;
    background-size: contain;
    border: 1px solid #b5b5c3;
    appearance: none;
    color-adjust: exact;
    transition: background-color 0.15s ease-in-out, background-position 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-check-input[type="checkbox"] {
    border-radius: 0.425rem;
}

.form-check-input:active {
    filter: brightness(90%);
}

.form-check-input:focus {
    border-color: #b3d4fc;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(0, 158, 247, 0.25);
}

.form-check-input:checked {
    background-color: #009ef7;
    border-color: #009ef7;
}

.form-check-input:checked[type="checkbox"] {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='m6 10 3 3 6-6'/%3e%3c/svg%3e");
}

/* ===== METRONIC RESPONSIVE TABLE ===== */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
</style>
</head>

<body class="app-default">
    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>SPP Admin</h4>
        </div>

        <!-- Main Navigation -->
        <div class="nav-section">
            <div class="nav-section-title">Overview</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-chart-pie"></i>
                        <span>Dashboard</span>

                    </a>
                </li>
            </ul>
        </div>

        <!-- Student Management -->
        <div class="nav-section">
            <div class="nav-section-title">Manajemen Siswa</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.students.index') ? 'active' : '' }}"
                        href="{{ route('admin.students.index') }}">
                        <i class="fas fa-users"></i>
                        <span>Semua Siswa</span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.students.by-class') ? 'active' : '' }}"
                        href="{{ route('admin.students.by-class') }}">
                        <i class="fas fa-layer-group"></i>
                        <span>Siswa Per Kelas</span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.students.create') ? 'active' : '' }}"
                        href="{{ route('admin.students.create') }}">
                        <i class="fas fa-user-plus"></i>
                        <span>Tambah Siswa</span>

                    </a>
                </li>
            </ul>
        </div>

        <!-- Payment Management -->
        <div class="nav-section">
            <div class="nav-section-title">Manajemen SPP</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.spp-bills.index') ? 'active' : '' }}"
                        href="{{ route('admin.spp-bills.index') }}">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Semua Tagihan</span>

                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.spp-bills.create') ? 'active' : '' }}"
                        href="{{ route('admin.spp-bills.create') }}">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Tagihan</span>

                    </a>
                </li>
            </ul>
        </div>

          <!-- Reports -->
    <div class="nav-section">
        <div class="nav-section-title">Laporan</div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.students.pdf') }}">
                    <i class="fas fa-file-pdf"></i>
                    <span>Daftar Siswa (PDF)</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.students.excel') }}">
                    <i class="fas fa-file-excel"></i>
                    <span>Daftar Siswa (Excel)</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.spp.pdf') }}">
                    <i class="fas fa-file-pdf"></i>
                    <span>Tagihan SPP (PDF)</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reports.spp.excel') }}">
                    <i class="fas fa-file-excel"></i>
                    <span>Tagihan SPP (Excel)</span>

                </a>
            </li>
        </ul>
    </div>

        <!-- Account Section -->
        <div class="nav-section" style="margin-top: auto; padding-top: 20px;">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline" id="logout-form">
                        @csrf
                        <a class="nav-link" href="#" onclick="confirmLogout(event)">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <button class="btn btn-outline-secondary me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                @if (isset($header))
                    {{ $header }}
                @endif
            </div>

            <div class="d-flex align-items-center">
                <span class="me-3">Selamat datang, <strong>{{ auth()->user()->name }}</strong></span>
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </div>

        <!-- Page Content -->
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{ $slot }}
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Metronic (CDN) -->
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/plugins/global/plugins.bundle.js"></script>
    <script src="https://preview.keenthemes.com/metronic8/demo1/assets/js/scripts.bundle.js"></script>

    <script>
        // Sidebar toggle functionality
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');

            // Check if mobile view
            if (window.innerWidth <= 768) {
                // Mobile: toggle show/hide with overlay
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                // Desktop: toggle collapsed/expanded
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth <= 768) {
                // Mobile: remove desktop classes
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            } else {
                // Desktop: remove mobile classes
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const sidebarToggle = document.getElementById('sidebarToggle');
                const overlay = document.getElementById('sidebarOverlay');

                // Don't close if clicking inside sidebar or on toggle button
                if (!sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                    // Add small delay to allow Bootstrap dropdowns to work
                    setTimeout(() => {
                        sidebar.classList.remove('show');
                        overlay.classList.remove('show');
                    }, 100);
                }
            }
        });

        // Close sidebar when clicking overlay
        document.getElementById('sidebarOverlay').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });

        // Initialize sidebar state based on screen size
        function initializeSidebar() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const overlay = document.getElementById('sidebarOverlay');

            if (window.innerWidth <= 768) {
                sidebar.classList.remove('collapsed', 'show');
                mainContent.classList.remove('expanded');
                overlay.classList.remove('show');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', initializeSidebar);
    </script>

        <script>
            function confirmLogout(event) {
                event.preventDefault();
                if (confirm("Apakah Anda yakin ingin logout?")) {
                    document.getElementById('logout-form').submit();
                }
            }
        </script>

    @stack('scripts')
</body>

</html>
