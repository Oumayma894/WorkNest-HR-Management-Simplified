<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Laravel 11 Multi Auth</title>
   <style>
      /* Reset and Base Styles */
      * {
         margin: 0;
         padding: 0;
         box-sizing: border-box;
      }
      
      body {
         font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
         line-height: 1.5;
         color: #212529;
         background-color: #f8f9fa;
      }
      
      /* Container */
      .container {
         width: 100%;
         max-width: 1140px;
         padding-right: 15px;
         padding-left: 15px;
         margin-right: auto;
         margin-left: auto;
      }
      
      /* Navbar */
      .navbar {
         position: relative;
         display: flex;
         flex-wrap: wrap;
         align-items: center;
         justify-content: space-between;
         padding: 0.5rem 1rem;
         background-color: #fff;
         box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      }
      
      .navbar-brand {
         display: inline-block;
         padding-top: 0.3125rem;
         padding-bottom: 0.3125rem;
         margin-right: 1rem;
         font-size: 1.25rem;
         line-height: inherit;
         white-space: nowrap;
         text-decoration: none;
         color: #212529;
      }
      
      .navbar-toggler {
         background-color: transparent;
         border: none;
         padding: 0.25rem 0.75rem;
         font-size: 1.25rem;
         line-height: 1;
         cursor: pointer;
         display: none;
      }
      
      .navbar-nav {
         display: flex;
         flex-direction: row;
         padding-left: 0;
         margin-bottom: 0;
         list-style: none;
      }
      
      .nav-item {
         position: relative;
      }
      
      .nav-link {
         display: block;
         padding: 0.5rem 1rem;
         text-decoration: none;
         color: #212529;
      }
      
      .nav-link:hover {
         color: #0d6efd;
      }
      
      /* Dropdown */
      .dropdown {
         position: relative;
      }
      
      .dropdown-toggle {
         position: relative;
         cursor: pointer;
      }
      
      .dropdown-toggle::after {
         display: inline-block;
         margin-left: 0.255em;
         vertical-align: 0.255em;
         content: "";
         border-top: 0.3em solid;
         border-right: 0.3em solid transparent;
         border-bottom: 0;
         border-left: 0.3em solid transparent;
      }
      
      .dropdown-menu {
         position: absolute;
         top: 100%;
         right: 0;
         z-index: 1000;
         display: none;
         min-width: 10rem;
         padding: 0.5rem 0;
         margin: 0.125rem 0 0;
         font-size: 1rem;
         color: #212529;
         text-align: left;
         list-style: none;
         background-color: #fff;
         background-clip: padding-box;
         border-radius: 0.25rem;
         box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      }
      
      .dropdown-menu.show {
         display: block;
         animation: zoomIn 0.2s ease-in-out;
      }
      
      @keyframes zoomIn {
         from {
            opacity: 0;
            transform: scale(0.95);
         }
         to {
            opacity: 1;
            transform: scale(1);
         }
      }
      
      .dropdown-item {
         display: block;
         width: 100%;
         padding: 0.25rem 1rem;
         clear: both;
         font-weight: 400;
         color: #212529;
         text-align: inherit;
         text-decoration: none;
         white-space: nowrap;
         background-color: transparent;
         border: 0;
      }
      
      .dropdown-item:hover, .dropdown-item:focus {
         color: #1e2125;
         background-color: #f8f9fa;
      }
      
      /* Card */
      .card {
         position: relative;
         display: flex;
         flex-direction: column;
         min-width: 0;
         word-wrap: break-word;
         background-color: #fff;
         background-clip: border-box;
         border-radius: 0.25rem;
         box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
         margin-top: 3rem;
         margin-bottom: 3rem;
      }
      
      .card-header {
         padding: 0.75rem 1.25rem;
         margin-bottom: 0;
         background-color: #f8f9fa;
         border-bottom: 1px solid rgba(0, 0, 0, 0.125);
      }
      
      .card-body {
         flex: 1 1 auto;
         padding: 1.25rem;
      }
      
      /* Typography */
      h1, h2, h3, h4, h5, h6 {
         margin-top: 0;
         margin-bottom: 0.5rem;
         font-weight: 500;
         line-height: 1.2;
      }
      
      .h5 {
         font-size: 1.25rem;
      }
      
      /* Spacing */
      .my-5 {
         margin-top: 3rem;
         margin-bottom: 3rem;
      }
      
      .pt-2 {
         padding-top: 0.5rem;
      }
      
      /* Utilities */
      .bg-light {
         background-color: #f8f9fa !important;
      }
      
      .justify-content-end {
         justify-content: flex-end !important;
      }
      
      .flex-grow-1 {
         flex-grow: 1 !important;
      }
      
      /* Offcanvas for mobile */
      .offcanvas {
         position: fixed;
         bottom: 0;
         right: -300px; /* Start off-screen */
         width: 300px;
         height: 100%;
         z-index: 1045;
         background-color: #fff;
         transition: all 0.3s ease-in-out;
         overflow-y: auto;
      }
      
      .offcanvas.show {
         right: 0;
      }
      
      .offcanvas-header {
         display: flex;
         align-items: center;
         justify-content: space-between;
         padding: 1rem;
         border-bottom: 1px solid #dee2e6;
      }
      
      .offcanvas-title {
         margin-bottom: 0;
         line-height: 1.5;
      }
      
      .btn-close {
         box-sizing: content-box;
         width: 1em;
         height: 1em;
         padding: 0.25em 0.25em;
         color: #000;
         background: transparent url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23000'%3e%3cpath d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/%3e%3c/svg%3e") center/1em auto no-repeat;
         border: 0;
         border-radius: 0.25rem;
         opacity: .5;
         cursor: pointer;
      }
      
      .offcanvas-body {
         flex-grow: 1;
         padding: 1rem;
         overflow-y: auto;
      }
      
      /* Responsive styles */
      @media (max-width: 767.98px) {
         .navbar-nav {
            display: none;
         }
         
         .navbar-toggler {
            display: block;
         }
         
         .offcanvas .navbar-nav {
            display: block;
         }
         
         .offcanvas .nav-item {
            margin-bottom: 0.5rem;
         }
         
         .offcanvas .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0.5rem;
            box-shadow: none;
         }
      }
      
      /* Backdrop for offcanvas */
      .offcanvas-backdrop {
         position: fixed;
         top: 0;
         left: 0;
         width: 100vw;
         height: 100vh;
         background-color: rgba(0, 0, 0, 0.5);
         z-index: 1040;
         display: none;
      }
      
      .offcanvas-backdrop.show {
         display: block;
      }
   </style>
