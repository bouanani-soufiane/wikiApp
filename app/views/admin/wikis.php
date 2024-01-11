<?php
require APPROOT . '/views/inc/dashboard.php';
if (!empty($data)) {
    if (!empty($data['wiki'])) {
        $wikis = $data['wiki'];
    }
    if (!empty($data['countWiki'])) {
        $countWiki = $data['countWiki'];
    }
}
?>
<div class="w-full grid grid-cols-1  gap-6 mb-6">
    <div class=" w-full bg-white rounded-md border border-gray-100 p-6 shadow-md ">
        <div class=" w-full flex justify-between mb-4">
            <div>
                <div class="flex items-center mb-1">
                    <div class="text-2xl font-semibold"><i class="ri-file-copy-2-fill"></i> <?php echo $countWiki?></div>
                    <div class="p-1 rounded bg-emerald-500/10 text-emerald-500 text-[12px] font-semibold leading-none ml-2">Wikis</div>
                </div>
                <div class="text-sm font-medium text-gray-400">Wikis</div>
            </div>
        </div>
        <div class="flex items-center">

        </div>
    </div>
</div>
<div class="grid grid-cols-1 w-full ">

    <div class="flex flex-col h-full">
        <div class="w-full bg-white shadow-lg rounded-sm border border-gray-200">

            <div class="p-3">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                        <tr>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">image</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">title</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">content</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-left">archived</div>
                            </th>
                            <th class="p-2 whitespace-nowrap">
                                <div class="font-semibold text-center">action</div>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                        <?php foreach ($wikis as $wiki) : ?>
                            <tr>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 flex-shrink-0 mr-2 sm:mr-3">

                                            <img class="rounded-b" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wiki->getImage()); ?>"  width="80" height="100" alt="image">

                                        </div>
                                        <div class="font-medium text-gray-800"></div>
                                    </div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left"><?php echo mb_strimwidth($wiki->getTitre(), 0, 100, '...');?></div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500"><?php echo mb_strimwidth($wiki->getContent(), 0, 250, '...');?></div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-left font-medium text-green-500"><?=$wiki->getIsArchived()?></div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <form method="post" class="mx-2" action="<?php echo URLROOT?>/Wikis/archive/<?=$wiki->getId()?>">
                                        <div class="my-2">
                                            <input type="hidden" name="idWiki" value="<?php echo $wiki->getId();?>" >
                                            <button name="archiveWiki" class="mt-2 py-2 px-4 bg-red-500 text-white rounded-md hover:bg-red-300 focus:outline-none focus:shadow-outline-blue active:bg-red-500">
                                                <i class='ri-archive-line text-md'></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
    <?php
    require APPROOT . '/views/inc/dashboard_footer.php';
    ?>
