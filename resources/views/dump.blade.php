<a class="big-button">Audit Trails</a>
<a href="#" class="big-button">Order Management</a>
{{-- add user button --}}
<a href="{{ route('admin.users.index') }}" class="big-button">User Management</a>
{{-- edit profile --}}
<a href="{{ route('admin.update.profile') }}" class="big-button">Edit Profile</a>
{{-- change password --}}
<a href="{{ route('admin.change.password') }}" class="big-button">Change Password</a>

{{-- success message in center --}}
@if (session('success'))
    <p class="text-green text-center">{{ session('success') }}</p>
@endif


width: 100%;
             max-width: 1440px;
