<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="flex justify-center items-center h-screen">
        <div class="w-full max-w-md">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h2 class="text-2xl mb-4">Login</h2>
                <p class="text-gray-700 mb-4">Please fill in your credentials to log in</p>
                <form action="<?php echo URLROOT; ?>/users/login" method="post">
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email: <sup>*</sup></label>
                        <input type="email" name="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <span class="invalid-feedback"><?php echo $data['email_error'];?></span>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <span class="invalid-feedback"><?php echo $data['password_error'];?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <input type="submit" name="login" value="Login" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        <a href="<?php echo URLROOT; ?>/users/register" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">No account? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>