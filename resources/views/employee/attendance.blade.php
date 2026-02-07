
@extends('layouts.app')

@section('content')


    
        <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

            <link rel="stylesheet" href="{{ asset('css/employeecss/dash.css') }}">
   
<style>
/* Pure CSS Flexbox Grid for Dashboard Cards */
.card-grid {
    display: flex;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.card-grid .card {
    flex: 1;
    min-width: 300px;
    background-color: var(--blue-white);
    padding: 1.25rem;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    border-radius: 4px;
}

/* (Rest of your existing styles are kept as-is) */
:root {
    /* Brand Color Palette with Purple Shades */
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

    /* Additional purple shades */
    --purple-light: #F3E8FF;
    --purple-soft: #DDD6FE;
    --purple-medium: #C4B5FD;
    --purple-deep: #6D28D9;

    /* Button & UI related */
    --border-color: #EBEDF3;
    --red-button: #E94B64;
    --green-button: #4CD964;
    --search-button: var(--primary-color);

    /* Shadow Colors */
    --shadow-light: rgba(134, 53, 253, 0.08);
    --shadow-medium: rgba(134, 53, 253, 0.15);
    --shadow-hover: rgba(134, 53, 253, 0.25);
}

body {
    background-color: var(--extra-light);
    color: var(--blue-dark);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container {
    padding-top: 1rem;
    padding-bottom: 2rem;
    max-width: var(--max-width);
    margin: 0 auto;
}

.container:before {
    content: "Dashboard / Attendance";
    display: block;
    color: var(--blue-slate);
    font-size: 12px;
    margin-bottom: 5px;
    opacity: 0.7;
}

.container:after {
    content: "";
    display: block;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), #6A11CB);
    width: 100%;
    margin-bottom: 20px;
    border-radius: 0 0 4px 4px;
}

h2, h5 {
    color: var(--blue-dark);
}

h2 {
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 1rem;
}

h5 {
    font-weight: 500;
    font-size: 16px;
    margin-bottom: 1rem;
}

.card-grid {
    display: flex;
    justify-content: space-between;
    gap: 1.5rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.card {
    flex: 1;
    min-width: 300px;
    background-color: var(--blue-white);
    padding: 1.25rem;
    box-shadow: 0 2px 5px var(--shadow-light);
    border-radius: 4px;
}

.card h5:first-child {
    border-bottom: 1px solid var(--border-color);
    padding-bottom: 10px;
    margin-bottom: 15px;
    font-size: 15px;
}

.card p {
    margin-bottom: 6px;
    font-size: 13px;
    color: var(--blue-dark);
    display: flex;
    justify-content: space-between;
}

.my-3 h3 {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    border: 2px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1.5rem auto;
    color: var(--blue-dark);
    font-size: 1.5rem;
    font-weight: 500;
}

.btn-danger, .btn-success, .btn-secondary {
    border-radius: 25px;
    font-weight: 500;
    padding: 0.5rem 1.5rem;
    border: none;
    width: 100%;
    max-width: 150px;
    margin: 0 auto;
    display: block;
    box-shadow: 0 2px 5px var(--shadow-medium);
}

.btn-danger {
    background-color: var(--red-button);
    color: var(--white);
}

.btn-success {
    background-color: var(--green-button);
    color: var(--white);
}

.btn-secondary {
    background-color: var(--purple-medium);
    color: var(--white);
}

.mt-3 {
    display: flex;
    justify-content: space-between;
    margin-top: 1.5rem !important;
    padding-top: 1rem;
    border-top: 1px solid var(--border-color);
}

.mt-3 p {
    margin-bottom: 0;
    color: var(--blue-slate);
    font-size: 13px;
}

.progress {
    height: 4px;
    border-radius: 2px;
    background-color: var(--extra-light);
    margin-bottom: 1.25rem;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background-color: var(--red-button);
}

.progress-bar.bg-info {
    background-color: #FFCE56 !important;
}

.progress-bar.bg-success {
    background-color: var(--green-button) !important;
}

.list-group-item {
    border: none;
    padding: 10px 0 10px 25px;
    position: relative;
    font-size: 13px;
}

.list-group-item:before {
    content: "";
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: var(--red-button);
    position: absolute;
    left: 0;
    top: 13px;
}

.list-group-item:after {
    content: "";
    width: 1px;
    height: 100%;
    background-color: var(--border-color);
    position: absolute;
    left: 5px;
    top: 18px;
    z-index: 0;
}

.list-group-item:last-child:after {
    display: none;
}

.form-inline {
    background-color: var(--blue-white);
    padding: 15px;
    border-radius: 4px;
    margin-bottom: 1rem;
    box-shadow: 0 2px 5px var(--shadow-light);
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.form-control {
    border-radius: 4px;
    border: 1px solid var(--border-color);
    padding: 0.5rem 0.75rem;
    background-color: #FBFBFD;
    height: 40px;
    flex: 1;
    min-width: 150px;
}

.form-inline .btn-success {
    background-color: var(--search-button);
    height: 40px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 600;
    flex: none;
}

.table {
    background-color: var(--blue-white);
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 2px 5px var(--shadow-light);
    margin-bottom: 2rem;
    width: 100%;
    border-collapse: collapse;
}

.thead-dark {
    background-color: var(--extra-light);
    color: var(--blue-dark);
}

.thead-dark th {
    border: none;
    font-weight: 500;
    padding: 1rem 0.75rem;
    font-size: 13px;
    border-bottom: 1px solid var(--border-color);
    text-align: left;
}

.table td {
    padding: 0.75rem;
    vertical-align: middle;
    color: var(--blue-dark);
    border-bottom: 1px solid var(--border-color);
    font-size: 13px;
}

.table tbody tr:hover {
    background-color: var(--extra-light);
}

.content {
    padding-left: 50px;
    padding-top: 40px;
}

</style>
 
          <!-- start: Sidebar -->
        <div class="sidebar">
            <a href="#" class="sidebar-brand">
                <img src="{{ asset('images/employee.png') }}" alt="" class="sidebar-brand-image" />
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
                    <div class="dropdown">
                       
                        <div class="dropdown-menu-wrapper">
                            
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
                                        <span class="dropdown-menu-item-link-icon"><i class="ri-user-line"></i></span>
                                        <span class="dropdown-menu-item-link-text">Profile</span>
                                    </a>
                                </li>
                                <li class="dropdown-menu-item">
                                    <a href="#" class="dropdown-menu-item-link">
                                        <span class="dropdown-menu-item-link-icon"><i class="ri-settings-line"></i></span>
                                        <span class="dropdown-menu-item-link-text">Settings</span>
                                    </a>
                                </li>
                                <li class="dropdown-menu-item">
                                    <a href="#" class="dropdown-menu-item-link">
                                        <span class="dropdown-menu-item-link-icon"><i class="ri-logout-circle-line"></i></span>
                                        <span class="dropdown-menu-item-link-text">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
           <div class="content">
                 <h2>Attendance Dashboard</h2>

    <!-- Three Cards in One Row (Pure CSS Flex) -->
    <div class="card-grid">
        <!-- Timesheet -->
        <div class="card text-center">
            <h5>Timesheet {{ now()->format('d M Y') }}</h5>
           <p class="mt-2">Punch In at<br><strong>{{ $attendance?->check_in ? \Carbon\Carbon::parse($attendance->check_in)->format('h:i A') : 'N/A' }}</strong></p>
            <div class="my-3">
                <h3>{{ $workedHours ?? '0.00' }} hrs</h3>
            </div>


            @if($attendance && !$attendance->check_out)
    <form method="POST" action="{{ route('attendance.checkout') }}">
        @csrf
        <button class="btn btn-danger">Punch Out</button>
    </form>
@elseif(!$attendance)
    <form method="POST" action="{{ route('attendance.checkin') }}">
        @csrf
        <button class="btn btn-success">Punch In</button>
    </form>
@else
    <button class="btn btn-secondary" disabled>Completed</button>
@endif

            <div class="mt-3">
                <p>Break: 1.21 hrs</p>
                <p>Overtime: 3 hrs</p>
            </div>
        </div>

        <!-- Statistics -->
        <div class="card">
            <h5>Statistics</h5>
            <p>Today: {{ $todayHours ?? 0 }} / 8 hrs</p>
            <div class="progress"><div class="progress-bar" style="width: {{ ($todayHours / 8) * 100 }}%"></div></div>

            <p>This Week: {{ $weekHours * -1 ?? 0 }} / 40 hrs</p>
            <div class="progress"><div class="progress-bar bg-info" style="width: {{ ($weekHours / 40) * 100 }}%"></div></div>

            <p>This Month: {{ $monthHours * -1 ?? 0 }} / 160 hrs</p>
            <div class="progress"><div class="progress-bar bg-success" style="width: {{ ($monthHours / 160) * 100 }}%"></div></div>

            <p>Overtime: {{ $overtime * -1 ?? 0 }} hrs</p>
        </div>

        <!-- Today Activity -->
        <div class="card">
            <h5>Today Activity</h5>
            <ul class="list-group list-group-flush">
               @foreach($activities as $activity)
    <li class="list-group-item d-flex justify-content-between">
        {{ $activity['type'] }} at 
        <strong>{{ \Carbon\Carbon::parse($activity['time'])->timezone(config('app.timezone'))->format('h:i A') }}</strong>
    </li>
@endforeach

            </ul>
        </div>
    </div>

    <!-- Filter + Table -->
    <form class="form-inline mb-3">
        <input type="date" name="date" class="form-control">
        <select name="month" class="form-control">
            <option value="">Select Month</option>
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
            @endforeach
        </select>
        <select name="year" class="form-control">
            @for($y = now()->year; $y >= now()->year - 5; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>
        <button class="btn btn-success">Search</button>
    </form>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Punch In</th>
                <th>Punch Out</th>
                <th>Production</th>
                <th>Break</th>
                <th>Overtime</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendances as $i => $a)
                <tr>
                    <td>{{ count($attendances) - $i }}</td>
                    <td>{{ $a->date }}</td>
                    <td>{{ \Carbon\Carbon::parse($a->check_in)->format('h:i A') }}</td>
                    <td>{{ $a->check_out ? \Carbon\Carbon::parse($a->check_out)->format('h:i A') : '-' }}</td>
                    <td>
    @if($a->check_in && $a->check_out)
        @php
            $in = \Carbon\Carbon::parse($a->check_in);
            $out = \Carbon\Carbon::parse($a->check_out);
            // Use absolute difference to avoid negative values
            $diffMinutes = $out->diffInMinutes($in);
            $hours = round($diffMinutes / 60, 2);
        @endphp
        {{ $hours * -1 }}  hrs
    @else
        0 hrs
    @endif
</td>
                    <td>{{ $a->break_minutes ? ($a->break_minutes / 60) : 1 }} hr</td>
                    <td>{{ $a->overtime_minutes ? ($a->overtime_minutes / 60) : 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
            </div>
        </div>
        <!-- end: Main -->
        <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
        <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
        <script src="{{ asset('js/empdash.js') }}"></script>
  
@endsection