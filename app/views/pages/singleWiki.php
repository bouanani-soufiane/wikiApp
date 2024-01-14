<?php
require APPROOT . '/views/inc/header.php';

if (!empty($data)) {
    if (isset($data['wiki'])) {
        $wikiData = $data['wiki'];
        list($wiki, $wikiTags) = $wikiData;
    }else{
            header("location: http://localhost/wikiApp");

    }
}
?>
<div class="max-w-screen-lg mx-auto p-5 sm:p-10 md:p-16">

    <?php if (isset($_SESSION['userId']) && $_SESSION['userId'] === $wiki->getUser()->getId() ) : ?>
        <a href="<?php echo URLROOT; ?>/Wikis/edit/<?php echo $wiki->getId();?>" class="text-green-500 hover:text-green-700">
            <i class="ri-edit-box-fill text-3xl"></i> edit
        </a>
    <br>
        <a href="<?php echo URLROOT; ?>/Wikis/delete/<?php echo $wiki->getId();?>" class="text-red-500 hover:text-red-700">
            <i class="ri-delete-bin-2-fill text-3xl"></i> delete
        </a>

    <?php endif; ?>

    <div class="mb-10 rounded overflow-hidden flex flex-col mx-auto text-center">
        <a href="#" class="max-w-3xl mx-auto space-y-4 text-xl sm:text-5xl mb-6  font-semibold inline-block hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-6"><?php echo $wiki->getTitre(); ?></a>
        <a href="#">
            <img class="w-full my-4 mb-6" src="<?= URLROOT ?>/img/<?php echo ($wiki->getImage()); ?>" alt="Sunset in the mountains">
        </a>
        <a href="#" class="max-w-3xl mx-auto text-xl sm:text-2xl font-semibold inline-block hover:text-indigo-600 transition duration-500 ease-in-out inline-block mb-6"><?php echo $wiki->getDescription(); ?></a>

        <p class="text-gray-700 text-base leading-8 max-w-2xl mx-auto mb-4">
            <?php echo $wiki->getContent(); ?>
        </p>
        <div class="py-5 text-sm font-regular text-gray-900 flex items-center justify-center mb-4">
            <span class="mr-3 flex flex-row items-center">
                <svg class="text-indigo-600" fill="currentColor" height="13px" width="13px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                        <g>
                            <path d="M256,0C114.837,0,0,114.837,0,256s114.837,256,256,256s256-114.837,256-256S397.163,0,256,0z M277.333,256
			c0,11.797-9.536,21.333-21.333,21.333h-85.333c-11.797,0-21.333-9.536-21.333-21.333s9.536-21.333,21.333-21.333h64v-128
			c0-11.797,9.536-21.333,21.333-21.333s21.333,9.536,21.333,21.333V256z" />
                        </g>
                    </g>
                </svg>
                <span class="ml-1"><?php echo $wiki->getCreatedAt();?></span></span>
            <a href="#" class="flex flex-row items-center hover:text-indigo-600  mr-3">
                <svg class="text-indigo-600" fill="currentColor" height="16px" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"></path>
                    <path d="M0 0h24v24H0z" fill="none"></path>
                </svg>
                <span class="ml-1"><?php echo $wiki->getUser()->getName(); ?></span></a>
            <a href="#" class="flex flex-row items-center hover:text-indigo-600">
                <i class="ri-projector-fill"></i>
                <span class="ml-1"><?php echo $wiki->getCategory()->getName(); ?></span>
            </a>

        </div>

        <div class="py-5 text-sm font-regular text-gray-900 flex items-center justify-center mb-4">
            <a href="#" class="flex flex-row items-center hover:text-indigo-600">
                <?php if (!empty($wikiTags)) : ?>
                    <?php foreach ($wikiTags as $wikiTag): ?>
                        <i class="ri-hashtag"></i><span class="ml-1 mr-2"><?php echo $wikiTag->getTag()->getName(); ?> </span>
                    <?php endforeach; ?>
                <?php endif; ?>
            </a>
        </div>
    </div>

</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
