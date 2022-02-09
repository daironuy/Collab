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
                            <div class="font-medium">John Travolta</div>
                            <div class="text-xs text-theme-41 dark:text-gray-600">DevOps Engineer</div>
                        </div>
                        <div class="p-2">
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                        </div>
                        <div class="p-2 border-t border-theme-40 dark:border-dark-3">
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 dark:hover:bg-dark-3 rounded-md">
                                <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
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
<script src="https://kit.fontawesome.com/1e4ad29514.js" crossorigin="anonymous"></script>
<!-- END: JS Assets-->
</body>
</html>