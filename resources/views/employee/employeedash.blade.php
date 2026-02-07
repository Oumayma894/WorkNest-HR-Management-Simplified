@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
    /* Dashboard Content Styles */

.content {
    padding: 24px;
    min-height: calc(100vh - 64px);
}

.dashboard-container {
    max-width: 1600px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 24px;
}

/* Welcome Header */
.welcome-header {
    background: linear-gradient(135deg, #8B5CF6, #A855F7, #C084FC);
    border-radius: var(--rounded-xl);
    padding: 40px;
    color: var(--white);
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
    min-height: 180px;
}

/* Decorative elements */
.welcome-header::before {
    content: '';
    position: absolute;
    top: 20px;
    right: 20px;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 3s ease-in-out infinite;
}

.welcome-header::after {
    content: '';
    position: absolute;
    bottom: 30px;
    right: 100px;
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    animation: float 4s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.welcome-text {
    flex: 1;
    position: relative;
    z-index: 2;
}

.welcome-text h1 {
    font-size: var(--text-4xl);
    font-weight: 700;
    margin-bottom: 12px;
    position: relative;
    z-index: 1;
}

.welcome-text p {
    font-size: var(--text-lg);
    opacity: 0.95;
    position: relative;
    z-index: 1;
    margin-bottom: 20px;
    line-height: 1.6;
}

/* Illustrated Character Section */
.welcome-character {
    position: relative;
    display: flex;
    align-items: center;
    z-index: 2;
}

/* Speech Bubbles */
.speech-bubble {
    position: absolute;
    background: rgba(255, 255, 255, 0.95);
    color: var(--text-dark);
    padding: 8px 12px;
    border-radius: 12px;
    font-size: var(--text-sm);
    font-weight: 500;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    animation: bubble-float 2s ease-in-out infinite;
}

.speech-bubble::after {
    content: '';
    position: absolute;
    bottom: -6px;
    left: 20px;
    width: 0;
    height: 0;
    border-left: 6px solid transparent;
    border-right: 6px solid transparent;
    border-top: 6px solid rgba(255, 255, 255, 0.95);
}

.speech-bubble-1 {
    top: -40px;
    right: 20px;
    animation-delay: 0s;
}

.speech-bubble-2 {
    top: -20px;
    right: 80px;
    font-size: var(--text-xs);
    padding: 6px 10px;
    animation-delay: 1s;
}

@keyframes bubble-float {
    0%, 100% { transform: translateY(0px); opacity: 0.8; }
    50% { transform: translateY(-5px); opacity: 1; }
}

/* Character Illustration */
.character-illustration {
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin-left: 20px;
}

.character-illustration::before {
    content: '👋';
    font-size: 48px;
    animation: wave 2s ease-in-out infinite;
}

@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(20deg); }
    75% { transform: rotate(-10deg); }
}

/* Action Button */
.welcome-action {
    margin-top: 16px;
}

.welcome-btn {
    background: rgba(255, 255, 255, 0.2);
    color: var(--white);
    border: 2px solid rgba(255, 255, 255, 0.3);
    padding: 10px 20px;
    border-radius: var(--rounded-lg);
    text-decoration: none;
    font-size: var(--text-sm);
    font-weight: 600;
    transition: all var(--duration-300) ease;
    backdrop-filter: blur(10px);
    display: inline-block;
}

.welcome-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
    transform: translateY(-2px);
    color: var(--white);
}

.current-time {
    text-align: right;
    position: relative;
    z-index: 2;
    background: rgba(255, 255, 255, 0.1);
    padding: 16px;
    border-radius: var(--rounded-lg);
    backdrop-filter: blur(10px);
}

.time-display {
    font-size: var(--text-2xl);
    font-weight: 700;
    margin-bottom: 4px;
}

.date-display {
    font-size: var(--text-sm);
    opacity: 0.9;
}

/* Dashboard Grid */
.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 24px;
}

