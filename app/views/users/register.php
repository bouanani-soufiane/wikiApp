<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
            <h2 class="text-2xl font-semibold mb-4">Create An Account</h2>
            <p class="text-gray-600 mb-6">Please fill out this form to register with us</p>
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-600">Name: <sup>*</sup></label>
                    <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded">
                    <span class="text-red-500"></span>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-600">Email: <sup>*</sup></label>
                    <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded">
                    <span class="text-red-500"></span>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-600">Password: <sup>*</sup></label>
                    <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded">
                    <span class="text-red-500"></span>
                </div>
                <div class="mb-4">
                    <label for="confirm_password" class="block text-sm font-medium text-gray-600">Confirm Password: <sup>*</sup></label>
                    <input type="password" name="confirm_password" class="w-full p-2 border border-gray-300 rounded">
                    <span class="text-red-500"></span>
                </div>

                <div class="flex">
                    <div class="mr-2">
                        <input type="submit" value="Register" class="bg-green-500 text-white px-4 py-2 rounded cursor-pointer">
                    </div>
                    <div>
                        <a href="<?php echo URLROOT; ?>/users/login" class="text-gray-600 hover:underline">Have an account? Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>