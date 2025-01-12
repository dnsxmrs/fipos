<!-- Add Modal -->
<div id="add-dialog-user" tabindex="-1" aria-hidden="true"
class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center opacity-0 transition-opacity duration-200 z-50">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow sm:p-5">
            <!-- Modal header -->
            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 ">
                <h3 class="text-lg font-semibold text-gray-900 ">
                    Register New User
                </h3>
                <button type="button" onclick="hideAddUserModal()"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center"
                    data-modal-toggle="defaultModal">
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
            <form id="add-user-form" action="{{ route('admin.user.add') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="firstname"
                            class="block mb-2 text-sm font-medium text-gray-900 ">First Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="firstname" id="firstname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type first name" required="">

                        @error('firstname')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                    <div>
                        <label for="lastname"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Last Name <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="lastname" id="lastname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type last name" required="">

                        @error('lastname')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Email <span
                            class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 "
                            placeholder="Type email here" required="">

                        @error('email')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                    <div>
                        <label for="role"
                            class="block mb-2 text-sm font-medium text-gray-900 ">Role <span
                            class="text-red-500">*</span></label>
                        <select id="role" name="role"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                            <option value="" selected="">Select user role</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>

                        @error('role')
                            <span class="text-red-600 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <div id="error-name" class=" text-red-500 w-80 text-xs mt-2 ml-1 block"></div>
                    </div>
                </div>
                <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Register
                </button>
            </form>
        </div>
    </div>
</div>