/* Card Styles */
.card {
    background: var(--white);
    border-radius: var(--rounded-xl);
    padding: 24px;
    box-shadow: var(--shadow-light);
    border: 1px solid var(--purple-soft);
    transition: all var(--duration-300) ease;
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--primary-color);
    transform: scaleY(0);
    transition: transform var(--duration-300) ease;
}

.card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
}

.card:hover::before {
    transform: scaleY(1);
}

.card-header {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
}

.card-icon {
    width: 48px;
    height: 48px;
    border-radius: var(--rounded-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    font-size: var(--text-xl);
    flex-shrink: 0;
}

.card-icon.primary {
    background: var(--purple-light);
    color: var(--primary-color);
}

.card-icon.success {
    background: var(--success-100);
    color: var(--success-600);
}

.card-icon.warning {
    background: var(--warning-100);
    color: var(--warning-600);
}

.card-icon.info {
    background: var(--info-100);
    color: var(--info-600);
}

.card-title {
    font-size: var(--text-lg);
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 2px;
}

.card-subtitle {
    font-size: var(--text-sm);
    color: var(--text-light);
}

.stat-value {
    font-size: var(--text-4xl);
    font-weight: 700;
    color: var(--primary-color);
    margin: 16px 0;
    line-height: 1;
}

/* Progress Bar */
.progress-bar {
    width: 100%;
    height: 8px;
    background-color: var(--purple-light);
    border-radius: var(--rounded-full);
    overflow: hidden;
    margin: 12px 0;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--primary-color), var(--secondry-color));
    border-radius: var(--rounded-full);
    transition: width var(--duration-300) ease;
    position: relative;
}

.progress-fill::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 20px;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3));
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* Weather Widget */
.weather-widget {
    background: linear-gradient(135deg, var(--warning-500), var(--warning-600));
    color: var(--white);
    padding: 24px;
    border-radius: var(--rounded-xl);
    text-align: center;
    box-shadow: var(--shadow-light);
    position: relative;
    overflow: hidden;
}

.weather-widget::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
    animation: rotate 10s linear infinite;
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.weather-widget > * {
    position: relative;
    z-index: 1;
}

.weather-temp {
    font-size: var(--text-3xl);
    font-weight: 700;
    margin: 8px 0;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
    margin-bottom: 32px;
}

