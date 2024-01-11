<?php
require APPROOT . '/views/inc/header.php';
if (!empty($data)) {
    if (!empty($data['categs'])) {
        $categs = $data['categs'];
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
                        Explorez les richesses du savoir avec WikiApp : Toutes les Catégories

                    </h1>
                </div>

            </div>
        </div>
    </div>
</section>

<style>.categ-image {width: 100%;height: 200px;object-fit: cover; }</style>


<!-- Categories Section -->
<div class="mt-4 flex items-center justify-center ">
    <div class="flex space-x-4 ">
        <h1 class="block font-medium px-2 text-5xl sm:text-5xl md:text-6xl lg:text-5xl">
            Explorez Toutes Les Catégories</h1>
    </div>
</div>

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <div class="grid grid-cols-1 md:grid-cols-3 sm:grid-cols-2 gap-10">
        <?php foreach ($categs as $categ) : ?>

            <div class="rounded ">
                <a href="<?php echo URLROOT; ?>/Wikis/showWikiCateg/<?php echo $categ->getId();?>">
                    <div class="relative h-full">
                        <img class="w-full" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($categ->getImage()); ?>" alt="Sunset in the mountains">
                        <div class="hover:bg-transparent transition duration-300 absolute bottom-0 top-0 right-0 left-0 bg-gray-900 opacity-25"></div>
                        <a href="<?php echo URLROOT; ?>/Wikis/showWikiCateg/<?php echo $categ->getId();?>">
                            <div class="absolute w-full bottom-0 left-0 bg-black  px-4 py-4 text-white text-md text-center hover:bg-white hover:text-black transition duration-500 ease-in-out">
                                <?php echo $categ->getName();?>
                            </div>
                        </a>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<?php require APPROOT . '/views/inc/footer.php'; ?>
