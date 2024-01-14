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
        <div class=" bg-gray-800 min-h-screen md:px-20 pt-6 bg-gradient-to-b from-transparent via-violet-600/[.30]">
                <h1 class="text-center text-6xl font-bold text-slate-100 mb-8 ">Create Post</h1>
            <div class="w-fit bg-white rounded-xl px-6 py-10 mx-auto">
                <div class="space-y-4">
                    <div class="flex items-center justify-between gap-6">
                        <div class="flex flex-1 flex-col gap-4">
                            <label for="title" class="text-lx">Title:</label>
                            <input type="text" placeholder="title" id="title" name="wikiTitle"
                                   class="outline-none py-3 px-2  text-md border-2 rounded-md flex-1"/>
                        </div>
                        <div class="flex flex-1 flex-col gap-4">
                            <div class="mx-auto max-w-xs w-full">
                                <label for="example5" class="mb-1 block text-sm font-medium text-gray-700 mb-4">Upload file</label>
                                <label class="flex w-full cursor-pointer appearance-none items-center justify-center rounded-md border-2 border-dashed border-gray-200 p-1 transition-all hover:border-primary-300">
                                    <div class="space-y-1 text-center">
                                        <div class="mx-auto inline-flex h-10 w-10 items-center justify-center rounded-full bg-gray-100">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 text-gray-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <input name="image" id="example5" type="file" class="sr-only" />
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-1 flex-col gap-4">
                        <label for="Description" class="text-lx">Description:</label>
                        <input type="text" placeholder="Description" id="title" name="wikiDescription"
                               class="outline-none py-4 px-2 text-md border-2 rounded-md flex-1"/>
                    </div>
                    <div>
                        <div class=" flex w-full flex-row items-center gap-2 rounded-[99px] border border-gray-900/10 bg-gray-900/5 p-2">
                            <div class="relative grid h-full w-full min-w-[200px]">
                                <textarea name="wikiContent" rows="1" placeholder="Your Wiki" class="peer h-full  min-h-full w-full resize-y rounded-[7px]  !border-0 border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder:text-blue-gray-300 placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-transparent focus:border-t-transparent focus:outline-0 disabled:resize-none disabled:border-0 disabled:bg-blue-gray-50"></textarea>
                                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all before:content-none after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all after:content-none peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500"></label>
                            </div>
                        </div>
                    </div>

                    <div class="flex  gap-4 justify-between">
                        <div class="relative w-[40%] flex flex-col items-start ml-2 gap-4">
                            <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Select a Category
                            </label>
                            <select name="category" id="category" class="text-gray-800  bg-emerald-500 peer h-full w-full rounded-[7px] border border-blue-gray-200 border-t-transparent bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 empty:!bg-gray-900 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50">
                                >
                                <?php foreach ($categs as $categ) : ?>
                                    <option class="text-gray-800  bg-gray-200" value="<?php echo $categ->getId();?>"><?php echo $categ->getName();?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="tags" class="text-xl font-bold">Tags:</label>
                        <div class="flex flex-wrap items-start mt-2 gap-4">
                            <?php foreach ($tags as $tag) : ?>
                                <div class="flex items-center justify-center gap-2 bg-gray-200 px-4 py-2 rounded-md">
                                    <input type="checkbox" value="<?php echo $tag->getId();?>" name="tags[]" id="checkbox<?php echo $tag->getId();?>"    class="accent-pink-500">
                                    <label for="checkbox<?php echo $tag->getId();?>"><?php echo $tag->getName();?></label>

                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-center">
                    <button type="submit" name="save" class="bg-blue-800 text-white px-6 py-3 rounded-md hover:bg-blue-900 focus:outline-none focus:ring focus:border-blue-900 mt-6 w-full ">
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</main>