.action-btn {
    background: var(--white);
    border: 2px solid var(--purple-soft);
    border-radius: var(--rounded-xl);
    padding: 20px;
    text-decoration: none;
    color: var(--text-dark);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: all var(--duration-300) ease;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left var(--duration-300) ease;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn i {
    font-size: var(--text-2xl);
    margin-bottom: 8px;
    transition: transform var(--duration-300) ease;
}

.action-btn:hover i {
    transform: scale(1.1);
}

.action-btn.primary {
    border-color: var(--primary-color);
    color: var(--primary-color);
}

.action-btn.primary:hover {
    background: var(--primary-color);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.action-btn.success {
    border-color: var(--success-500);
    color: var(--success-600);
}

.action-btn.success:hover {
    background: var(--success-500);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(34, 197, 94, 0.15);
}

.action-btn.warning {
    border-color: var(--warning-500);
    color: var(--warning-600);
}

.action-btn.warning:hover {
    background: var(--warning-500);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.15);
}

.action-btn.info {
    border-color: var(--info-600);
    color: var(--info-600);
}

.action-btn.info:hover {
    background: var(--info-600);
    color: var(--white);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.pulse {
    animation: pulse-effect 1s ease-in-out;
}

@keyframes pulse-effect {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Recent Activity */
.recent-activity {
    background: var(--white);
    border-radius: var(--rounded-xl);
    padding: 24px;
    box-shadow: var(--shadow-light);
    border: 1px solid var(--purple-soft);
    margin-bottom: 24px;
}

.activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--purple-light);
}

.activity-header h2 {
    font-size: var(--text-xl);
    font-weight: 600;
    color: var(--text-dark);
}

.activity-list {
    list-style: none;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 16px 0;
    border-bottom: 1px solid var(--purple-light);
    transition: background-color var(--duration-150) ease;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-item:hover {
    background-color: var(--extra-light);
    border-radius: var(--rounded-lg);
    margin: 0 -12px;
    padding: 16px 12px;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--rounded-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 12px;
    flex-shrink: 0;
}

.activity-icon.success {
    background: var(--success-100);
    color: var(--success-600);
}

.activity-icon.warning {
    background: var(--warning-100);
    color: var(--warning-600);
}

.activity-icon.info {
    background: var(--info-100);
    color: var(--info-600);
}

.activity-content {
    flex: 1;
    min-width: 0;
}

.activity-title {
    font-size: var(--text-base);
    font-weight: 500;
    color: var(--text-dark);
    margin-bottom: 2px;
}

.activity-time {
    font-size: var(--text-sm);
    color: var(--text-light);
}

.status-badge {
    padding: 4px 12px;
    border-radius: var(--rounded-full);
    font-size: var(--text-xs);
    font-weight: 600;
    flex-shrink: 0;
}

.status-badge.success {
    background: var(--success-100);
    color: var(--success-700);
}

.status-badge.warning {
    background: var(--warning-100);
    color: var(--warning-700);
}

.status-badge.info {
    background: var(--info-100);
    color: var(--info-700);
}

/* Chart Container */

/* CSS Variables for colors used in inline styles */
:root {
    --gray: var(--text-light);
    --light: var(--extra-light);
    --primary: var(--primary-color);
    --success: var(--success-500);
    --warning: var(--warning-500);
    --info: var(--info-600);
}

/* Responsive Design */
@media (max-width: 768px) {
    .content {
        padding: 16px;
    }
    
    .welcome-header {
        flex-direction: column;
        text-align: center;
        gap: 16px;
        padding: 24px;
    }
    
    .current-time {
        text-align: center;
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .quick-actions {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
    
    .activity-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
    }
    
    .activity-icon {
        margin-right: 0;
        margin-bottom: 8px;
    }
}

@media (max-width: 480px) {
    .welcome-text h1 {
        font-size: var(--text-2xl);
    }
    
    .stat-value {
        font-size: var(--text-3xl);
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .card {
        padding: 20px;
    }
}

:root {
  --primary-color: #8635FD;
  --secondry-color: #a274e6;
  --blue-light: #E9F0FF;
  --blue-dark: #070127;
  --blue-slate: #414753;
  --blue-muted: #C5C2DA;
  --blue-white: #FFFFFF;
  --text-dark: #0e0d16;
  --text-light: #767268;
  --extra-light: #f7f8fd;
  --white: #ffffff;
  --max-width: 1200px;

  --purple-light: #F3E8FF;
  --purple-soft: #DDD6FE;
  --purple-medium: #C4B5FD;
  --purple-deep: #6D28D9;
}

/* === Layout & Styling for Chart Section === */
.chart-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    .chart-container {
        background: var(--white);
        border-radius: var(--rounded-xl);
        padding: 20px;
        box-shadow: var(--shadow-light);
        border: 1px solid var(--purple-soft);
    }

    .chart-container h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 15px;
        text-align: center;
    }

    .chart-wrapper {
        position: relative;
        height: 200px; /* Fixed height for all charts */
        width: 100%;
    }

    .chart-span-1 {
        grid-column: span 1;
    }

    .chart-span-2 {
        grid-column: span 2;
    }

    @media (max-width: 768px) {
        .chart-section {
            grid-template-columns: 1fr;
        }
        
        .chart-span-1,
        .chart-span-2 {
            grid-column: span 1;
        }
        
        .chart-wrapper {
            height: 180px; /* Slightly smaller on mobile */
        }
        
        .chart-container h3 {
            font-size: 1rem;
        }
    }
.holiday-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        font-size: 0.95rem;
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    }

    .holiday-table thead {
        background-color: var(--primary-light, #f4f6fa);
    }

    .holiday-table th,
    .holiday-table td {
        padding: 12px 16px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }

    .holiday-table tbody tr:hover {
        background-color: #f9f9f9;
    }

    .holiday-table th {
        font-weight: 600;
        color: #333;
    }

    .holiday-table td {
        color: #555;
    }

    .holiday-list h2 {
        font-size: 1.25rem;
        margin-bottom: 0.75rem;
        color: var(--primary-dark, #222);
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">
    
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/employeecss/dash.css') }}">

<!-- start: Sidebar -->
<div class="sidebar">
    <a href="#" class="sidebar-brand">
        <img src="{{ asset('images/employee.png') }}" alt="Profile" class="sidebar-brand-image" />  
        <span class="sidebar-brand-text">{{ Auth::user()->name }}</span>
    </a>
    <div class="sidebar-menu-wrapper">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title">
                <span class="sidebar-menu-title-expanded">MENU</span>
                <span class="sidebar-menu-title-collapsed"><i class="ri-more-fill"></i></span>
            </li>
            
            <li class="sidebar-menu-item" data-sidebar-menu-item>
                <a href="{{ route('employee.employeedash') }}" class="sidebar-menu-item-link" data-sidebar-menu-toggle>
                    <span class="sidebar-menu-item-link-icon">
                        <i class="ri-dashboard-3-line"></i>
                    </span>
                    <span class="sidebar-menu-item-link-text">Dashboard</span>
                    <span class="sidebar-menu-item-link-arrow">
                        <i class="ri-arrow-right-s-line"></i>
                    </span>
                </a>
            </li>

            <li class="sidebar-menu-item" data-sidebar-menu-item>
                <a href="{{ route('employee.attendance') }}" class="sidebar-menu-item-link" data-sidebar-menu-toggle>
                    <span class="sidebar-menu-item-link-icon">
                        <i class="ri-apps-2-line"></i>
                    </span>
                    <span class="sidebar-menu-item-link-text">Attendance</span>
                    <span class="sidebar-menu-item-link-arrow">
                        <i class="ri-arrow-right-s-line"></i>
                    </span>
                </a>
            </li>
        </ul>
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title">
                <span class="sidebar-menu-title-expanded">MENU</span>
                <span class="sidebar-menu-title-collapsed"><i class="ri-more-fill"></i></span>
            </li>
            <li class="sidebar-menu-item" data-sidebar-menu-item>
                <a href="{{ route('leaves.index') }}" class="sidebar-menu-item-link" data-sidebar-menu-toggle>
                    <span class="sidebar-menu-item-link-icon">
                        <i class="ri-dashboard-3-line"></i>
                    </span>
                    <span class="sidebar-menu-item-link-text">Leave Request</span>
                    <span class="sidebar-menu-item-link-arrow">
                        <i class="ri-arrow-right-s-line"></i>
                    </span>
                </a>
            </li>
           
        </ul>
    </div>
</div>
<div class="sidebar-overlay" data-sidebar-dismiss=""></div>
<!-- end: Sidebar -->

<!-- start: Main -->
<div class="main">
    <div class="topbar">
        <button type="button" class="btn btn-icon btn-light topbar-sidebar-toggle" data-sidebar-toggle><i class="ri-menu-line"></i></button>
        <div class="topbar-search-wrapper">
            <button type="button" class="btn btn-icon btn-light topbar-search-back" data-dismiss="topbar-search">
                <i class="ri-arrow-left-line"></i>
            </button>
            <form class="topbar-search">
                <input type="text" class="form-control" placeholder="Search..." />
                <span class="topbar-search-icon"><i class="ri-search-line"></i></span>
            </form>
        </div>
        <div class="topbar-right">
            <button type="button" class="btn btn-icon btn-light topbar-right-item-search" data-toggle="topbar-search">
                <i class="ri-search-line"></i>
            </button>
            {{-- Notifications Dropdown --}}
<div class="dropdown">
    <button type="button" class="btn btn-icon btn-light topbar-right-item" data-toggle="dropdown">
        <i class="ri-notification-3-line"></i>
        @if($notifications->count() > 0)
            <span class="topbar-right-item-total">{{ $notifications->whereNull('read_at')->count() }}</span>
        @endif
    </button>
    <div class="dropdown-menu-wrapper">
        <div class="dropdown-content">
            <div class="dropdown-content-header d-flex justify-content-between align-items-center">
                <p class="dropdown-content-title mb-0">Notifications</p>
                <span class="badge badge-primary-soft">{{ $notifications->count() }} items</span>
                @if($notifications->count() > 0)
                    <button class="btn btn-sm btn-link text-muted" onclick="markAllAsRead()" title="Mark all as read">
                        <i class="ri-check-double-line"></i>
                    </button>
                @endif
            </div>
            <div class="dropdown-content-body">
                <div class="dropdown-notification-wrapper">
                    @forelse($notifications as $notification)
                        <a href="#" class="dropdown-notification-item {{ $notification->read_at ? 'read' : 'unread' }}">
                            <span class="dropdown-notification-item-icon {{ $notification->data['color'] ?? 'primary' }}-soft">
                                <i class="{{ $notification->data['icon'] ?? 'ri-notification-line' }}"></i>
                            </span>
                            <div>
                                <p class="dropdown-notification-item-title mb-0">
                                    {{ $notification->data['title'] ?? 'Notification' }}
                                </p>
                                <small class="dropdown-notification-item-time text-muted">
                                    {{ $notification->created_at->diffForHumans() }}
                                </small>
                            </div>
                            @if(!$notification->read_at)
                                <button class="btn btn-sm btn-link text-muted ms-auto" onclick="event.stopPropagation(); markAsRead('{{ $notification->id }}')" title="Mark as read">
                                    <i class="ri-close-line"></i>
                                </button>
                            @endif
                        </a>
                    @empty
                        <div class="text-center py-3">
                            <i class="ri-notification-off-line text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2">No notifications</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
 
            <div class="dropdown">
                <button type="button" class="btn btn-icon btn-light topbar-right-item" data-toggle="dropdown">
                    <img src="{{ asset('images/employee.png') }}" alt="" class="topbar-right-item-user-image" />
                </button>
                <div class="dropdown-menu-wrapper">
                    <ul class="dropdown-menu">
                        <li class="dropdown-menu-item">
                            <a href="#" class="dropdown-menu-item-link">
                                <span class="dropdown-menu-item-link-icon"><i class="ri-logout-circle-line"></i></span>
                                <a class="dropdown-menu-item-link-text" href="{{ route('logout') }}">Logout</a>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="content">

        
<style>
.notification-item.unread {
    background-color: #f8f9fa;
    border-left: 3px solid #0d6efd;
}

.notification-item.read {
    opacity: 0.7;
}

.notification-icon i {
    font-size: 1.5rem;
}
.dropdown-notification-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #e9ecef;
    text-decoration: none;
    color: inherit;
}

.dropdown-notification-item.unread {
    background-color: #f1f5f9;
    font-weight: 500;
}

.dropdown-notification-item.read {
    opacity: 0.7;
}

.dropdown-notification-item-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 50%;
}

.primary-soft {
    background-color: #e0f0ff;
    color: #0d6efd;
}

.success-soft {
    background-color: #d1f4e3;
    color: #198754;
}

.danger-soft {
    background-color: #fbe2e3;
    color: #dc3545;
}

</style>

<script>
function markAsRead(notificationId) {
    fetch(`/notifications/${notificationId}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}

function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    });
}
</script>


        <div class="dashboard-container">
            <!-- Welcome Header -->
<div class="welcome-header">
    <div class="welcome-text">
        <h1>Welcome, {{ Auth::user()->name }}!</h1>
        <p>You have 3 pending tasks and 2 notifications. Let's get productive today!</p>
        <div class="welcome-action">
            <a href="#" class="welcome-btn">Let's check this</a>
        </div>
    </div>
    
    <div class="welcome-character">
        <!-- Speech Bubbles -->
        <div class="speech-bubble speech-bubble-1">
            Great day ahead! 🌟
        </div>
        <div class="speech-bubble speech-bubble-2">
            💬
        </div>
        
        <!-- Character Illustration -->
        <div class="character-illustration"></div>
    </div>
    
    <div class="current-time">
        <div class="time-display" id="currentTime">10:30 AM</div>
        <div class="date-display" id="currentDate">Monday, June 5, 2025</div>
    </div>
</div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- Attendance Status -->
<div class="card">
    <div class="card-header">
        <div class="card-icon primary">
            <i class="ri-time-line"></i>
        </div>
        <div>
            <div class="card-title">Today's Attendance</div>
            <div class="card-subtitle">Check-in Status</div>
        </div>
    </div>
    <div class="stat-value">{{ $todayHours }} hrs</div>
    <div class="progress-bar">
        <div class="progress-fill" style="width: {{ min(100, ($todayHours / 8) * 100) }}%"></div>
    </div>
    <p style="color: var(--gray); font-size: 0.9rem;">
        @if($attendance)
            Checked in at {{ \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') }}
            • {{ $attendance->break_minutes ?? 0 }} min break
        @else
            Not checked in today.
        @endif
    </p>
</div>


               <!-- Leave Balance -->
<div class="card">
    <div class="card-header">
        <div class="card-icon success">
            <i class="ri-calendar-check-line"></i>
        </div>
        <div>
            <div class="card-title">Leave Balance</div>
            <div class="card-subtitle">Status Summary</div>
        </div>
    </div>
    <div class="stat-value">{{ $total }} requests</div>
    <div style="display: flex; justify-content: space-between; margin-top: 1rem;">
        <span style="color: var(--success);">Approved: {{ $approved }}</span>
        <span style="color: var(--warning);">Pending: {{ $pending }}</span>
        <span style="color: var(--danger);">Declined: {{ $declined }}</span>
    </div>
</div>


                <!-- Performance -->
<div class="card">
    <div class="card-header">
        <div class="card-icon warning">
            <i class="ri-trophy-line"></i>
        </div>
        <div>
            <div class="card-title">Monthly Work</div>
            <div class="card-subtitle">Total Hours</div>
        </div>
    </div>
    <div class="stat-value">{{ $monthHours * -1 }} hrs</div>
    <div class="progress-bar">
        @php
            $target = 160; // Example target
            $percentage = min(100, ($monthHours / $target) * 100);
        @endphp
        <div class="progress-fill" style="width: {{ $percentage }}%; background: var(--success);"></div>
    </div>
    <p style="color: var(--success); font-size: 0.9rem;">
        {{ $percentage >= 100 ? 'Target met! 🎯' : 'Keep going!' }}
    </p>
</div>

                <!-- Weather Widget -->
                <div class="weather-widget">
                    <i class="ri-sun-line" style="font-size: 2rem;"></i>
                    <div class="weather-temp">24°C</div>
                    <div>Sunny • Nador</div>
                    <div style="font-size: 0.9rem; margin-top: 0.5rem; opacity: 0.8;">
                        Perfect weather for work!
                    </div>
                </div>
            </div>

<div class="activity-holiday-wrapper" style="display: flex; gap: 2rem; flex-wrap: wrap;">
    
    <!-- Recent Activity (Left Column) -->
    <div class="recent-activity" style="flex: 1; min-width: 300px;">
        <div class="activity-header">
            <h2>Recent Activity</h2>
        </div>
        <ul class="activity-list">
            @forelse($recentActivities as $activity)
                <li class="activity-item">
                    <div class="activity-icon {{ $activity['icon_class'] }}">
                        <i class="{{ $activity['icon'] }}"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">{{ $activity['title'] }}</div>
                        <div class="activity-time">{{ $activity['time']->diffForHumans() }}</div>
                    </div>
                    <div class="status-badge {{ $activity['status_class'] }}">{{ $activity['status'] }}</div>
                </li>
            @empty
                <li class="activity-item">
                    <div class="activity-icon info">
                        <i class="ri-information-line"></i>
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">No recent activity</div>
                        <div class="activity-time">Start by checking in or requesting leave</div>
                    </div>
                    <div class="status-badge info">Info</div>
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Holiday List (Right Column) -->
    <div class="holiday-list" style="flex: 1; min-width: 300px;">
        <h2>Upcoming Holidays</h2>
        <table class="holiday-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @forelse($holidays as $holiday)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($holiday->date)->format('M d, Y') }}</td>
                        <td>{{ $holiday->name }}</td>
                        <td>{{ ucfirst($holiday->type) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No upcoming holidays</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

<div class="chart-section"> 
    <!-- Attendance Chart -->
    <div class="chart-container chart-span-1">
        <h3>Weekly Attendance Overview</h3>
        <div class="chart-wrapper">
            <canvas id="attendanceChart" height="200"></canvas>
        </div>
    </div>

    <div class="chart-container chart-span-1">
        <h3>Monthly Working Hours</h3>
        <div class="chart-wrapper">
            <canvas id="lineChart" height="200"></canvas>
        </div>
    </div>

    <div class="chart-container chart-span-2">
        <h3>Leave Status</h3>
        <div class="chart-wrapper">
            <canvas id="doughnutChart" height="200"></canvas>
        </div>
    </div>
</div>



        </div>
    </div>
</div>
<!-- end: Main -->
<script>
     // Enhanced Weekly Attendance Chart
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(array_column($weeklyAttendance, 'day')) !!},
            datasets: [{
                label: 'Hours Worked',
                data: {!! json_encode(array_column($weeklyAttendance, 'hours')) !!},
                backgroundColor: 'rgba(134, 53, 253, 0.7)',
                borderColor: 'rgba(134, 53, 253, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Hours',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Enhanced Monthly Working Hours Line Chart
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    new Chart(lineCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_column($dailyHours, 'day')) !!},
            datasets: [{
                label: 'Hours per Day',
                data: {!! json_encode(array_column($dailyHours, 'hours')) !!},
                borderColor: 'rgba(134, 53, 253, 1)',
                backgroundColor: 'rgba(134, 53, 253, 0.1)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: 'rgba(134, 53, 253, 1)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    cornerRadius: 8
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Hours',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // Enhanced Leave Status Doughnut Chart
    const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
    new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode(array_keys($leaveStats)) !!},
            datasets: [{
                data: {!! json_encode(array_values($leaveStats)) !!},
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)', // approved
                    'rgba(255, 193, 7, 0.8)', // pending
                    'rgba(220, 53, 69, 0.8)'  // rejected
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(255, 193, 7, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 2,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        font: {
                            size: 12,
                            weight: 'bold'
                        },
                        boxWidth: 12,
                        boxHeight: 12
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0,0,0,0.8)',
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    },
                    padding: 12,
                    cornerRadius: 8
                }
            },
            cutout: '70%'
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
<script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
<script src="{{ asset('js/empdash.js') }}"></script>

<script>
    // Update time every second
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit',
            hour12: true
        });
        const dateString = now.toLocaleDateString('en-US', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        document.getElementById('currentTime').textContent = timeString;
        document.getElementById('currentDate').textContent = dateString;
    }

    updateTime();
    setInterval(updateTime, 1000);

    // Add some interactivity
    document.querySelectorAll('.action-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('pulse');
            setTimeout(() => {
                this.classList.remove('pulse');
            }, 1000);
        });
    });
</script>
@endsection