<!-- resources/views/admins/admin-layouts/partials/sidebar.blade.php -->

<nav id="sidebar" class="bg-dark border-right p-3 text-white">
    <div class="sidebar-header text-center">
        <h3>ShiftSync</h3>
    </div>
    <ul class="list-unstyled components">
        <li>
            <a href="/admin/users" class="text-white">Users</a>
        </li>
        <li>
            <a href="/admin/departments" class="text-white">Departments</a>
        </li>
        <li>
            <a href="/admin/roles" class="text-white">Roles</a>
        </li>
        <li>
            <a href="/admin/addresses" class="text-white">Address</a>
        </li>
        <li>
            <a href="/admin/emergency-contacts" class="text-white">Emergency Contacts</a>
        </li>
        <li>
            <a href="/admin/shift-schedules" class="text-white">Shift Schedules</a>
        </li>
        <li>
            <a href="/admin/employee-records" class="text-white">Employee Records</a>
        </li>
        <li>
            <a href="/admin/employee-assigned-shifts" class="text-white">Employee Assigned Shifts</a>
        </li>
        <li>
            <a href="/admin/employee-shift-records" class="text-white">Employee Shift Records</a>
        </li>
        <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-white">Settings</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#" class="text-white">Profile</a>
                </li>
                <li>
                    <a href="#" class="text-white">Security</a>
                </li>
                <li>
                    <a href="#" class="text-white">Notifications</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="text-white">Support</a>
        </li>
    </ul>
</nav>

<!-- Include Bootstrap JS (necessary for dropdowns and collapse) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>