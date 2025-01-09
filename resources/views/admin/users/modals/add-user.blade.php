<!-- Add Modal -->
<div id="add-dialog-user"
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50"
    aria-hidden="true">
    <div class="bg-white shadow-md p-8 flex flex-col items-center justify-center rounded-lg h-auto w-auto relative">
        <!-- Close Icon -->
        <img onclick="hideAddUserModal()" src="{{ asset('Assets/close.png') }}" alt="Close"
            class="absolute top-5 right-5 w-5 cursor-pointer hover:opacity-80">

        <!-- Title -->
        <h1 class="text-center text-xl font-semibold mb-4 text-black">Register New User</h1>

        <hr class="text-gray-600 w-full mb-4">

        <!-- Form -->
        <form id="add-user-form" action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col items-center mt-5 flex-wrap">
                <div class="flex items-center justify-center w-full space-x-3 flex-wrap">
                    <div class="relative w-[350px] mb-4">
                        <label for="firstname" class="text-sm">First Name <span class="text-red-500">*</span></label>
                        <input id="firstname"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Enter first name" name="firstname">

                        @error('firstname')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <label for="lastname" class="text-sm">Last Name <span class="text-red-500">*</span></label>
                        <input id="lastname"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Enter last name" name="lastname">

                        @error('lastname')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                </div>

                <div class="flex items-center justify-center w-full space-x-3 flex-wrap ">
                    <div class="relative w-[350px] mb-4">
                        <label for="email" class="text-sm">Email <span class="text-red-500">*</span></label>
                        <input id="email"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs"
                            type="text" placeholder="Enter email" name="email">

                        @error('email')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>

                    <div class="relative w-[350px] mb-4">
                        <label for="role" class="text-sm">Role <span class="text-red-500">*</span></label>
                        <select name="role" id="role"
                            class="mb-1 mt-2 peer w-full h-10 text-gray-600 border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-1 focus:ring-blue-300 focus:ring-opacity-70 text-xs">
                            <option value="" disabled selected>Select user role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>

                        @error('role')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                </div>
            </div>
            <div class="w-full flex items-center justify-center">
                <button type="submit"
                    class="text-sm text-white rounded-lg h-[40px] w-1/2 hover:bg-green-700 bg-green-600">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
