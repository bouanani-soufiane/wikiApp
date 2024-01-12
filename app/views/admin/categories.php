<?php
require APPROOT . '/views/inc/dashboard.php';
if (!empty($data)) {
    if (!empty($data['categs'])) {
        $categs = $data['categs'];
    }
    if (!empty($data['categs'])) {
        $categs = $data['categs'];
    }
    if (!empty($data['countCateg'])) {
        $countCateg = $data['countCateg'];
    }
}
?>
<div class="w-full grid grid-cols-1  gap-6 mb-6">
    <div class=" w-full bg-white rounded-md border border-gray-100 p-6 shadow-md ">
        <div class=" w-full flex justify-between mb-4">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-semibold"><i class="ri-file-copy-2-fill"></i> <?php echo $countCateg?></div>
                    <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">Categorie</div>
                </div>
                <div class="text-sm font-medium text-gray-400">Categorie</div>
            </div>
        </div>
        <div class="flex items-center">

        </div>
    </div>
</div>

<div class="grid grid-cols-1 w-full h-  gap-6 mb-6">
    <div class="bg-white border border-gray-100 shadow-md shadow-black/5 p-6 rounded-md">
        <div class="flex justify-between mb-4 items-start">
            <div class="font-medium">All Categories</div>
            <div class="font-medium">

                <button data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block text-white bg-[#313866]  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center " type="button">
                    Add Categorie
                </button>

                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <div class="relative  rounded-lg shadow  bg-gray-800">
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Create New Categorie
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <form class="p-4 md:p-5" method="post" action="<?php echo URLROOT?>/Categories/create" enctype="multipart/form-data">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie Name</label>
                                        <input type="text" name="CategorieName" id="name" class="bg-white text-gray-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:placeholder-gray-400  outline-0" placeholder="Categorie name" required="">
                                    </div>
                                </div>
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add Cover Image:</label>
                                        <input type="file" placeholder="image" id="image" name="categorieImage"
                                               class="outline-none py-2 px-2 text-md border-2 rounded-md flex-1 bg-white text-gray-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:placeholder-gray-400  outline-0"/>
                                    </div>
                                </div>
                                <button name="addCategorie" type="submit" class="text-white inline-flex items-center bg-[#313866] hover:bg-blend-darken-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-dark-700 ">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Add New Categorie
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto h-fit">
            <table class="w-full h-fit min-w-[540px]" data-tab-for="order" data-page="active">
                <thead>
                <tr>
                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left rounded-tl-md rounded-bl-md">id</th>
                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">image</th>
                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">Nom</th>
                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left">nbr wikies</th>
                    <th class="text-[12px] uppercase tracking-wide font-medium text-gray-400 py-2 px-4 bg-gray-50 text-left"><actions></actions></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categs as $categ) : ?>

                    <tr>

                        <td class="py-2 px-4 border-b border-b-gray-50 w-1/5">
                            <span class="text-[13px] font-medium"><?php echo $categ->getId();?></span>
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-50 w-2/5">
                            <img class="w-full" src="<?= URLROOT ?>/img/<?php echo ($categ->getImage()); ?>" alt="image">
                        </td>
                        <td class="py-2 px-4 border-b border-b-gray-50 w-2/5">
                            <span class="text-[13px] font-medium "><?php echo $categ->getName();?></span>
                        </td>

                        <td class="py-2 px-4 border-b border-b-gray-50 w-1/5">
                            <span class="text-[13px] font-medium "><?php echo $categ->getId();?></span>
                        </td>
                        <td class=" flex py-2 px-4 border-b border-b-gray-50 w-1/5">
                            <form method="post" class="mx-2" action="<?php echo URLROOT?>/Categories/delete">
                                <div class="my-2">
                                    <input type="hidden" name="idCateg" value="<?php echo $categ->getId();?>" >
                                    <button name="deleteCateg" class="mt-2 py-2 px-4 bg-red-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800">
                                        <i class='ri-delete-bin-3-fill text-md'></i>
                                    </button>

                                </div>
                            </form>
                            <div class="my-2">
                                <button data-categ-name="<?php echo $categ->getName();?>"   data-categ-id="<?php echo $categ->getId();?>" data-modal-target="edit-modal" data-modal-toggle="edit-modal" class="mt-2 py-2 px-4 bg-green-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800" type="button">
                                    <i class='ri-edit-box-fill'></i>
                                </button>

                                <div id="edit-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <div class="relative  rounded-lg shadow  bg-gray-800">
                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit Categorie
                                                </h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="edit-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <form class="p-4 md:p-5" method="post" action="<?php echo URLROOT?>/Categories/edit" enctype="multipart/form-data">
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <input type="hidden" value="<?php echo $categ->getId();?>" name="idCateg">
                                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categorie Name</label>
                                                        <input type="text" id="nameCatg" name="CategorieName" id="name" class="bg-white text-gray-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:placeholder-gray-400  outline-0" placeholder="Name" required="">
                                                    </div>
                                                </div>
                                                <div class="grid gap-4 mb-4 grid-cols-2">
                                                    <div class="col-span-2">
                                                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">update Cover Image:</label>
                                                        <input type="file" placeholder="image" id="image" name="categorieImage"
                                                               class="outline-none py-2 px-2 text-md border-2 rounded-md flex-1 bg-white text-gray-900 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:placeholder-gray-400  outline-0"/>
                                                    </div>
                                                </div>
                                                <button name="editCategorie" type="submit" class="text-white inline-flex items-center bg-[#313866] hover:bg-blend-darken-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:hover:bg-dark-700 ">
                                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    Edit Categorie
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>

        </div>
    </div>
    <script src="<?php echo URLROOT; ?>/js/category.js"></script>

    <?php
require APPROOT . '/views/inc/dashboard_footer.php';
?>
