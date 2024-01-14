<?php
require APPROOT . '/views/inc/header.php';
if (!empty($data)) {

    if (!empty($data['tags'])) {
        $tags = $data['tags'];
    }
    if (!empty($data['wiki'])) {
        $wikis = $data['wiki'];
    }
    function calculateReadingTime($content) {
        return ceil(str_word_count(strip_tags($content)) / 200);
    }

}

?>

<script src="https://cdn.tailwindcss.com"></script>

<div class="h-full bg-gray-200 p-6">
    <div class="bg-white rounded-lg shadow-xl pb-8 rounded-b">
        <div class="w-full h-[150px] bg-gray-800 rounded-lg">
        </div>
        <div class="flex flex-col items-center -mt-20">
            <img src="<?= URLROOT ?>/img/bouanani.png" class="w-40 border-4 border-white rounded-full">
            <div class="flex items-center space-x-2 mt-2">
                <p class="text-2xl"><?= $_SESSION['userName']?></p>
                <span class="bg-blue-500 rounded-full p-1" title="Verified">
                        <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-100 h-2.5 w-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </span>
            </div>
            <p class="text-gray-700"><?= $_SESSION['userEmail']?></p>
            <p class="text-sm text-gray-500">Author</p>
        </div>
        <div class="flex-1 flex flex-col items-center lg:items-end justify-end px-8 ">
            <div class="flex items-center  ">
                <a href="<?php echo URLROOT; ?>/Wikis/create" class="flex items-center text-white hover:text-black hover:bg-blue-200  ml-4 px-4  bg-gray-800 rounded">
                    Add article &nbsp;
                    <i class="ri-edit-2-line my-2 p-1"></i>
                </a>

            </div>
        </div>

    </div>


</div>



<style>.categ-image {width: 100%;height: 200px;object-fit: cover; }</style>


<div class="h-full bg-gray-200 p-6">
    <div class="bg-white rounded-lg shadow-xl pb-8 rounded-b">
        <div class="w-full h-[50px] rounded-lg"></div>

    <div class="mt-4 flex items-center justify-center ">
        <div class="flex space-x-4 ">
            <h1 class="block font-bold px-2 sm:text-5xl md:text-6xl lg:text-5xl  uppercase text-2xl">
                votre dernières wikis</h1>
        </div>
    </div>
        <?php if (!empty($wikis)) : ?>

        <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">

            <?php foreach ($wikis as $wiki) : ?>
                <div class="rounded overflow-hidden shadow-lg">
                    <a href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>">
                        <div class="relative">
                            <img class="w-full" src="<?= URLROOT ?>/img/<?php echo ($wiki->getImage()); ?>" alt="Sunset in the mountains">
                            <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                            <a href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>">
                                <div class="absolute bottom-0 left-0 bg-black  px-4 py-2 text-white text-sm hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                    <?php echo $wiki->getCategory()->getName();?>
                                </div>
                            </a>
                            <a href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>">
                                <div class="text-sm absolute top-0 right-0 bg-black px-4 text-white rounded-full h-16 w-16 flex flex-col items-center justify-center mt-3 mr-3 hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                    <span class="font-bold">27</span>
                                    <small>March</small>
                                </div>
                            </a>
                        </div>
                    </a>
                    <div class="px-6 py-4">
                        <a href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>" class="font-semibold text-lg inline-block hover:text-indigo-600 transition duration-500 ease-in-out"><?php echo $wiki->getTitre();?></a>
                        <p class="text-gray-500 text-sm">

                            <?php echo mb_strimwidth($wiki->getDescription(), 0, 100, '...');?>
                        </p>
                    </div>
                    <div class="px-6 py-4 flex flex-row  justify-between">
                <span href="<?php echo URLROOT; ?>/Wikis/showSingle/<?php echo $wiki->getId();?>" class="py-1 text-sm font-regular text-gray-900 mr-1 flex flex-row items-center">
                    <svg height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                            </g>
                        </g>
                    </svg>
                    <span class="ml-1"><?php echo calculateReadingTime($wiki->getContent()) ;?> mins reading</span></span>

                        <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] === $wiki->getUser()->getId() ) : ?>
                            <a href="<?php echo URLROOT; ?>/Wikis/edit/<?php echo $wiki->getId();?>" class="text-green-500 hover:text-green-700">
                                <i class="ri-edit-box-fill text-3xl"></i>
                            </a>
                            <a href="<?php echo URLROOT; ?>/Wikis/delete/<?php echo $wiki->getId();?>" class="text-red-500 hover:text-red-700">
                                <i class="ri-delete-bin-2-fill text-3xl"></i>
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; ?>

            </div>
        </div>
        <?php else : ?>
            <div class="flex justify-center mx-auto ">
                <img src="https://cdn.dribbble.com/users/729823/screenshots/14751136/media/10e33cf51cbd187fa8a79c0c7e637213.png" usemap="#image-map">
                <map name="image-map">
                    <area target="" alt="" title="" href="<?php echo URLROOT; ?>/Wikis/create" coords="974,908,621,839" shape="rect">
                </map>
            </div>


        <?php endif; ?>

</div>
<script src="<?php echo URLROOT; ?>/js/testRecherch.js"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>