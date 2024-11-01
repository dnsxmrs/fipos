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
            margin-left: 0;
            /* Adjust margin-left since sidebar is removed */
        }

        .content .left-panel {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-right: 20px;
        }

        .highlight {
            background-color: #F7D9BF;
            padding: 10px;
            border-radius: 8px;
            color: #5a341a;
            margin-bottom: 20px;
        }

        .content .right-panel {
            flex-grow: 1;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        .button-add-user {
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            width: 400px;
            height: 200px;
        }

        .modal-content h3 {
            margin: 0;
            color: #333;
            justify-content: center;
            align-items: center;
        }

        .close-button {
            margin-top: 15px;
            background-color: #5a341a;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <script>
        function showConfirmationModal() {
            document.getElementById("confirmation-modal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("confirmation-modal").style.display = "none";
        }

        function handleFormSubmission(event) {
            event.preventDefault(); // Prevent actual form submission
            showConfirmationModal(); // Show confirmation modal
        }
    </script>
</head>

<body>
    <div class="main-frame">
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
                <h3><a href="{{ route('admin.update.profile') }}" style="text-decoration: none; color: #333;">Edit
                        Profile</a></h3>
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
    </div>

</body>

</html>
