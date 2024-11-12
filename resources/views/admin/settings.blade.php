<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('content')
    <!-- Main Content -->
    <div class="content">
        <!-- Left Panel -->
        <div class="left-panel">
            <div class="highlight">
                <h3>User Management</h3>
                <p>Roles and Permissions, User Accounts</p>
            </div>
            <h3>Security</h3>
            <p>Configure Password, PIN, etc</p>
            <!-- Added Role Management Link -->
            <h3><a href="{{ route('admin.role-management') }}" style="text-decoration: none; color: #333;">Role
                    Management</a></h3>
            <p>Manage roles and permissions</p>

            <!-- New Edit Profile Option -->
            <h3><a href="{{ route('admin.update.profile') }}" style="text-decoration: none; color: #333;">Edit Profile</a>
            </h3>
            <p>Update personal details</p>
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <a href="{{ route('admin.reports') }}">Back to Dashboard</a>
            <h3>Edit Profile</h3>
            <form action="{{ route('admin.update.profile') }}" method="POST"
                style="display: flex; flex-direction: column; gap: 15px;">
                @csrf

                <!-- Name Field -->
                <label for="first_name">First Name <span style="color: red;">*</span></label>
                <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}"
                    style="padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;"
                    @error('first_name') style="border: 1px solid red;" @enderror>
                @error('first_name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <label for="last_name">Last Name <span style="color: red;">*</span></label>
                <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}"
                    style="padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;"
                    @error('last_name') style="border: 1px solid red;" @enderror>
                @error('last_name')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                <!-- Email Field -->
                <label for="email">Email <span style="color: red;">*</span></label>
                <input type="text" id="email" name="email" value="{{ Auth::user()->email }}"
                    style="padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;"
                    @error('email') style="border: 1px solid red;" @enderror>
                @error('email')
                    <span style="color: red;">{{ $message }}</span>
                @enderror

                {{-- comment
            <!-- Phone Field -->
            <label for="phone">Phone Number <span style="color: red;">*</span></label>
            <input type="tel" id="phone" name="phone" value="123-456-7890" style="padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;" required>

            <!-- Address Field -->
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="1234 Coffee Street, Brewtown" style="padding: 10px; border: 1px solid #e0e0e0; border-radius: 5px;">
--}}
                <!-- Save Button -->
                <button type="submit" class="button-add-user" style="width: fit-content;">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
