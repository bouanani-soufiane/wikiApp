<?php require APPROOT . '/views/inc/header.php'; ?>

   <style>.input-group {position: relative;}.input-group span {position: absolute;bottom: 12px;right: 17px;font-size:14px;color:red;}#submit-error {color: red;}.input-group label {flex-basis: 28%;}</style>

    <div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
        <div class="bg-gray-800">
            <div class="bg-gradient-to-b from-transparent via-violet-600/[.25]">
                <div class="flex justify-center items-center h-screen">
                    <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2 lg:w-1/3 xl:w-1/4">
                        <h2 class="text-2xl font-semibold mb-4">Create An Account</h2>
                        <p class="text-gray-600 mb-6">Please fill out this form to register with us</p>
                        <form action="<?php echo URLROOT; ?>/users/register" method="post" id="form">
                            <div class="mb-4 input-group">
                                <label for="name" class="block text-sm font-medium text-gray-600">Name: <sup>*</sup></label>
                                <input type="text" name="name" class="w-full p-2 border border-gray-300 rounded"  id="fullName" onkeyup="fullnameValidate()">
                                <input type="hidden" name="role" class="w-full p-2 border border-gray-300 rounded" value="author">
                                <span class="text-red-500"><?php echo $data['name_error'];?></span>
                                <span id="name-error"></span>

                            </div>
                            <div class="mb-4 input-group">
                                <label for="email" class="block text-sm font-medium text-gray-600">Email: <sup>*</sup></label>
                                <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" id="email" onkeyup="emailValidate()">
                                <span class="text-red-500"><?php echo $data['email_error'];?></span>
                                <span id="email-error"></span>

                            </div>
                            <div class="mb-4 input-group">
                                <label for="password" class="block text-sm font-medium text-gray-600">Password: <sup>*</sup></label>
                                <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" id="password" onkeyup="passwordValidate()">
                                <span class="text-red-500"><?php echo $data['password_error'];?></span>
                                <span id="password-error"></span>
                            </div>
                            <div class="mb-4 input-group">
                                <label for="confirm_password" class="block text-sm font-medium text-gray-600">Confirm Password: <sup>*</sup></label>
                                <input type="password" name="confirm-password" class="w-full p-2 border border-gray-300 rounded" id="repeatPassword" onkeyup="repeatPasswordValidate()">
                                <span class="text-red-500"><?php echo $data['confirm_password_error'];?></span>
                                <span id="repeatPassword-error"></span>
                            </div>

                            <div class="flex">
                                <div class="mr-2">
                                    <input onclick="return validateForm()" type="submit" name="registre" value="Register" class="bg-gray-800 text-white px-4 py-2 rounded cursor-pointer">
                                </div>
                                <div class="flex items-center justify-between">
                                    <a href="<?php echo URLROOT; ?>/users/login" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">Have an account? Login</a>
                                </div>

                            </div>
                                <span id="submit-error"></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <script src="<?php echo URLROOT; ?>/js/register.js"></script>

<?php //require APPROOT . '/views/inc/footer.php'; ?>