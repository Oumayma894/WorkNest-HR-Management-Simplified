@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/dash.css') }}">

<style>  

.container {
  position: relative;
  background-color: var(--light);
  border-radius: 0 10px 10px 0;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  padding: 20px;
  box-sizing: border-box;
  width: 100%;
  margin: 0;
  margin-left: -10px; 
  border-left: none;
  transition: all .3s ease;
  min-width: 900px; 
}

.table-responsive {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
  margin-bottom: 20px;
  border-radius: 8px;
  background: var(--light);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

table {
  width: auto; 
  min-width: 100%; 
  border-collapse: collapse;
  font-family: var(--lato);
  white-space: normal; 
}

th:nth-child(1), td:nth-child(1) { width: 120px; } 
th:nth-child(2), td:nth-child(2) { width: 150px; } 
th:nth-child(3), td:nth-child(3) { width: 150px; } 
th:nth-child(4), td:nth-child(4) { width: 200px; } 
th:nth-child(5), td:nth-child(5) { width: 120px; } 
th:nth-child(6), td:nth-child(6) { width: 150px; } 
th:nth-child(7), td:nth-child(7) { width: 120px; } 
th:nth-child(8), td:nth-child(8) { width: 150px; } 
th:nth-child(9), td:nth-child(9) { width: 180px; } 

th, td {
  padding: 12px 15px;
  border-bottom: 1px solid var(--grey);
  text-align: left;
  color: var(--dark);
  white-space: normal; 
  word-wrap: break-word; 
}

th {
  background-color: var(--grey);
  color: var(--dark);
  font-weight: 600;
  position: sticky;
  top: 0;
  z-index: 10;
}

tbody tr:hover {
  background-color: rgba(60, 145, 230, 0.05);
}

.action-btn {
  padding: 6px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: 500;
  font-size: 13px;
  transition: all 0.2s ease;
  white-space: nowrap; 
  margin-right: 5px;
  margin-bottom: 5px;
  display: inline-block;
}

@media screen and (max-width: 1200px) {
  #content, #sidebar.hide ~ #content {
    min-width: 1000px; 
  }
  
  .container {
    min-width: 1000px;
  }
}

@media screen and (max-width: 992px) {
  body {
    overflow-x: auto;
  }
  
  .table-responsive {
    overflow-x: visible;
  }
  
  table {
    width: 100%;
  }
}

@media screen and (max-width: 768px) {
  .table-responsive {
    overflow-x: auto;
  }
  
  td:nth-child(9) {
    white-space: normal;
  }
  
  .action-btn {
    display: block;
    width: 100%;
    margin-bottom: 5px;
  }
}

/* Updated Pagination Wrapper Styles */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    gap: 8px;
}

/* Base styles for all pagination elements */
.pagination-wrapper a,
.pagination-wrapper span {
    padding: 8px 16px;
    border: 1px solid var(--grey);
    border-radius: 6px;
    text-decoration: none;
    background-color: white;
    color: var(--dark);
    font-family: var(--lato);
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    text-align: center;
}

/* Previous and Next text buttons */
.pagination-wrapper a:first-child,
.pagination-wrapper a:last-child {
    min-width: 100px;
    font-weight: 600;
}

/* Hide arrow icons */
.pagination-wrapper nav a[aria-label*="Previous"],
.pagination-wrapper nav span[aria-label*="Previous"],
.pagination-wrapper nav a[aria-label*="Next"],
.pagination-wrapper nav span[aria-label*="Next"] {
    display: none;
}

/* Hover effects for all links */
.pagination-wrapper a:hover {
    background-color: var(--dark-blue);
    color: white;
    border-color: var(--dark-blue);
    transform: translateY(-1px);
}

/* Active page styling */
.pagination-wrapper .active span,
.pagination-wrapper span.current {
    background-color: var(--dark-blue);
    color: white;
    border-color: var(--dark-blue);
    font-weight: 600;
}

/* Disabled state styling */
.pagination-wrapper .disabled span {
    background-color: #f0f0f0;
    color: #aaa;
    cursor: not-allowed;
    opacity: 0.6;
}

/* Number pages only */
.pagination-wrapper a:not(:first-child):not(:last-child),
.pagination-wrapper span:not(.active) {
    min-width: 40px;
}

