<?= $this->extend('layouts/default') ?>

<?php
function getMessage()
{
    $time = date("H");
    if ($time < "12") {
        echo "Good morning";
    } else
        if ($time >= "12" && $time < "17") {
            echo "Good afternoon";
        } else
            if ($time >= "17" && $time < "19") {
                echo "Good evening";
            } else
                if ($time >= "19") {
                    echo "Good night";
                }
}



?>

<?= $this->section('content') ?>
    <div class="pt-2">
        <div class="text-xl font-bold"><?= getMessage() . ' ' . $auth['first_name']; ?> !</div>
    </div>
<?= $this->endSection() ?>