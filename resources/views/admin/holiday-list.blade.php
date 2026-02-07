@extends('layouts.app')

@section('content')

@include('admin.sidebar')

<link rel="stylesheet" href="{{ asset('css/admincss/dash.css') }}">
<style>
* {
  box-sizing: border-box;
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

h2 {
  margin-bottom: 20px;
}
.add-btn {
  background-color: #8635FD;
  color: white;
  padding: 10px 16px;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  float: right;
  margin-bottom: 10px;
}
table {
  width: 100%;
  border-collapse: collapse;
  min-width: 700px;
  background-color: white;
}
th, td {
  text-align: left;
  padding: 12px;
  border-bottom: 1px solid #eee;
}
th {
  background-color: #f0f2f5;
  color: #333;
}
tr:nth-child(even) {
  background-color: #f9f9f9;
}
.action-btn {
  border: none;
  background: #e9eef5;
  border-radius: 6px;
  padding: 6px;
  margin-right: 5px;
  cursor: pointer;
}
.action-btn:hover {
  background: #dbe7f3;
}
.icon {
  width: 16px;
  height: 16px;
  vertical-align: middle;
}

/* Modal styles */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 50%;
  border-radius: 8px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.modal-header h2 {
  margin: 0;
}

.close {
  color: #aaa;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
}

.close:hover {
  color: black;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input, .form-group select {
  width: 100%;
  padding: 8px;
  border: 1px solid #ddd;
  border-radius: 4px;
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  margin-top: 20px;
}

.modal-footer button {
  padding: 8px 16px;
  border-radius: 4px;
  cursor: pointer;
  margin-left: 10px;
}

.cancel-btn {
  background-color: #f0f0f0;
  border: 1px solid #ddd;
}

.add-holiday-btn {
  background-color: #8635FD;
  color: white;
  border: none;
}

@media (max-width: 768px) {
  .add-btn {
    width: 100%;
    float: none;
    margin-bottom: 20px;
  }
  table {
    font-size: 14px;
  }
  .modal-content {
    width: 90%;
  }
}
</style>
<!-- CONTENT -->
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

    <!-- MAIN -->
    <main>
        <button class="add-btn" onclick="openAddHolidayModal()">+ Add Holiday</button>
        <table id="holidayTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Day</th>
                    <th>Date</th>
                    <th>Holiday Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($holidays as $index => $holiday)
           <tr data-id="{{ $holiday->id }}">
    <td>{{ $index + 1 }}</td>
    <td>{{ \Carbon\Carbon::parse($holiday->date)->format('l') }}</td>
    <td data-full-date="{{ $holiday->date }}">
    {{ \Carbon\Carbon::parse($holiday->date)->format('d M') }}
    </td>
    <td>{{ $holiday->name }}</td>
    <td>{{ $holiday->type }}</td>
    <td>
        <button class="action-btn edit-btn">
            <img src="https://img.icons8.com/ios-filled/50/000000/edit--v1.png" class="icon"/>
        </button>
        <button class="action-btn delete-btn">
            <img src="https://img.icons8.com/ios-filled/50/000000/delete-sign.png" class="icon"/>
        </button>
    </td>
</tr>
@endforeach

                <!-- More rows can be added -->
            </tbody>
        </table>
    </main>
    <!-- MAIN -->
</section>
<!-- CONTENT -->

<!-- Add Holiday Modal -->
<div id="addHolidayModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle">Add Holiday</h2>
            <span class="close" onclick="closeAddHolidayModal()">&times;</span>
        </div>
        <form id="holidayForm">
            <div class="form-group">
                <label for="holidayType">Type</label>
                <select id="holidayType" name="type" required>
                    <option value="">Select type</option>
                    <option value="Restricted Holiday">Restricted Holiday</option>
                    <option value="Gazetted Holiday">Gazetted Holiday</option>
                </select>
            </div>
            <div class="form-group">
                <label for="holidayName">Holiday Name</label>
                <input type="text" id="holidayName" name="name" placeholder="Holiday name" required>
            </div>
            <div class="form-group">
                <label for="holidayDate">Date</label>
                <input type="date" id="holidayDate" name="date" required>
            </div>
            <div class="modal-footer">
                <button type="button" class="cancel-btn" onclick="closeAddHolidayModal()">Cancel</button>
                <button type="submit" class="add-holiday-btn" id="submitHolidayBtn">Add Holiday</button>
            </div>
        </form>
    </div>
</div>


<script src="{{ asset('js/dash.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const csrfToken = '{{ csrf_token() }}';

    const holidayForm = document.getElementById('holidayForm');
    const modal = document.getElementById('addHolidayModal');
    const modalTitle = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitHolidayBtn');

    let editingHolidayId = null;

    function openModal(title = 'Add Holiday') {
        modalTitle.textContent = title;
        modal.style.display = 'block';
    }

    function closeModal() {
        modal.style.display = 'none';
        holidayForm.reset();
        editingHolidayId = null;
        submitBtn.textContent = 'Add Holiday';
    }

    window.openAddHolidayModal = function () {
        editingHolidayId = null;
        submitBtn.textContent = 'Add Holiday';
        openModal('Add Holiday');
    };

    window.closeAddHolidayModal = closeModal;

    // Fill modal when editing
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            editingHolidayId = row.dataset.id;

            const name = row.children[3].textContent.trim();
            const type = row.children[4].textContent.trim();
            const date = row.children[2].getAttribute('data-full-date');

            document.getElementById('holidayName').value = name;
            document.getElementById('holidayType').value = type;
            document.getElementById('holidayDate').value = date;

            submitBtn.textContent = 'Update Holiday';
            openModal('Edit Holiday');
        });
    });

    // Delete
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const row = this.closest('tr');
            const id = row.dataset.id;

            if (confirm("Are you sure you want to delete this holiday?")) {
                fetch(`/admin/holiday-list/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) row.remove();
                    else alert('Failed to delete.');
                });
            }
        });
    });

    // Add or Edit Holiday Submit
    holidayForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const type = document.getElementById('holidayType').value;
        const name = document.getElementById('holidayName').value;
        const date = document.getElementById('holidayDate').value;

        const method = editingHolidayId ? 'PUT' : 'POST';
        const url = editingHolidayId
            ? `/admin/holiday-list/${editingHolidayId}`
            : '/admin/holiday-list';

        fetch(url, {
            method,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, type, date })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    const message = err?.errors
                        ? Object.values(err.errors).flat().join('\n')
                        : (err?.message || 'An unknown error occurred');
                    throw new Error(message);
                }).catch(() => {
                    throw new Error('Server error or invalid response');
                });
            }
            return response.json();
        })
        .then(data => {
            location.reload(); // Refresh table
        })
        .catch(error => {
            alert("Error submitting holiday:\n" + error.message);
        });
    });
});
</script>


@endsection