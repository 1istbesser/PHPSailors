<nav class="navbar navbar-expand-lg navbar-dark bg-blue">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">PHPSailors</a>

    <div class="collapse navbar-collapse" id="navbarToggler">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <!-- <li class="nav-item ">
                <a class="nav-link" href="/categorii">Categorii </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/produse">Produse </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="/seteaza-categorii">Seteaza categorii </a>
            </li>  -->
        </ul>
        <ul class="navbar-nav mr-5">
            <?php if (!isset($_SESSION['user'])): ?>
            <li class="nav-item dropdown mr-5">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Join
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/register">Register</a>
                <a class="dropdown-item" href="/login">Log in</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/contact">Contact</a>
                </div>
            </li>
            <?php else: ?>

            <li class="nav-item dropdown mr-5">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My account
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/dashboard">Dashboard</a>
                    <?php if ($_SESSION['group'] === "superadmin"): ?>
                    <a class="dropdown-item" href="/admin">Admin panel</a>
                    <?php endif;?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/logout">Log out </a>
                </div>
            </li>
            <?php endif;?>
        </ul>
    </div>
</nav>