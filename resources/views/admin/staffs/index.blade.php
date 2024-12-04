<!-- resources/views/admin/reports.blade.php -->
@extends('layouts.admin-layout')

@section('admin_content')
    <div class="main-frame">
        <!-- Main Content -->
        <div class="content-staff">
            <!-- Left Panel -->
            <div class="left-panel">
                <div class="highlight">
                    <h2>Staff Management</h2>
                    <p>Roles and Permissions, User Accounts</p>
                </div>
                <h2>Security</h2>
                <p>Configure Password, PIN, etc</p>
                <!-- Added Role Management Link -->
                <h2><a href="" style="text-decoration: none; color: #333;">Role Management</a></h2>
                <p>Manage roles and permissions</p>

                <!-- New Edit Profile Option -->
                <h2><a href="" style="text-decoration: none; color: #333;">Edit Profile</a></h2>
                <p>Update personal details</p>
            </div>

            <!-- Right Panel -->
            <div class="right-panel">
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h1>Staff Management</h1>
                    <a href="{{ route('admin.add.user') }}" class="button-add-user">+ Add User</a>
                </div>

                <!-- User Table -->
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ ucfirst($user->first_name) . ' ' . ucfirst($user->last_name) }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ ucfirst($user->role) }}</td>
                                <td>
                                    <span class="icon-edit" title="Edit User"></span>
                                    <span class="icon-delete" title="Delete User"></span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
