<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="/wikiApp/public/css/output.css" rel="stylesheet">

    <title>Dashboard</title>
</head>
<body class="text-gray-800 font-inter">

<div class="fixed left-0 top-0 w-64 h-full bg-gray-900 p-4 z-50 sidebar-menu transition-transform">
    <a href="#" class="flex items-center pb-4 border-b border-b-gray-800">
        <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded object-cover">
    </a>
    <ul class="mt-4">
        <li class="mb-1 group active">
            <a href="<?php echo URLROOT; ?>/dashboard" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-home-2-line mr-3 text-lg"></i>
                <span class="text-sm">Dashboard</span>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="<?php echo URLROOT; ?>/categories" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class="ri-file-copy-2-fill mr-3 text-lg"></i>
                <span class="text-sm">Categories</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="<?php echo URLROOT; ?>/tags" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 sidebar-dropdown-toggle">
                <i class="ri-bookmark-line mr-3 text-lg"></i>
                <span class="text-sm">Tags</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
        </li>
        <li class="mb-1 group">
            <a href="<?php echo URLROOT; ?>/wikis" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-wordpress-fill mr-3 text-lg"></i>
                <span class="text-sm">Wikies</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>

            </a>
        </li>
        <li class="mb-1 group">
            <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100">
                <i class="ri-logout-box-line mr-3 text-lg"></i>
                <span class="text-sm">logout</span>
                <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
            </a>
        </li>
    </ul>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<!-- end: Sidebar -->

<!-- start: Main -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
            </li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
            <li class="text-gray-600 mr-2 font-medium"><?=$_GET['url']?></li>
        </ul>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">324</div>
                            <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+30%</div>
                        </div>
                        <div class="text-sm font-medium text-gray-400">Visitors</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded-full object-cover block">

                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-4">
                    <div>
                        <div class="flex items-center mb-1">
                            <div class="text-2xl font-semibold">324</div>
                            <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">+30%</div>
                        </div>
                        <div class="text-sm font-medium text-gray-400">Visitors</div>
                    </div>
                </div>
                <div class="flex items-center">
                    <img src="https://placehold.co/32x32" alt="" class="w-8 h-8 rounded-full object-cover block">

                </div>
            </div>
            <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
                <div class="flex justify-between mb-6">
                    <div>
                        <div class="text-2xl font-semibold mb-1"><span class="text-base font-normal text-gray-400 align-top">&dollar;</span>2,345</div>
                        <div class="text-sm font-medium text-gray-400">Active orders</div>
                    </div>
                </div>
                <a href="#" class="text-blue-500 font-medium text-sm hover:text-blue-600">View details</a>
            </div>
        </div>
