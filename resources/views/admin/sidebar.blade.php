@extends('layouts.app')

@section('content')


 <link rel="stylesheet" href="{{ asset('css/admincss/dash.css') }}">

   <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet"
  >

<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">AdminDash</span>
		</a>
		<ul class="side-menu top">
			<li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <a href="{{ route('admin.dashboard') }}">
        <i class='bx bxs-dashboard' ></i>
        <span class="text">Dashboard</span>
    </a>
</li>
<li class="{{ request()->routeIs('admin.holiday.index') ? 'active' : '' }}">
    <a href="{{ route('admin.holiday.index') }}">
       <i class="fa-regular fa-calendar" style="margin-right: 12px; margin-left: 12px;"></i>
        <span class="text">Holiday List</span>
    </a>
</li>
			
			<li class="{{ request()->routeIs('admin.holiday.index') ? 'active' : '' }}">
				<a href="{{ route('admin.adminleave') }}">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Leave Requests</span>
				</a>
			</li>
			
			<li class="{{ request()->routeIs('admin.employeelist') ? 'active' : '' }}">
    <a href="{{ route('admin.employeelist') }}">
        <i class='bx bxs-group' ></i>
        <span class="text">Employee List</span>
    </a>
</li>
		</ul>
		<ul class="side-menu">
			<li {{ request()->routeIs('admin.logout') ? 'active' : '' }}">
				<a href="{{ route('admin.logout') }}" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

    
	<!-- SIDEBAR -->
