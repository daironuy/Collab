<!DOCTYPE html>
<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSEUF Collab</title>
    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="css/app.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="app">
<div class="flex">
    <!-- BEGIN: Side Menu -->
    <nav class="side-nav">
        <a href="" class="intro-x flex items-center pl-5 pt-4">
            <img alt="Midone Tailwind HTML Admin Template" class="w-6" src="images/white-logo.png">
            <span class="hidden xl:block text-white text-lg ml-3"> MSEUF Collab </span>
        </a>
        <div class="side-nav__devider my-6"></div>
        <ul>
            <li>
                <a href="#" class="side-menu side-menu--active">
                    <div class="side-menu__icon"><i class="fa-solid fa-house"></i></div>
                    <div class="side-menu__title"> Dashboard</div>
                </a>
            </li>

            <?php if($auth['is_admin']){ ?>
            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"><i class="fa-solid fa-user"></i></div>
                    <div class="side-menu__title"> Users</div>
                </a>
            </li>
            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"><i class="fa-solid fa-building"></i></div>
                    <div class="side-menu__title"> Departments</div>
                </a>
            </li>

            <?php } else { ?>

            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"><i class="fa-solid fa-message"></i></div>
                    <div class="side-menu__title"> Messages</div>
                </a>
            </li>
            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"><i class="fa-solid fa-square-share-nodes"></i></div>
                    <div class="side-menu__title"> File Sharing</div>
                </a>
            </li>
            <li>
                <a href="#" class="side-menu">
                    <div class="side-menu__icon"><i class="fa-solid fa-box-archive"></i></div>
                    <div class="side-menu__title"> Department Files</div>
                </a>
            </li>

            <?php } ?>

        </ul>
    </nav>
    <!-- END: Side Menu -->
    <!-- BEGIN: Content -->
    <div class="content" style="min-height: calc(100vh - calc(1.25rem + 1.25rem))">
        <div class="top-bar">
            <!-- BEGIN: Breadcrumb -->
            <div class="-intro-x breadcrumb mr-auto flex">
                <a href="" class="">Application</a>
                <span class="px-1">/</span>
                <a href="" class="breadcrumb--active">Dashboard</a>
            </div>
            <!-- END: Breadcrumb -->

            <!-- BEGIN: Account Menu -->
            <div class="intro-x dropdown w-8 h-8">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                    <img alt="Midone Tailwind HTML Admin Template" src="images/logo.png">
                </div>
                <div class="dropdown-box w-56">
                    <div class="dropdown-box__content box bg-theme-38 dark:bg-dark-6 text-white">
                        <div class="p-4 border-b border-theme-40 dark:border-dark-3">
                            <div class="font-medium"><?php echo $auth['first_name'].' '.$auth['last_name'] ?></div>
                            <div class="text-xs text-theme-41 dark:text-gray-600">Department here</div>
                        </div>
                        <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i class="fa-solid fa-key w-4 h-4 mr-2"></i> Change Password </a>
                            <a href="/users/logout"
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i class="fa-solid fa-arrow-right-from-bracket w-4 h-4 mr-2"></i> Logout </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
        <!-- END: Top Bar -->
        <div class="">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    <!-- END: Content -->
</div>
<!-- BEGIN: JS Assets-->
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/1e4ad29514.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" crossorigin="anonymous"></script>
<script>
    $(function(){
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
    });
</script>
<!-- END: JS Assets-->
</body>
</html>