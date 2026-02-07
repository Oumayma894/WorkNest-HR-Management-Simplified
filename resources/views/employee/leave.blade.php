
@extends('layouts.app')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />

<link rel="stylesheet" href="{{ asset('css/employeecss/dash.css') }}">
   
<style>
:root {
  --primary: #0d6efd;
  --secondary: #6c757d;
  --success: #3ac47d;
  --warning: #f7b924;
  --danger: #d92550;
  --light: #f1f4f9;
  --gray: #adb5bd;
  --dark: #343a40;
  --card-bg: #fff;
  --border: #e9ecef;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}
* {box-sizing: border-box; margin: 0; padding: 0;}
body {background: #f3f5f9; color: var(--dark); padding: 1rem;}

h1 {font-size: 1.25rem; margin-bottom: 1rem;}
button {cursor: pointer; border: none;}

/* cards */
.card-row {display: flex; gap: 1rem; margin-bottom: 1.5rem; flex-wrap: wrap;}
.card {flex: 1 1 200px; display: flex; align-items: center; padding: 1rem; border-radius: 0.5rem; background: var(--card-bg); box-shadow: 0 1px 3px rgba(0,0,0,0.08);} 
.card-icon {width: 40px; height: 40px; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; margin-right: 0.75rem; font-size: 1.25rem; color: #fff; font-weight: 600;}
.card h2 {font-size: 1.5rem; font-weight: 600;}
.card p {font-size: 0.875rem; color: var(--gray);} 
.icon-balance {background: #d63384;}
.icon-annual {background: #198754;}
.icon-medical {background: #6f42c1;}
.icon-remaining {background: #0dcaf0;}

/* table */
.table-container {background: #fff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.08); padding: 1rem;}
.table-controls {display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;}
.add-btn {background: #8635FD; color: #fff; padding: 0.5rem 1rem; border-radius: 0.4rem; font-weight: 500;}

 table {width: 100%; border-collapse: collapse; font-size: 0.875rem;}
 th, td {padding: 0.75rem; border-bottom: 1px solid var(--border); text-align: left;}
 th {font-weight: 600;}

.status {padding: 0.25rem 0.75rem; border-radius: 0.4rem; font-size: 0.75rem; font-weight: 600; display: inline-block;}
.status.approved {background: rgba(58,196,125,0.15); color: var(--success);} 
.status.pending {background: rgba(247,185,36,0.15); color: var(--warning);} 
.status.declined {background: rgba(217,37,80,0.15); color: var(--danger);} 

.action-btn {background: none; border: none; font-size: 1rem; color: var(--primary); padding: 0.25rem;}

/* modal */
.modal {position: fixed; top: 0; left: 0; width: 100%; height: 100%; display: none; align-items: center; justify-content: center; background: rgba(0,0,0,0.4); z-index: 100;}
.modal.active {display: flex;}
.modal-content {background: #fff; width: 90%; max-width: 650px; border-radius: 0.5rem; padding: 1.5rem; max-height: 90vh; overflow: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.15);} 
.modal-header {display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;}
.modal-header h3 {font-size: 1.125rem;}
.close-modal {background: none; font-size: 1.25rem; border: none;}

.form-row {display: flex; gap: 1rem; margin-bottom: 1rem;}
.form-group {flex: 1; display: flex; flex-direction: column;}
label {font-size: 0.8rem; margin-bottom: 0.25rem; color: var(--dark);} 
input, select, textarea {padding: 0.5rem; border: 1px solid var(--border); border-radius: 0.35rem; font-size: 0.875rem;}
textarea {resize: vertical; min-height: 80px;}

.modal-actions {display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1rem;}
.reset-btn {background: var(--light); color: var(--dark); padding: 0.5rem 1rem; border-radius: 0.35rem;}
.submit-btn {background: var(--primary); color: #fff; padding: 0.5rem 1rem; border-radius: 0.35rem;}

.action-btns {
    display: flex;
    gap: 0.5rem;
}
.action-btn {
    background: none;
    border: none;
    font-size: 1rem;
    padding: 0.25rem;
    cursor: pointer;
}
.action-btn.edit {
    color: var(--primary);
}
.action-btn.delete {
    color: var(--danger);
}


.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-menu-wrapper {
    position: fixed;
    display: none;
    min-width: 280px;
    z-index: 1000;
    background: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.dropdown.active .dropdown-menu-wrapper {
    display: block;
}

.dropdown-notification-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: var(--dark);
    text-decoration: none;
    transition: background-color 0.2s;
}

.dropdown-notification-item:hover {
    background-color: rgba(0,0,0,0.05);
}

.dropdown-notification-item-icon {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 0.75rem;
    flex-shrink: 0;
}

.dropdown-notification-item-title {
    margin-bottom: 0.25rem;
    font-size: 0.875rem;
    font-weight: 500;
}

.dropdown-notification-item-time {
    font-size: 0.75rem;
    color: var(--gray);
}

.content{
    padding-left: 30px;
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
        <i class="ri-notification-3-line"></i>
        <span class="topbar-right-item-total">{{ $notifications->count() }}</span>
    </button>
                    
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
                                        <span class="dropdown-menu-item-link-text">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
         <h1>Leave Manage (Employee)</h1>

         
        @if(session('success'))
            <div style="color:green; margin-bottom:1rem;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div style="color:red; margin-bottom:1rem;">{{ session('error') }}</div>
        @endif


    <div class="card-row">
            <div class="card">
                <div class="card-icon icon-balance">{{ $total }}</div>
                <div>
                    <h2>{{ $total }}</h2>
                    <p>Total Leave Balance</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon icon-annual">{{ $approved }}</div>
                <div>
                    <h2>{{ $approved }}</h2>
                    <p>Approved Leaves</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon icon-medical">{{ $pending }}</div>
                <div>
                    <h2>{{ $pending }}</h2>
                    <p>Pending Leaves</p>
                </div>
            </div>
            <div class="card">
                <div class="card-icon icon-remaining">{{ $declined }}</div>
                <div>
                    <h2>{{ $declined }}</h2>
                    <p>Declined Leaves</p>
                </div>
            </div>
        </div>

  <!-- Table -->
  <div class="table-container">
            <div class="table-controls">
                <h2 style="font-size:1rem;">Leave</h2>
                <button class="add-btn" id="openModal">+ Add Leave</button>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Leave Type</th>
                        <th>Reason</th>
                        <th>No Of Days</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Approved By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
               <tbody>
    @foreach($leaves as $index => $leave)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $leave->leave_type }}</td>
        <td>{{ $leave->reason }}</td>
        <td>{{ $leave->number_of_day }}</td>
        <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('d M, Y') }}</td>
        <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('d M, Y') }}</td>
        <td>{{ $leave->admin ? $leave->admin->name : '-' }}</td>
        <td>
            @php
                $statusClass = '';
                switch ($leave->status) {
                    case 'Approved': $statusClass = 'status approved'; break;
                    case 'Pending': $statusClass = 'status pending'; break;
                    case 'Declined': $statusClass = 'status declined'; break;
                }
            @endphp
            <span class="{{ $statusClass }}">{{ $leave->status }}</span>
        </td>
       <td>
    @if(strtolower($leave->status) == 'pending')
        <div class="action-btns">
            <button class="action-btn edit-leave" 
        data-id="{{ $leave->id }}" 
        data-leave="{{ json_encode($leave->toArray()) }}">
        <i class="ri-edit-line"></i>
            </button>
            <button class="action-btn delete-leave" data-id="{{ $leave->id }}" style="color: var(--danger);">
                <i class="ri-delete-bin-line"></i>
            </button>
        </div>
    @else
        <span style="color: var(--gray);">No actions</span>
    @endif
</td>
    </tr>
    @endforeach
</tbody>
            </table>
        </div>

<!-- Modal for Add Leave -->
<div class="modal" id="leaveModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Add Leave (Employee)</h3>
            <button class="close-modal" id="closeModal">&times;</button>
        </div>

        <div id="form-message" style="margin:0.5rem 0; color:red;"></div>

        @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <form id="leaveForm" method="POST" action="{{ route('leaves.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="leave_type">Leave Type</label>
                    <select id="leave_type" name="leave_type" required>
                        <option value="">Select Leave Type</option>
                        <option value="Annual">Annual Leave</option>
                        <option value="Medical">Medical Leave</option>
                        <option value="Casual">Casual Leave</option>
                    </select>
                </div>
               
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="date_from">From</label>
                    <input type="date" id="date_from" name="date_from" required>
                </div>
                <div class="form-group">
                    <label for="date_to">To</label>
                    <input type="date" id="date_to" name="date_to" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="number_of_day">Number of Days</label>
                    <input type="number" id="number_of_day" name="number_of_day" min="1" value="1" required>
                </div>
                <div class="form-group">
                    <label for="leave_day">Leave Day</label>
                    <select name="leave_day" id="leave_day" class="form-control">
    <option value="">Select leave day</option>
    <option value="full" {{ old('leave_day') == 'full' ? 'selected' : '' }}>Full Day</option>
    <option value="half" {{ old('leave_day') == 'half' ? 'selected' : '' }}>Half Day</option>
</select>

                </div>
            </div>

            <div class="form-group" style="margin-bottom:1rem;">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" placeholder="Enter reason..." required></textarea>
            </div>

            <div class="modal-actions">
                <button type="reset" class="reset-btn">Reset</button>
                <button type="submit" class="submit-btn">Apply Leave</button>
            </div>
        </form>
    </div>
</div>

        <!-- End Modal -->


        </div>
        <!-- end: Main -->

        <script src="https://cdn.jsdelivr.net/npm/@floating-ui/core@1.6.8"></script>
        <script src="https://cdn.jsdelivr.net/npm/@floating-ui/dom@1.6.12"></script>
        <script src="{{ asset('js/empdash.js') }}"></script>

        
 
<script>
document.addEventListener("DOMContentLoaded", function () {
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closeModal");
    const modal = document.getElementById("leaveModal");

    openModalBtn.addEventListener("click", () => {
        modal.classList.add("active");
    });

    closeModalBtn.addEventListener("click", () => {
        modal.classList.remove("active");
    });

    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("active");
        }
    });

    @if($errors->any())
        modal.classList.add("active");
    @endif

    // Single submit handler
    const form = document.getElementById('leaveForm');
    const messageBox = document.getElementById('form-message');
    let submitting = false;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (submitting) return; // prevent multiple submissions
        submitting = true;

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(({status, body}) => {
            submitting = false;

            if (status === 200) {
                messageBox.style.color = 'green';
                messageBox.textContent = body.success || 'Leave saved successfully';

                setTimeout(() => {
                    form.reset();
                    messageBox.textContent = '';
                    modal.classList.remove('active');
                    location.reload(); // Refresh to update list
                }, 1500);
            } else {
                messageBox.style.color = 'red';
                if (body.errors) {
                    messageBox.textContent = Object.values(body.errors).flat().join(' ');
                } else if (body.error) {
                    messageBox.textContent = body.error;
                } else {
                    messageBox.textContent = 'An error occurred.';
                }
            }
        })
        .catch(() => {
            submitting = false;
            messageBox.style.color = 'red';
            messageBox.textContent = 'Network error. Please try again.';
        });
    });

    // Edit Leave
    document.querySelectorAll('.edit-leave').forEach(button => {
        button.addEventListener('click', function() {
            const leave = JSON.parse(this.getAttribute('data-leave'));

            document.querySelector('.modal-header h3').textContent = 'Edit Leave';
            form.action = `/leaves/${leave.id}`;

            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                form.appendChild(methodInput);
            }
            methodInput.value = 'PUT';

            document.getElementById('leave_type').value = leave.leave_type;
            document.getElementById('date_from').value = leave.date_from.split(' ')[0];
            document.getElementById('date_to').value = leave.date_to.split(' ')[0];
            document.getElementById('number_of_day').value = leave.number_of_day;
            document.getElementById('leave_day').value = leave.leave_day || 'full';
            document.getElementById('reason').value = leave.reason;

            modal.classList.add('active');
        });
    });

    // Reset modal on close
    closeModalBtn.addEventListener('click', function () {
        form.action = "{{ route('leaves.store') }}";
        const methodInput = form.querySelector('input[name="_method"]');
        if (methodInput) {
            form.removeChild(methodInput);
        }
        form.reset();
        messageBox.textContent = '';
        document.querySelector('.modal-header h3').textContent = 'Add Leave (Employee)';
    });

    // Delete Leave
    document.querySelectorAll('.delete-leave').forEach(button => {
        button.addEventListener('click', function() {
            const leaveId = this.getAttribute('data-id');
            if (!confirm('Are you sure you want to delete this leave request?')) return;

            fetch(`/leaves/${leaveId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('Leave deleted successfully');
                    location.reload();
                } else {
                    throw new Error(data.message || 'Delete failed');
                }
            })
            .catch(err => {
                alert(err.message || 'Error deleting leave');
            });
        });
    });
});

// Reset form when modal is closed
document.getElementById('closeModal').addEventListener('click', function() {
    const form = document.getElementById('leaveForm');
    form.action = "{{ route('leaves.store') }}";
    const methodInput = form.querySelector('input[name="_method"]');
    if (methodInput) {
        form.removeChild(methodInput);
    }
    document.querySelector('.modal-header h3').textContent = 'Add Leave (Employee)';
});


</script>
@endsection