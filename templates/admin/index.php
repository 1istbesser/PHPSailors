<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= APPNAME ?> - Admin dashboard</title>

  <?php require_once("_head.php"); ?>

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <nav id="sidebar">
      <div class="sticky">
        <div class="sidebar-header">
            <h3 class="text-center"><a href="/admin"><?= APPNAME ?></a></h3>
        </div>
        <ul class="list-unstyled">
            <p>Dummy Heading</p>
            <li class="active">
                <a href="#menu-item">Dashboard</a>
            </li>
            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Submenu</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                  <li>
                      <a href="#submenu-item">Submenu item</a>
                  </li>
                </ul>
            </li>
            <li>
                <a href="#menu-item">Menu item 1</a>
            </li>
            <li>
                <a href="#menu-item">Menu item 2</a>
            </li>
            <li>
                <a href="#menu-item">Menu item 3</a>
            </li>
            
        </ul>
      </div>
    </nav>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <button type="button" id="sidebarCollapse" class="btn btn-info">
              <i class="fas fa-align-left"></i>
              <span>Sidebar</span>
          </button>
          <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-align-justify"></i>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/admin"><?= $this->get("firstName") . " ". $this->get("lastName") ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/log-out">Log out</a>
                    </li>
                </ul>
            </div>
        </div>
      </nav>

      <div class="container-fluid">
        <h1 class="mt-4">Simple Admin Panel</h1>
        <p>
          Here you have a basic layout for the admin panel and an authentication system
          kept simple that lets you in and out of the restricted area.
          <br/>
          Use this as a starting point to build something awesome.</p>
       
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <?php require_once("_scripts.php"); ?>

</body>

</html>
