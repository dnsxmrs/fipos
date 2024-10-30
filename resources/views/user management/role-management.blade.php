<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta and Title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management Settings</title>

    <!-- Fonts and Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
        }
        body, html {
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
            margin-left: 0; /* Adjust margin-left since sidebar is removed */
        }
        .content .left-panel {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-right: 20px;
        }
        /* Highlight Role Management section */
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
        .button-add-role {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
        .role-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .role-table th, .role-table td {
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }
        .role-table th {
            font-weight: 600;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }
        .icon-edit, .icon-delete {
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
        /* Additional Styles for Role Management */
        .permission-list {
            list-style: none;
            padding: 0;
        }
        .permission-item {
            margin-bottom: 10px;
        }
        .role-form {
            margin-top: 20px;
        }
        .role-form input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
        }
        .role-form button {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }
    </style>
    <script>
        // JavaScript functions for adding/editing roles
        function addRole() {
            // Implement the logic to add a new role
            alert('Add Role functionality not implemented in this static example.');
        }

        function editRole(roleName) {
            // Implement the logic to edit an existing role
            alert('Edit Role functionality not implemented in this static example.');
        }
    </script>
</head>
<body>

<div class="main-frame">
    <!-- Main Content -->
    <div class="content">
        <!-- Left Panel -->
        <div class="left-panel">
            <!-- Highlight Role Management section -->
            <div class="highlight">
                <h2>Role Management</h2>
                <p>Manage roles and permissions</p>
            </div>
            <!-- Other sections -->
            <h2><a href="user_management.html" style="text-decoration: none; color: #333;">User Management</a></h2>
            <p>Roles and Permissions, User Accounts</p>
            <h2>Security</h2>
            <p>Configure Password, PIN, etc</p>
            
        </div>

        <!-- Right Panel -->
        <div class="right-panel">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h2>Roles</h2>
                <button class="button-add-role" onclick="addRole()">+ Add Role</button>
            </div>

            <!-- Role Table -->
            <table class="role-table">
                <thead>
                    <tr>
                        <th>Role Name</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Example Role -->
                    <tr>
                        <td>Admin</td>
                        <td>All Permissions</td>
                        <td>
                            <span class="icon-edit" title="Edit Role" onclick="editRole('Admin')"></span>
                            <span class="icon-delete" title="Delete Role"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>Cashier</td>
                        <td>View Orders, Manage Transactions</td>
                        <td>
                            <span class="icon-edit" title="Edit Role" onclick="editRole('Cashier')"></span>
                            <span class="icon-delete" title="Delete Role"></span>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Role Form (for adding/editing roles) -->
            <div class="role-form">
                <h3>Add/Edit Role</h3>
                <input type="text" placeholder="Role Name">
                <h4>Permissions:</h4>
                <ul class="permission-list">
                    <li class="permission-item">
                        <input type="checkbox" id="perm1">
                        <label for="perm1">View Orders</label>
                    </li>
                    <li class="permission-item">
                        <input type="checkbox" id="perm2">
                        <label for="perm2">Edit Menu</label>
                    </li>
                    <li class="permission-item">
                        <input type="checkbox" id="perm3">
                        <label for="perm3">Access Reports</label>
                    </li>
                    <li class="permission-item">
                        <input type="checkbox" id="perm4">
                        <label for="perm4">Manage Users</label>
                    </li>
                    <!-- Add more permissions as needed -->
                </ul>
                <button onclick="addRole()">Save Role</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
