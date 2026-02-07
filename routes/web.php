<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController ;
use App\Http\Controllers\admin\EmployeeController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\employee\AttendanceController;
use App\Http\Controllers\admin\HolidayController;
use App\Http\Controllers\employee\LeaveController;
use App\Http\Controllers\admin\LeaveController as LeaveControllerAdmin;


use App\Http\Controllers\employee\DashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 

use App\Http\Controllers\NotificationController;



// Public page
Route::get('/', function() {
    return view('index');
})->name('index');

Route::get('/auth', function() {
    return view('auth');
})->name('auth');



// Guest-only routes
Route::middleware('guest.only')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
});

// Logout route
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated-only route
Route::middleware('auth')->group(function () {

    Route::get('/employee/employeedash', [DashboardController::class, 'employeeDashboard'])->name('employee.employeedash');

    
     Route::get('/attendance', [AttendanceController::class, 'index'])->name('employee.attendance');
    Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
    Route::post('/attendance/check-out', [AttendanceController::class, 'checkOut'])->name('attendance.checkout');

     Route::get('/leaves', [LeaveController::class, 'index'])->name('leaves.index');
    Route::post('/leaves', [LeaveController::class, 'store'])->name('leaves.store');
    Route::put('/leaves/{leave}', [LeaveController::class, 'update'])->name('leaves.update');
    Route::delete('/leaves/{leave}', [LeaveController::class, 'destroy'])->name('leaves.destroy');



    
Route::post('/notifications/mark-as-read', function(Request $request) {
    Auth::user()->unreadNotifications
        ->when($request->input('id'), function($query) use ($request) {
            return $query->where('id', $request->id);
        })
        ->markAsRead();
        
    return response()->noContent();
});
});

  Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->name('password.update');


// Admin routes
Route::middleware('admin.guest')->group(function () {
    Route::post('admin/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

});

// Admin routes - Apply 'admin.auth' to require admin authentication for these routes
Route::middleware('admin.auth')->group(function () {
   
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
  
     // Employee management routes
    Route::get('admin/employeelist', [EmployeeController::class, 'employeeList'])->name('admin.employeelist');
    Route::post('admin/employee/save', [EmployeeController::class, 'employeeSaveRecord'])->name('admin.employeesave');
    Route::get('admin/employee/{id}/edit', [EmployeeController::class, 'editEmployee'])->name('admin.employeeedit');
    Route::delete('admin/employee/{id}', [EmployeeController::class, 'deleteEmployee'])->name('admin.employeedelete');
    
    Route::get('/admin/holiday-list', [HolidayController::class, 'index'])->name('admin.holiday.index');  // << Add this
    Route::post('/admin/holiday-list', [HolidayController::class, 'store']);
    Route::put('/admin/holiday-list/{id}', [HolidayController::class, 'update']);
    Route::delete('/admin/holiday-list/{id}', [HolidayController::class, 'destroy']);


     Route::get('admin/leaves', [LeaveControllerAdmin::class, 'index'])->name('admin.adminleave');
    Route::put('admin/leaves/{leave}/status', [LeaveControllerAdmin::class, 'updateStatus'])->name('admin.adminleave.update-status');



});

Route::get('admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
            Route::get('/register', [AdminLoginController::class, 'register'])->name('register');
Route::post('/process-register', [AdminLoginController::class, 'processRegister'])->name('processRegister');


Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');

