<nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
            aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="#">
            <img src="https://d13jio720g7qcs.cloudfront.net/images/destinations/origin/5f8ffb05bc197.jpg" height="25"
                alt="" loading="lazy" /> Fresh Fruit 24hours Boyolali
        </a>


        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
            <!-- Avatar -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                    id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo $profile_picture; ?>" class="rounded-circle" height="22" alt=""
                        loading="lazy" /> &nbsp Selamat Datang,<b>&nbsp
                        <?php echo $username; ?>!</b>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="my-profile.php">My profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>

</nav>