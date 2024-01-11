<nav class="bg-gray-800 p-4">
    <div class="container mx-auto flex items-center justify-between">
        <a class="text-white text-lg font-semibold" href="<?php echo URLROOT; ?>"><?php echo SITENAME; ?></a>

        <button class="lg:hidden text-white focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <div class="hidden lg:flex lg:items-center lg:w-auto">
            <ul class="ml-auto hidden lg:flex lg:items-center lg:w-auto space-x-4">
                <li>
                    <a class="text-white hover:text-gray-300" href="<?php echo URLROOT; ?>">Home</a>
                </li>
                <li>
                    <a class="text-white hover:text-gray-300" href="<?php echo URLROOT; ?>/categories/categories">Categories</a>
                </li>
            </ul>
        </div>

        <div class="hidden lg:flex lg:items-center lg:w-auto">
              <ul class="ml-auto hidden lg:flex lg:items-center lg:w-auto space-x-4 ">
                <?php if (isset($_SESSION['userId'])) : ?>
                    <li>
                        <a class="text-white hover:text-gray-300" href="<?php echo URLROOT; ?>/users/logout">Logout</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a class="text-white hover:text-gray-300" href="<?php echo URLROOT; ?>/users/register">Register</a>
                    </li>
                    <li>
                        <a class="text-white hover:text-gray-300" href="<?php echo URLROOT; ?>/users/login">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
