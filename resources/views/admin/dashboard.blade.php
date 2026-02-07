@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/dash.css') }}">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- CONTENT -->
<section id="content">

    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#" class="nav-link">Dashboard</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">3</span> <!-- dynamic if needed -->
        </a>
        <a href="#" class="profile">
           <img src="{{ asset('images/people.png') }}" alt="Profile">
        </a>
    </nav>
    <!-- NAVBAR -->

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Admin Dashboard</h1>
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li><a class="active" href="#">Overview</a></li>
                </ul>
            </div>
        </div>

        <!-- Summary Cards -->
        <ul class="box-info">
            <li>
                <i class='bx bxs-calendar'></i>
                <span class="text">
                    <h3>{{ $holidays->count() }}</h3>
                    <p>Total Holidays</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-user'></i>
                <span class="text">
                    <h3>{{ $employeeList->count() }}</h3>
                    <p>Total Employees</p>
                </span>
            </li>
            <li>
                <i class='bx bxs-file'></i>
                <span class="text">
                    <h3>{{ $leaves->where('status', 'pending')->count() }}</h3>
                    <p>Pending Leaves</p>
                </span>
            </li>
        </ul>

        <!-- Quick Navigation -->
        <div class="quick-nav" style="margin: 2rem 0; display: flex; gap: 20px; flex-wrap: wrap;">
            <a href="{{ route('admin.holiday.index') }}" class="btn-download">
                <i class='bx bxs-calendar'></i>
                <span>Manage Holidays</span>
            </a>
            <a href="{{ route('admin.employeelist') }}" class="btn-download">
                <i class='bx bxs-user-detail'></i>
                <span>Manage Employees</span>
            </a>
            <a href="{{ route('admin.adminleave') }}" class="btn-download">
                <i class='bx bxs-file-find'></i>
                <span>Leave Requests</span>
            </a>
        </div>

        <!-- Tables Side-by-Side -->
<div style="display: flex; gap: 20px; flex-wrap: wrap;">

    <!-- Recent Leave Requests (Left) -->
    <div class="table-data" style="flex: 1;">
        <div class="order">
            <div class="head">
                <h3>Recent Leave Requests</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Type</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leaves->take(5) as $leave)
                    <tr>
                        <td>{{ $leave->employee->name }}</td>
                        <td>{{ $leave->leave_type }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('d M, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('d M, Y') }}</td>
                        <td>
                            <span class="status {{ strtolower($leave->status) }}">{{ ucfirst($leave->status) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No leave requests available.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Absent Employees (Right) -->
    <div class="table-data" style="flex: 1;">
        <div class="order">
            <div class="head">
                <h3>Absent Today</h3>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Email</th>
                        <th>Designation</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($absentEmployees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->designation }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">No absentees today.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-top: 2rem;">
    <!-- Attendance Chart -->
    <div style="flex: 1 1 500px; max-width: 600px; background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
        <h3 style="text-align: center; margin-bottom: 1rem;">Today's Attendance</h3>
        <div style="position: relative; height: 350px; width: 100%;">
            <canvas id="attendanceChart"></canvas>
        </div>
    </div>

    <!-- Leave Requests Chart -->
    <div style="flex: 1 1 500px; max-width: 600px; background: #fff; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.06);">
        <h3 style="text-align: center; margin-bottom: 1rem;">Leave Requests Status</h3>
        <div style="position: relative; height: 350px; width: 100%;">
            <canvas id="leaveChart"></canvas>
        </div>
    </div>
</div>



    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->
<script>
const attendanceCtx = document.getElementById('attendanceChart').getContext('2d');
const leaveCtx = document.getElementById('leaveChart').getContext('2d');

new Chart(attendanceCtx, {
    type: 'doughnut',
    data: {
        labels: ['Present', 'Absent'],
        datasets: [{
            data: [{{ $attendanceStats['present'] }}, {{ $attendanceStats['absent'] }}],
            backgroundColor: ['#36A2EB', '#FF6384'],
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
});

new Chart(leaveCtx, {
    type: 'bar',
    data: {
        labels: ['Pending', 'Approved', 'Rejected'],
        datasets: [{
            label: 'Leave Requests',
            data: [{{ $leaveStats['pending'] }}, {{ $leaveStats['approved'] }}, {{ $leaveStats['rejected'] }}],
            backgroundColor: ['#FFCE56', '#4BC0C0', '#FF6384']
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                precision: 0
            }
        }
    }
});
</script>

<script src="{{ asset('js/dash.js') }}"></script>

@endsection
