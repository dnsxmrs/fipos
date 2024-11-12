<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta and Title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management Settings</title>

    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
        }

        body,
        html {
            margin: 0;
            padding: 0;
            background-color: #f3f3f3;
            height: 100%;
        }

        .main-frame {
            display: flex;
            height: 100vh;
            width: 1440px;
            margin: auto;
            background-color: #f3f3f3;
        }

        .content {
            flex-grow: 1;
            display: flex;
            padding: 40px;
            margin-left: 20px;
            /* Adjusted margin for centering */
        }

        .content .left-panel {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-right: 20px;
        }

        /* Highlight User Management section */
        .highlight {
            background-color: #F7D9BF;
            padding: 10px;
            border-radius: 8px;
            color: #5a341a;
            margin-bottom: 20px;
        }

        .content .left-panel h2 {
            font-weight: 600;
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .content .left-panel p {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }

        .content .right-panel {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .user-table th {
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .status-active {
            color: #00C29A;
            font-weight: 600;
        }

        .button-add-user {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
        }

        .icon-edit,
        .icon-delete {
            width: 16px;
            height: 16px;
            display: inline-block;
            cursor: pointer;
        }

        .icon-edit {
            background: url('https://cdn-icons-png.flaticon.com/512/1159/1159633.png') no-repeat center;
            background-size: contain;
            margin-right: 8px;
        }

        .icon-delete {
            background: url('https://cdn-icons-png.flaticon.com/512/1214/1214428.png') no-repeat center;
            background-size: contain;
        }

        .user-table select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #e0e0e0;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <div class="main-frame">
        <!-- Main Content -->
        <div class="content">
            <!-- Left Panel -->
            <div class="left-panel">
                <div class="highlight">
                    <h2>User Management</h2>
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
                <a href="{{ route('admin.dashboard') }}">Back to Dashboard</a>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <h2>User Management</h2>
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
</body>

</html>
