<?php
$auth = getSessionValue("auth") ?? [];
["photo" => $photo, "last_name" => $lastName, "first_name" => $firstName] = $auth + ["photo" => null, "last_name" => null, "first_name" => null];
$firstName = !empty($firstName) ? $firstName : "guest";
$lastName = !empty($lastName) ? $lastName : "guest";
$photo = !empty($photo) ? $photo : "default.jpg";

?>
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="<?= path("/") ?>" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="<?= pubUrl("assets".DIRECTORY_SEPARATOR.$photo) ?>" alt="" style="width: 40px; height: 40px;">
                <span class="d-none d-lg-inline-flex"><?= $firstName ." ". $lastName ?></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="<?= path("/logout") ?>" class="dropdown-item">Log Out</a>
            </div>
        </div>
    </div>
</nav>