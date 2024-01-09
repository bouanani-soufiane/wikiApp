<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<section>
    <div class="bg-gray-800">
        <div class="bg-gradient-to-b from-transparent via-violet-600/[.25]">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="block font-medium text-gray-200 text-3xl sm:text-5xl md:text-6xl lg:text-5xl">
                        Explorez l'univers du savoir avec WikiApp : Écrivez, Découvrez, Partagez !
                    </h1>
                </div>
                <div class="max-w-3xl text-center mx-auto">
                    <p class="text-lg text-gray-400">Plongez dans des articles fascinants, contribuez avec vos connaissances et explorez une source infinie d'informations sur WikiApp.</p>
                </div>
                <div class="text-center">
                    <a class="inline-flex justify-center items-center gap-x-3 text-center bg-white shadow-md hover:shadow-blue-700/50 border border-transparent text-blue-800 text-sm font-medium rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white py-3 px-6 dark:focus:ring-offset-gray-800 transition-all duration-300 hover:bg-blue-800 hover:text-white" href="#">
                        Commencer
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="font-sans mx-auto max-w-screen-lg text-black mt-5 bg-white flex items-center justify-between">
    <div class="border rounded overflow-hidden flex items-center justify-center w-full">
        <input type="text" class="px-4 w-full py-2" placeholder="Search...">
        <button class="flex items-center justify-center px-4 border-l ">
            <i class="ri-search-line"></i>
        </button>
    </div>
    <a href="<?php echo URLROOT; ?>/Wikis/create" class="flex items-center text-gray-700 hover:text-black ml-4 px-4 py-2 bg-gray-200 rounded">
        <i class="ri-pencil-line"></i>
    </a>

</div>
    <!-- Categories Section -->
    <div class="mt-4 flex items-center justify-center ">
        <div class="flex space-x-4 ">
            <div class="bg-gray-200 p-2 rounded">Category 1</div>
            <div class="bg-gray-200 p-2 rounded">Category 2</div>
            <div class="bg-gray-200 p-2 rounded">Category 3</div>
            <div class="bg-gray-200 p-2 rounded">Category 1</div>
            <div class="bg-gray-200 p-2 rounded">Category 2</div>
            <div class="bg-gray-200 p-2 rounded">Category 3</div>
        </div>
    </div>

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>
        <div class="rounded overflow-hidden shadow-lg">
            <a href="#">
                <div class="relative">
                    <img class="w-full" src="https://images.pexels.com/photos/196667/pexels-photo-196667.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="Sunset in the mountains">
                    <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                    <a href="#!">
                        <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            Photos
                        </div>
                    </a>
                    <a href="!#">
                        <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                            <span class="font-bold">27</span>
                            <small>March</small>
                        </div>
                    </a>
                </div>
            </a>
            <div class="px-6 py-4">
                <a href="#" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out">Best View in Newyork City</a>
                <p class="text-gray-500 text-sm">
                    The city that never sleeps
                </p>
            </div>
            <div class="px-6 py-4 flex flex-row items-center">
                <span href="#" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1">6 mins ago</span></span>
            </div>
        </div>

    </div>
</div>



<?php require APPROOT . '/views/inc/footer.php'; ?>
