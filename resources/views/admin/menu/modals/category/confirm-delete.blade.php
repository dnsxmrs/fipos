<!--Confirm Delete-->
<div id="confirm-delete-dialog-categories"
    class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 hidden" aria-hidden="true">
    <div
        class="bg-white p-4 shadow-md text-center w-[500px] h-[380px] rounded-[20px] overflow-hidden flex flex-col items-center">
        <img src="{{ asset('Assets/icons-password.png') }}" alt="Password Icon" class="w-[150px] h-[150px] mb-4">
        <h2 class="text-lg font-semibold">Confirm Delete</h2>
        <p class="mt-1 mb-1">Enter your password below:</p>
        <!-- Password input section -->
        <div class="relative mt-4">
            <input type="password" id="password"
                class="peer w-[250px] h-[42px] border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-red-700 focus:ring-opacity-70 placeholder-transparent"
                placeholder=" ">
            <label
                class="text-sm absolute left-2 top-2 transform transition-transform duration-300 ease-in-out scale-100 text-gray-500 origin-left peer-placeholder-shown:top-2 peer-placeholder-shown:left-2 peer-placeholder-shown:scale-100 peer-focus:-top-5 peer-focus:left-2 peer-focus:scale-75"
                for="password">Input Password</label>
        </div>
        <button id="confirmButtonCategory"
            class="mt-4 bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-gray-100 w-[200px]">Confirm</button>
    </div>
</div>
