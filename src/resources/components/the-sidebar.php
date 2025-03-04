<?php

$auth = getSessionValue("auth") ?? [];
["photo" => $photo, "last_name" => $lastName, "first_name" => $firstName] = $auth + ["photo" => null, "last_name" => null, "first_name" => null];

$photo = !empty($photo) ? $photo : "default.jpg";
$lastName = !empty($lastName) ? $lastName : "vahiny";
$firstName = !empty($firstName) ? $firstName : "vahiny";
?>


<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="#" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">JFDS</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="<?= pubUrl("assets".DIRECTORY_SEPARATOR. $photo) ?>" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?= $firstName ?></h6>
                <span><?= $lastName ?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="<?= path("/home") ?>" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Fandraisana</a>
            <a href="<?= path("/calendars") ?>" class="nav-item nav-link">
                <i class="fa fa-th me-2"></i>Tetiandro
            </a>
            <a href="<?= path("/statistics") ?>" class="nav-item nav-link">
                <i class="fa fa-chart-bar me-2"></i>Antontan'isa
            </a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Famoronana</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?= path("/regions") ?>" class="dropdown-item nav-item nav-link">Faritra</a>
                    <a href="<?= path("/committees") ?>" class="dropdown-item nav-item nav-link">Vaomieran’asa</a>
                    <a href="<?= path("/associations") ?>" class="dropdown-item nav-item nav-link">Fikambanana Masina</a>
                    <a href="<?= path("/responsibilities") ?>" class="dropdown-item nav-item nav-link">Andraikitra</a>
                    <a href="<?= path("/sacraments") ?>" class="dropdown-item nav-item nav-link">Sakramenta</a>
                    <a href="<?= path("/events") ?>" class="dropdown-item nav-item nav-link">Hetsika</a>
                </div>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Herivelona</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Mpikambana</a>
                    <a href="<?= path("/members") ?>" class="dropdown-item nav-item nav-link">Fikambanana</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Administratera</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Filohan’ny Fikambanana Masina sy Filohan’ny Vaomieran’asa</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Filohan’ny Faritra</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Sakramenta</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Fitadiavam-bola</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Famoronana Fitadiavam-bola</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Bilieta</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Fanamarihana</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Fizarana</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Vokatra</a>
                </div>
            </div>
            <a href="#" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Hetsika</a>
            <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Fahatongavana</a>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Tantara</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Filohan’ny Faritra</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Filohan’ny Fikambanana Masina</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Filohan’ny Vaomieran’asa</a>
                    <a href="<?= path("/users") ?>" class="dropdown-item nav-item nav-link">Administratera</a>
                </div>
            </div>

            <a href="#" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Fikarohana</a>
        </div>
    </nav>
</div>
