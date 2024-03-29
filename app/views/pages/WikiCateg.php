<?php
require APPROOT . '/views/inc/header.php';
$wikis = [];
if (!empty($data) && isset($data['wiki'])) {
    $wikis = $data['wiki'];
    function calculateReadingTime($content) {
        return ceil(str_word_count(strip_tags($content)) / 200);
    }
}
?>

<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
<section>
    <div class="bg-gray-800">
        <div class="bg-gradient-to-b from-transparent via-violet-600/[.25]">
            <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-24 space-y-8">
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="block font-medium text-gray-200 text-3xl sm:text-5xl md:text-6xl lg:text-5xl">
                        Explorez l'univers du   <?php
                            if (!empty($wikis)) :
                          echo $wikis[0]->getCategory()->getName();
                            endif;

                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>


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
                <div class="px-6 py-4 flex flex-row items-center">
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
                </div>
            </div>

        <?php endforeach; ?>

    </div>
</div>
<?php else : ?>
<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <div class="flex justify-center w-1/5 mx-auto">
        <img class="w-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTXlWq8ZQisSOTUXhodNjvAf3T5wq_YgfLen9V6EMIhVA&s" alt="">

    </div>
</div>

<?php endif; ?>


<?php require APPROOT . '/views/inc/footer.php'; ?>
