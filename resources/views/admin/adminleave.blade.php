@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/admincss/dash.css') }}">

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

html {
    overflow-x: hidden;
}

body.dark {
    --light: #0C0C1E;
    --grey: #060714;
    --dark: #FBFBFB;
}

body {
    background: var(--grey);
    overflow-x: hidden;
}

* {box-sizing: border-box; margin: 0; padding: 0;}

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
.add-btn {background: var(--primary); color: #fff; padding: 0.5rem 1rem; border-radius: 0.4rem; font-weight: 500;}

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


.status.approved {background: rgba(58,196,125,0.15); color: var(--success);} 
.status.pending {background: rgba(247,185,36,0.15); color: var(--warning);} 
.status.declined {background: rgba(217,37,80,0.15); color: var(--danger);}

.action-btns {
    display: flex;
    gap: 0.5rem;
}
.btn-approve {
    background: var(--success);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}
.btn-reject {
    background: var(--danger);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
}
</style>


<section id="content">
 <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu' ></i>
        <a href="#" class="nav-link">Categories</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell' ></i>
            <span class="num">8</span>
        </a>
          <a href="#" class="profile">
           <img src="{{ asset('images/people.png') }}" alt="Profile">
        </a>
    </nav>





   
  
    

 <!-- MAIN -->
    <main>
         <h1>Leave Requests Management</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Employee</th>
                    <th>Leave Type</th>
                    <th>Reason</th>
                    <th>Days</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $index => $leave)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $leave->employee->name }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ $leave->number_of_day }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->date_from)->format('d M, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($leave->date_to)->format('d M, Y') }}</td>
                    <td>
                        @php
                            $statusClass = '';
                            switch (strtolower($leave->status)) {
                                case 'approved': $statusClass = 'status approved'; break;
                                case 'pending': $statusClass = 'status pending'; break;
                                case 'rejected': $statusClass = 'status declined'; break;
                            }
                        @endphp
                        <span class="{{ $statusClass }}">{{ ucfirst($leave->status) }}</span>
                    </td>
                    <td>
                        @if(strtolower($leave->status) == 'pending')
                            <div class="action-btns">
                                <button class="btn-approve approve-leave" data-id="{{ $leave->id }}">Approve</button>
                                <button class="btn-reject reject-leave" data-id="{{ $leave->id }}">Reject</button>
                            </div>
                        @else
                            <span style="color: var(--gray);">No actions</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($leaves->isEmpty())
                    <tr><td colspan="9" style="text-align:center;">No leave requests found.</td></tr>
                @endif
            </tbody>
        </table>
    </div>
    </main>
    <!-- MAIN -->
    

</section>
<script src="{{ asset('js/dash.js') }}"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Approve leave
    document.querySelectorAll('.approve-leave').forEach(button => {
        button.addEventListener('click', function() {
            updateLeaveStatus(this.getAttribute('data-id'), 'approved');
        });
    });

    // Reject leave
    document.querySelectorAll('.reject-leave').forEach(button => {
        button.addEventListener('click', function() {
            updateLeaveStatus(this.getAttribute('data-id'), 'rejected');
        });
    });

    function updateLeaveStatus(leaveId, status) {
        if (!confirm(`Are you sure you want to ${status} this leave request?`)) return;

        fetch(`/admin/leaves/${leaveId}/status`, {
            method: 'PUT',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => { throw err; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert(`Leave request ${status} successfully`);
                location.reload();
            } else {
                throw new Error(data.message || `Failed to ${status} leave`);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'Error processing request');
        });
    }
});

</script>
@endsection




