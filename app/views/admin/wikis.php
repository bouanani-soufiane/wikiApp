<?php
require APPROOT . '/views/inc/dashboard.php';
if (!empty($data)) {
    if (!empty($data['wiki'])) {
        $wikis = $data['wiki'];
    }
}
?>
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
                                    <div class="text-left font-medium text-green-500"><?php echo mb_strimwidth($wiki->getContent(), 0, 300, '...');?></div>
                                </td>
                                <td class="p-2 whitespace-nowrap">
                                    <div class="text-lg text-center">
                                        <a href="">
                                            <i class="ri-archive-line text-2xl "></i>
                                        </a>
                                    </div>
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
