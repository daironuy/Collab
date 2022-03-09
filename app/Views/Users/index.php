<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>

<div class="pt-2">
    <div class="intro-y box">
        <div class="flex flex-col items-center p-5 border-b border-slate-200/60">
            <h2 class="font-medium text-base mr-auto">User List</h2>
        </div>
        <div class="p-5" id="head-options-table">
            <div class="preview" style="display: block;">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead class="table-dark bg-primary-900 text-white">
                        <tr>
                            <th class="whitespace-nowrap">ID</th>
                            <th class="whitespace-nowrap">Email</th>
                            <th class="whitespace-nowrap">First Name</th>
                            <th class="whitespace-nowrap">Middle Name</th>
                            <th class="whitespace-nowrap">Last Name</th>
                            <th class="whitespace-nowrap">Department</th>
                            <th class="whitespace-nowrap">Position</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user) { ?>
                            <tr class="hover:bg-primary-100">
                                <td><?= $user['id'] ?></td>
                                <td><?= $user['email'] ?></td>
                                <td><?= $user['first_name'] ?></td>
                                <td><?= $user['middle_name'] ?></td>
                                <td><?= $user['last_name'] ?></td>
                                <td><?= $user['department_name'] ?></td>
                                <td><?= $user['position_name'] ?></td>
                                <td class="flex gap-2">
                                    <?php if (!$user['is_active']) { ?>
                                        <a href="/users/activate/1/<?= $user['id'] ?>"
                                           class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                            Activate
                                        </a>
                                    <?php } else { ?>
                                        <a href="/users/activate/0/<?= $user['id'] ?>"
                                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">
                                            Deactivate
                                        </a>
                                    <?php } ?>

                                    <!--  -->
                                    <a href="#"
                                       class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                       onclick="linkConfirm('Are you sure you want to delete <?= $user['email'] ?>', '/users/delete/<?= $user['id'] ?>')"
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
<?= $this->endSection() ?>

