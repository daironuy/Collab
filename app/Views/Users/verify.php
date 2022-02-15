<!doctype html>
<html lang="en" class="bg-white">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

    <title>Verify Login</title>
</head>
<body class="p-0">

<div class="container h-screen flex flex-col justify-center">
    <div class="px-5">
        <div class="bg-white w-full sm:w-3/4 md:w-2/3 lg:w-1/2 xl:w-1/3 mx-auto p-5 border-solid border-2 shadow-md rounded-lg

">
            <form method="post" class="flex flex-col">
                <h2 class="intro-x font-bold text-3xl text-center">
                    Verify Login <small><?= session()->get('auth')['email'] ?></small>
                </h2>
                <div class="intro-x mt-8">
                    <input type="text" name="security_key" class="w-full intro-x login__input input input--lg border border-gray-300 block"
                           placeholder="Security Key">
                </div>

                <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left flex justify-center ">
                    <a href="/users/logout" class="button button--lg w-full xl:w-32 text-white text-gray-700 border border-gray-300 xl:mr-3 align-top">
                        Logout
                    </a>
                    <button type="submit" class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3 align-top">
                        Continue
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e4ad29514.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
<script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        <?php if(session()->getFlashdata('error')): ?>
        toastr.error('<?= session()->getFlashdata('error') ?>');
        <?php endif; ?>
    });
</script>
</body>
</html>