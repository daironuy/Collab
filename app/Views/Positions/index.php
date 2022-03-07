<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
    <div class="pt-2">
        <div class="intro-y box xl:w-4/6">
            <div class="flex items-center p-5 border-b border-slate-200/60">
                <h2 class="font-medium text-base mr-auto">Position List</h2>
                <!--                <button-->
                <!--                   class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded"-->
                <!--                        type="button" data-toggle="modal" data-target="#exampleModal"-->
                <!--                >-->
                <!--                    New-->
                <!--                </button>-->
                <a href="javascript:;" data-toggle="modal" data-target="#new_form"
                   class="button inline-block bg-green-500 text-white">
                    New
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
                                <th class="whitespace-nowrap">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($positions as $position){ ?>
                                <tr class="hover:bg-primary-100">
                                    <td><?= $position['id'] ?></td>
                                    <td><?= $position['name'] ?></td>
                                    <td>
                                        <a href="#"
                                           class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                           onclick="linkConfirm('Are you sure you want to delete <?= $position['name'] ?>', '/positions/delete/<?= $position['id'] ?>')"
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
            <form action="/positions/new" method="post">
                <div class="flex items-center px-5 py-5 sm:py-3 border-b border-gray-200">
                    <h2 class="font-medium text-base mr-auto">New Position</h2>
                </div>
                <div class="p-5 grid grid-cols-12 gap-4 row-gap-3">
                    <div class="col-span-12">
                        <label>Name</label>
                        <input name="name" type="text" class="input w-full border mt-2 flex-1">
                    </div>
                </div>
                <div class="px-5 py-3 text-right border-t border-gray-200">
                    <button type="button" data-dismiss="modal" class="button w-20 border text-gray-700 mr-1">Cancel
                    </button>
                    <button type="submit" class="button w-20 bg-green-500 text-white">Save</button>
                </div>
            </form>
        </div>
    </div>
<?= $this->endSection() ?>