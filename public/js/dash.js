const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});


// SIDEBAR TOGGLE
const allsideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

// Handle sidebar menu item active state
allSideMenu.forEach(item => {
  const li = item.parentElement;

  item.addEventListener('click', function () {
    allsideMenu.forEach(i => {
      i.parentElement.classList.remove('active');
    });
    li.classList.add('active');
  });
});

// TOGGLE SIDEBAR
menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide');
  adjustContainerWidth();
});

// ADJUST CONTAINER WIDTH
function adjustContainerWidth() {
  const container = document.querySelector('.container');
  if (!container) return;
  
  if (sidebar.classList.contains('hide')) {
    container.style.width = 'calc(100% - 60px)';
    container.style.marginLeft = '0'; // Reset margin, let the content section handle it
  } else {
    container.style.width = 'calc(100% - 280px)';
    container.style.marginLeft = '0'; // Reset margin, let the content section handle it
  }
}

// Call once on initial load
window.addEventListener('DOMContentLoaded', function() {
  adjustContainerWidth();
});

// SEARCH FORM
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

if (searchButton && searchButtonIcon && searchForm) {
  searchButton.addEventListener('click', function (e) {
    if(window.innerWidth < 576) {
      e.preventDefault();
      searchForm.classList.toggle('show');
      if(searchForm.classList.contains('show')) {
        searchButtonIcon.classList.replace('bx-search', 'bx-x');
      } else {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
      }
    }
  });
}

// RESPONSIVE LAYOUTS
function handleWindowResize() {
  if(window.innerWidth < 768) {
    sidebar.classList.add('hide');
  } else if (window.innerWidth >= 768 && window.innerWidth < 1366) {
    sidebar.classList.remove('hide');
  }
  
  if(window.innerWidth > 576) {
    if (searchButtonIcon && searchForm) {
      searchButtonIcon.classList.replace('bx-x', 'bx-search');
      searchForm.classList.remove('show');
    }
  }
  
  adjustContainerWidth();
}

// Run on resize
window.addEventListener('resize', handleWindowResize);
// Run once on page load
handleWindowResize();

// DARK MODE TOGGLE
const switchMode = document.getElementById('switch-mode');
if (switchMode) {
  switchMode.addEventListener('change', function () {
    if(this.checked) {
      document.body.classList.add('dark');
    } else {
      document.body.classList.remove('dark');
    }
  });
}

// Initialize modal functionality if needed
if (typeof window.openModal !== 'function') {
  window.openModal = function() {
    const modal = document.getElementById('employeeModal');
    if (modal) {
      document.getElementById("employeeForm").reset();
      document.getElementById("employee_id").value = "";
      document.getElementById("modalTitle").innerText = "Add Employee";
      modal.style.display = "block";
    }
  };
  
  window.closeModal = function() {
    const modal = document.getElementById('employeeModal');
    if (modal) {
      modal.style.display = "none";
    }
  };
}









/*Notification dropdown functionality
    let dropdownCleanup;
    
    document.querySelectorAll('[data-toggle="dropdown"]').forEach(function (item) {
        item.addEventListener("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            
            const dropdown = item.closest(".dropdown");
            if (dropdown) {
                const dropdownMenu = dropdown.querySelector(".dropdown-menu-wrapper");
                if (dropdownMenu) {
                    dropdownCleanup && dropdownCleanup();
                    
                    if (dropdown.classList.contains("active")) {
                        dropdown.classList.remove("active");
                    } else {
                        document.querySelectorAll(".dropdown").forEach(function (el) {
                            if (el !== dropdown) {
                                el.classList.remove("active");
                            }
                        });
                        
                        dropdownCleanup = window.FloatingUIDOM.autoUpdate(
                            item, 
                            dropdownMenu, 
                            () => updateDropdownPosition(item, dropdownMenu)
                        );
                        
                        dropdown.classList.add("active");
                    }
                }
            }
        });
    });

    document.addEventListener("click", function (e) {
        if (!e.target.closest(".dropdown")) {
            document.querySelectorAll(".dropdown").forEach(function (el) {
                el.classList.remove("active");
            });
            dropdownCleanup && dropdownCleanup();
        }
    });

    function updateDropdownPosition(referenceEl, floatingEl) {
        window.FloatingUIDOM.computePosition(referenceEl, floatingEl, {
            placement: "bottom-end",
            strategy: "fixed",
            middleware: [
                window.FloatingUIDOM.shift({ padding: 16 }),
                window.FloatingUIDOM.offset(8)
            ]
        }).then(({ x, y }) => {
            Object.assign(floatingEl.style, {
                left: `${x}px`,
                top: `${y}px`,
            });
        });
    }

    // Mark notification as read when clicked
    document.querySelectorAll('.dropdown-notification-item').forEach(item => {
        item.addEventListener('click', function(e) {
            const notificationId = this.dataset.id;
            if (notificationId) {
                fetch(`/notifications/${notificationId}/mark-as-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    if (response.ok) {
                        this.style.opacity = '0.7';
                    }
                });
            }
        });
    });

    // Real-time notifications with Echo
    if (typeof Echo !== 'undefined' && typeof userId !== 'undefined') {
        Echo.private(`App.Models.User.${userId}`)
            .notification((notification) => {
                const countElement = document.querySelector('.topbar-right-item-total');
                const currentCount = parseInt(countElement.textContent) || 0;
                countElement.textContent = currentCount + 1;
                
                const notificationWrapper = document.querySelector('.dropdown-notification-wrapper');
                const newNotification = `
                    <a href="${notification.url}" class="dropdown-notification-item">
                        <span class="dropdown-notification-item-icon ${notification.status === 'approved' ? 'success-soft' : 'danger-soft'}">
                            <i class="ri-calendar-line"></i>
                        </span>
                        <p class="dropdown-notification-item-title">${notification.message}</p>
                        <p class="dropdown-notification-item-time">Just now</p>
                    </a>
                `;
                notificationWrapper.insertAdjacentHTML('afterbegin', newNotification);
            });
    }  */