<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller 
{
    public function employeeList() 
    {
        $employeeList = Employee::all();
        $lastEmployee = Employee::latest('id')->first();
        
        if ($lastEmployee && $lastEmployee->employee_code) {
            $lastNumber = (int) substr($lastEmployee->employee_code, 4);
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1;
        }
        
        $employeeId = 'EMP_' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        
        return view('admin.employeelist', compact('employeeList', 'employeeId'));
    }
    
   public function employeeSaveRecord(Request $request) 
{
    $validationRules = [
        'employee_code' => 'required|string|unique:employees,employee_code,'.$request->employee_id,
        'name' => 'required|string|max:255',
        'designation' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.($request->employee_id ? Employee::find($request->employee_id)->user_id : 'NULL'),
        'phone' => 'nullable|string|max:20',
        'location' => 'nullable|string|max:255',
        'experience' => 'nullable|string|max:255',
        'joining_date' => 'required|date',
    ];

    $validator = Validator::make($request->all(), $validationRules);

    if ($validator->fails()) {
        return response()->json([
            'errors' => $validator->errors(),
            'message' => 'Validation failed. Please check your inputs.'
        ], 422);
    }

    try {
        DB::beginTransaction();

        $userData = [
    'name' => $request->name,
    'email' => $request->email,
    'password' => '', // Leave it blank or use a placeholder
];

        if ($request->employee_id) {
            // Update existing employee
            $employee = Employee::findOrFail($request->employee_id);
            $employee->user->update($userData);
            $employee->update($request->except(['_token', 'email', 'name']));
            $message = 'Employee updated successfully!';
        } else {
    // 1. Create new user with temporary random password
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make(Str::random(16)), // Temporary password
        'role' => 'employee',
    ]);

    // 2. Link user to employee
    $employeeData = $request->except('_token');
    $employeeData['user_id'] = $user->id;
    Employee::create($employeeData);

    // 3. Send password setup link
    Password::sendResetLink(['email' => $user->email]);

    $message = 'Employee added successfully and password setup link sent!';
}

       DB::commit(); 

        return response()->json([
            'success' => true,
            'message' => $message
        ]);
        
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'error' => true,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}
    
    public function editEmployee($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }
    
    public function deleteEmployee($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();
            return redirect()->route('admin.employeelist')->with('success', 'Employee deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting employee: ' . $e->getMessage());
        }
    }
}