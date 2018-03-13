@if (Auth::guard('web')->check())
    <p class="text-success">
        You are Logged In as <strong>User</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>User</strong>
    </p>
@endif

@if (Auth::guard('admin')->check())
    <p class="text-success">
        You are Logged In as <strong>Admin</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Admin</strong>
    </p>
@endif

@if (Auth::guard('superadmin')->check())
    <p class="text-success">
        You are Logged In as <strong>Superadmin</strong>
    </p>
@else
    <p class="text-danger">
        You are Logged Out as a <strong>Superadmin</strong>
    </p>
@endif