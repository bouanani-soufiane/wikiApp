<?php
require APPROOT . '/views/inc/header.php';
if (!empty($data)) {
    if (!empty($data['categs'])) {
        $categs = $data['categs'];
    }
    if (!empty($data['tags'])) {
        $tags = $data['tags'];
    }
}
?>
<main class="w-full max-h-screen transition-all main">
    <form method="post" action="<?php echo URLROOT?>/Wikis/store" enctype="multipart/form-data">
        <div class="bg-gray-800 min-h-screen md:px-20 pt-6 bg-gradient-to-b from-transparent via-violet-600/[.30]">
                <h1 class="text-center text-6xl font-bold text-slate-100 mb-8 ">Create Post</h1>
            <div class=" bg-white rounded-xl px-6 py-10 mx-auto">
                <div class="space-y-4">
                    <div class="flex items-center justify-between gap-6">
                        <div class="flex flex-1 flex-col gap-4">
                            <label for="title" class="text-lx">Title:</label>
                            <input type="text" placeholder="title" id="title" name="wikiTitle"
                                   class="outline-none py-3 px-2  text-md border-2 rounded-md flex-1"/>
                        </div>
                        <div class="flex flex-1 flex-col gap-4">
                            <label for="image" class="text-lx">Add Cover Image:</label>
                            <input type="file" placeholder="image" id="image" name="image"
                                   class="outline-none py-2 px-2 text-md border-2 rounded-md flex-1"/>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col gap-4">
                        <label for="Description" class="text-lx">Description:</label>
                        <input type="text" placeholder="Description" id="title" name="wikiDescription"
                               class="outline-none py-4 px-2 text-md border-2 rounded-md flex-1"/>
                    </div>
                    <div>
                        <label for="Content" class="block mb-2 text-lg ">Content:</label>
                        <textarea id="Content" cols="30" rows="10" placeholder="Write here.." name="wikiContent"
                                  class="w-full p-4 text-gray-800  bg-gray-200 focus:outline-none  focus:outline-black rounded-md"></textarea>
                    </div>
                    <div class="flex gap-4 justify-between">
                        <div class="w-[40%] flex flex-col items-start ml-2 gap-4">
                            <label for="category" class="text-lx ">Category:</label>
                            <select name="category" id="category">
                                <?php foreach ($categs as $categ) : ?>
                                    <option value="<?php echo $categ->getId();?>"><?php echo $categ->getName();?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="tags" class="text-xl font-bold">Tags:</label>
                        <div class="flex flex-wrap items-start mt-2 gap-4">
                            <?php foreach ($tags as $tag) : ?>
                                <div class="flex items-center justify-center gap-2 bg-gray-200 px-4 py-2 rounded-md">
                                    <input type="checkbox" value="<?php echo $tag->getId();?>" name="tags[]" id="">
                                    <label for="checkbox"><?php echo $tag->getName();?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end">
                    <button type="submit" name="save" class="bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-900 focus:outline-none focus:ring focus:border-blue-900 ml-auto">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>
