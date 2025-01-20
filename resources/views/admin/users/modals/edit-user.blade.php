<!-- Edit Modal -->
<div id="edit-dialog-user" tabindex="-1" aria-hidden="true"
class="fixed inset-0 z-50 flex items-center justify-center hidden transition-opacity duration-200 bg-black bg-opacity-50 opacity-0">
    <div class="relative w-full h-full max-w-2xl p-4 md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex items-center justify-between pb-4 mb-4 border-b rounded-t sm:mb-5 ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Edit User Details
                </h3>
                <button type="button" onclick="hideEditUserModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="edit-user-form" action="{{ route('admin.user.update') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="" name="user_id" id="user_id" >
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900 ">First Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="first_name" id="edit_firstname" disabled
                            class="bg-gray-50 border cursor-not-allowed text-gray-600 border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type first name" required="">

                        @error('first_name')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
                    </div>
                    <div>
                        <label for="last_name"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Last Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="last_name" id="edit_lastname" disabled
                            class="bg-gray-50 border cursor-not-allowed text-gray-600 border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type last name" required="">

                        @error('last_name')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Email <span
                            class="text-red-500">*</span></label>
                        <input type="email" name="email" id="edit_email" disabled
                            class="bg-gray-50 border cursor-not-allowed text-gray-600 border-gray-300 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type email here" required="">

                        @error('email')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
                    </div>
                    <div>
                        <label for="role"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Role <span
                            class="text-red-500">*</span></label>
                        <select id="edit_role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option value="" selected="">Select user role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>

                        @error('role')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
                    </div>
                    <div>
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900">
                            Status <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" id="status_active" name="status" value="active" required
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <span class="ml-2 text-sm text-gray-900">Active</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" id="status_deactivated" name="status" value="deactivated"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <span class="ml-2 text-sm text-gray-900">Deactivated</span>
                            </label>
                        </div>

                        @error('status')
                            <span class="mt-1 text-xs text-red-600">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class="block mt-2 ml-1 text-xs text-red-500 w-80"></div>
                    </div>

                </div>
                <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