</head>
<body>
   <nav class="navbar">
      <div class="container">
         <a class="navbar-brand" href="#">
            <strong>Laravel 11 Multi Auth</strong>
         </a>
         <button class="navbar-toggler" type="button" id="navbarToggler">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
               <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
         </button>
         <ul class="navbar-nav justify-content-end flex-grow-1">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#!" id="accountDropdown">Hello, {{ Auth::user()->name }}</a>
               <ul class="dropdown-menu" id="accountDropdownMenu">
                  <li>
                     <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                  </li>
                  <li>
                     <a class="dropdown-item" href="{{ route('employee.attendance') }}">Attendance</a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </nav>
   
   <div id="offcanvasNavbar" class="offcanvas">
      <div class="offcanvas-header">
         <h5 class="offcanvas-title">Menu</h5>
         <button type="button" class="btn-close" id="offcanvasClose"></button>
      </div>
      <div class="offcanvas-body">
         <ul class="navbar-nav">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#!" id="mobileAccountDropdown">Hello, {{ Auth::user()->name }}</a>
               <ul class="dropdown-menu" id="mobileAccountDropdownMenu">
                  <li>
                     <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                  </li>
                  <li>
                     <a class="dropdown-item" href="{{ route('employee.attendance') }}">Attendance</a>
                  </li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   
   <div id="offcanvasBackdrop" class="offcanvas-backdrop"></div>
   
   <div class="container">
      <div class="card my-5">
         <div class="card-header bg-light">
            <h3 class="h5 pt-2">Dashboard</h3>
         </div>
         <div class="card-body">
            You are logged in !!
         </div>
      </div>
   </div>

   <script>
      // Dropdown functionality
      document.addEventListener('DOMContentLoaded', function() {
         // Desktop dropdown
         const accountDropdown = document.getElementById('accountDropdown');
         const accountDropdownMenu = document.getElementById('accountDropdownMenu');
         
         accountDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            accountDropdownMenu.classList.toggle('show');
         });
         
         // Close dropdown when clicking outside
         document.addEventListener('click', function(e) {
            if (!accountDropdown.contains(e.target)) {
               accountDropdownMenu.classList.remove('show');
            }
         });
         
         // Mobile dropdown
         const mobileAccountDropdown = document.getElementById('mobileAccountDropdown');
         const mobileAccountDropdownMenu = document.getElementById('mobileAccountDropdownMenu');
         
         mobileAccountDropdown.addEventListener('click', function(e) {
            e.preventDefault();
            mobileAccountDropdownMenu.classList.toggle('show');
         });
         
         // Offcanvas functionality
         const navbarToggler = document.getElementById('navbarToggler');
         const offcanvasNavbar = document.getElementById('offcanvasNavbar');
         const offcanvasClose = document.getElementById('offcanvasClose');
         const offcanvasBackdrop = document.getElementById('offcanvasBackdrop');
         
         navbarToggler.addEventListener('click', function() {
            offcanvasNavbar.classList.add('show');
            offcanvasBackdrop.classList.add('show');
            document.body.style.overflow = 'hidden';
         });
         
         function closeOffcanvas() {
            offcanvasNavbar.classList.remove('show');
            offcanvasBackdrop.classList.remove('show');
            document.body.style.overflow = '';
         }
         
         offcanvasClose.addEventListener('click', closeOffcanvas);
         offcanvasBackdrop.addEventListener('click', closeOffcanvas);
      });
   </script>
</body>
</html>