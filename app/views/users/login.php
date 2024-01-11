<?php require APPROOT . '/views/inc/header.php'; ?>
    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
        <div class="bg-gray-800">
            <div class="bg-gradient-to-b from-transparent via-violet-600/[.25]">
                <div class="flex justify-center items-center h-screen">
                    <div class="w-full max-w-md">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <h2 class="text-2xl mb-4">Login</h2>
                            <p class="text-gray-700 mb-4">Please fill in your credentials to log in</p>
                            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email: <sup>*</sup></label>
                                    <input id="email" type="email" name="email" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <span class="invalid-feedback"><?php echo $data['email_error'];?></span>
                                    <span id="errorEmail" class="invalid-feedback"></span>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password: <sup>*</sup></label>
                                    <input id="password" type="password" name="password" class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <span class="invalid-feedback"><?php echo $data['password_error'];?></span>
                                </div>
                                <div class="flex justify-between">
                                    <div class="">
                                        <input type="submit" name="login" value="Login" class="bg-gray-800 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="">
                                        <a href="<?php echo URLROOT; ?>/users/register" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">No account? Register</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script src="<?php echo URLROOT; ?>/js/login.js"></script>
T
<?php require APPROOT . '/views/inc/footer.php'; ?>