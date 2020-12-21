<nav class="navbar sticky-top navbar-expand-md navbar-dark bg-dark scrolling-navbar ">
    <div class="container-md">
        <a class="navbar-brand" href="index.php">Notekita</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sticky-nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" justify-content-end  collapse navbar-collapse pt-sm-2 pt-md-0" id="sticky-nav">
            <ul class=" navbar-nav mr-4">
                <?php if(isset($_SESSION['id_pengguna'])): ?>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" aria-current="page" href="index.php">Home</a>
                </li>
                <?php endif ?>
                <?php if(isset($_SESSION['level'])): ?>
                    <?php if($_SESSION['level'] == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link active px-1 mx-1" aria-current="page" href="admin-contact.php">Lihat Pesan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-1 mx-1" aria-current="page" href="admin-user.php">Manajemen User</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link active px-1 mx-1" aria-current="page" href="contact.php">Contact us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active px-1 mx-1" aria-current="page" href="about.php">About</a>
                        </li>
                    <?php endif ?>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link active px-1 mx-1" aria-current="page" href="contact.php">Contact us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active px-1 mx-1" aria-current="page" href="about.php">About</a>
                    </li>
                <?php endif ?>
                <?php if(isset($_SESSION['id_pengguna'])): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white px-1 mx-1" href="#" id="navbarDarkDropdownMenuLink" role="button" data-toggle="dropdown" aria-expanded="false">
                    Akun
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark " aria-labelledby="navbarDarkDropdownMenuLink">
                        <li><a class="dropdown-item" href="account.php">Setting Akun</a></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link active px-1 mx-1" aria-current="page" href="login.php">Log In</a>
                </li>
                <?php endif ?>
            </ul>
            <?php if(isset($_SESSION['id_pengguna'])): ?>
                <?php if($_SESSION['level'] != 'admin'): ?>
                    <form class="d-flex align-items-center order-sm-1 order-md-2 pt-sm-2 pt-md-0" action="search.php" method="GET">
                        <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search-note">
                        <input class="btn btn-outline-success" type="submit" name="submit" value="Submit">
                    </form>
                <?php endif ?>
            <?php endif ?>
        </div>
    </div>
</nav>



