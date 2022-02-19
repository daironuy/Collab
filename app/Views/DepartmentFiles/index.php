<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <div class="pt-2">
        <div class="intro-y box xl:w-4/6">
            <div class="flex items-center p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base mr-auto">Department Files</h2>
                <a href="javascript:;" data-toggle="modal" data-target="#new_form"
                   class="button inline-block bg-green-500 text-white">
                    Upload
                </a>
            </div>
            <div class="p-5" id="head-options-table">
                <div class="preview" style="display: block;">
                    <div class="overflow-x-auto">
                        <table class="table">
                            <thead class="table-dark bg-primary-900 text-white">
                            <tr>
                                <th class="whitespace-nowrap">ID</th>
                                <th class="whitespace-nowrap">Name</th>
                                <th class="whitespace-nowrap">File Size</th>
                                <th class="whitespace-nowrap">Upload By</th>
                                <th class="whitespace-nowrap">Upload Date</th>
                                <th class="whitespace-nowrap">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($files as $file) { ?>
                                <tr class="hover:bg-primary-100">
                                    <td><?= $file['id'] ?></td>
                                    <td><?= $file['file_name'] ?></td>
                                    <td><?= $file['file_size'] ?></td>
                                    <td><?= $file['first_name'] . ' ' . $file['last_name'] ?></td>
                                    <td><?= date_format(date_create($file['created_at']), "Y/m/d h:i:s A") ?></td>
                                    <td class="flex gap-2">
                                        <a href="#"
                                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded"
                                           target="_blank"
                                        >
                                            Download
                                        </a>

                                        <a href="#"
                                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                           onclick="linkConfirm('Are you sure you want to delete <?= $file['file_name'] ?>', '/departmentFiles/delete/<?= $file['id'] ?>')"
                                        >
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="new_form">
        <div class="modal__content">
            <form action="/departmentFiles/upload" method="post" enctype="multipart/form-data">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">Upload a file</h2>
                </div>
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Select file to upload</label>
                        <input name="file" type="file" class="input w-full border mt-2 flex-1">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel
                    </button>
                    <button type="submit" class="button w-20 bg-green-500 text-white">Upload</button>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>