/* Responsive adjustments */
@media screen and (max-width: 768px) {
    .pagination-wrapper {
        flex-direction: column;
        gap: 15px;
        align-items: center;
    }
    
    .pagination-wrapper nav {
        justify-content: center;
        gap: 4px;
    }
    
    .pagination-wrapper nav a,
    .pagination-wrapper nav span {
        padding: 6px 10px;
        min-width: 36px;
        font-size: 14px;
    }
    
    .pagination-wrapper > a {
        padding: 8px 16px;
        min-width: 80px;
        font-size: 14px;
    }
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
    <!-- NAVBAR -->
    
    <main>
    <div class="container">
        <div class="top-bar">
            <h2>Employee List</h2>
            <button class="add-btn" onclick="window.openModal()">+ Employee</button>
        </div>

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Experience</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="employee-table-body">
                    @foreach($employeeList as $employee)
                    <tr>
                        <td class="highlight">{{ $employee->employee_code }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->designation }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->location }}</td>
                        <td>{{ $employee->experience }}</td>
                        <td>{{ date('d M, Y', strtotime($employee->joining_date)) }}</td>
                        <td>
                            <button class="action-btn edit-btn" onclick="editEmployee({{ $employee->id }})">Edit</button>
                            <form action="{{ route('admin.employeedelete', $employee->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

       
    </div>

    <!-- Modal -->
    <div id="employeeModal" class="modal">
        <div class="modal-content">
            <h3 id="modalTitle">Add Employee</h3>
            
            <form id="employeeForm" action="{{ route('admin.employeesave') }}" method="POST">
                @csrf
                <input type="hidden" id="employee_id" name="employee_id">
                
                <div class="form-group">
                    <input type="text" id="employee_code" name="employee_code" placeholder="Employee Code" value="{{ $employeeId }}" required>
                    <span class="error" id="employee_code_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                    <span class="error" id="name_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="text" id="designation" name="designation" placeholder="Designation" required>
                    <span class="error" id="designation_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <span class="error" id="email_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    <span class="error" id="phone_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="text" id="location" name="location" placeholder="Location">
                    <span class="error" id="location_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="text" id="experience" name="experience" placeholder="Experience (e.g., '5 years')">
                    <span class="error" id="experience_error"></span>
                </div>
                
                <div class="form-group">
                    <input type="date" id="joining_date" name="joining_date" required>
                    <span class="error" id="joining_date_error"></span>
                </div>
                

                <div class="form-actions">
                    <button type="button" onclick="closeModal()">Cancel</button>
                    <button type="submit" id="saveEmployeeBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
    </main>
</section>

<script>

document.addEventListener("DOMContentLoaded", function() {
    function openModal() {
        document.getElementById("employeeForm").reset();
        document.getElementById("employee_id").value = "";
        document.getElementById("modalTitle").innerText = "Add Employee";
        document.getElementById("employeeModal").style.display = "block";
        
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
    }

    function closeModal() {
        document.getElementById("employeeModal").style.display = "none";
    }

    // Edit employee
    function editEmployee(id) {
        fetch(`/admin/employee/${id}/edit`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById("employee_id").value = data.id;
                document.getElementById("employee_code").value = data.employee_code;
                document.getElementById("name").value = data.name;
                document.getElementById("designation").value = data.designation;
                document.getElementById("email").value = data.email;
                document.getElementById("phone").value = data.phone || '';
                document.getElementById("location").value = data.location || '';
                document.getElementById("experience").value = data.experience || '';
                document.getElementById("joining_date").value = data.joining_date;
                
                document.getElementById("modalTitle").innerText = "Edit Employee";
                document.getElementById("employeeModal").style.display = "block";
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading employee data');
            });
    }


   document.getElementById('employeeForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const form = this;
    const saveBtn = document.getElementById('saveEmployeeBtn');
    const formData = new FormData(form);
    
    document.querySelectorAll('.error').forEach(el => el.textContent = '');
    
    saveBtn.disabled = true;
    const originalBtnText = saveBtn.textContent;
    saveBtn.textContent = 'Saving...';
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        const data = await response.json();
        
        if (!response.ok) {
            throw data;
        }

        if (data.success) {
            window.location.reload();
        }
    } catch (error) {
        console.error('Error:', error);
        if (error.errors) {
            // Display validation errors
            for (const [field, messages] of Object.entries(error.errors)) {
                const errorElement = document.getElementById(`${field}_error`);
                if (errorElement) {
                    errorElement.textContent = messages.join(', ');
                }
            }
            
            // Scroll to first error
            const firstError = document.querySelector('.error:not(:empty)');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            alert(error.message || 'An error occurred. Please try again.');
        }
    } finally {
        saveBtn.disabled = false;
        saveBtn.textContent = originalBtnText;
    }
});

    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 500);
        }, 3000);
    });

    window.openModal = openModal;
    window.closeModal = closeModal;
    window.editEmployee = editEmployee;
});


</script>

<script src="{{ asset('js/dash.js') }}"></script>
@endsection