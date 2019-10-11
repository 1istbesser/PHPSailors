<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="/"><?= APPNAME ?> | </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMainMenu" aria-controls="navbarMainMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarMainMenu">
    <div class="navbar-nav">
      <a class="nav-item nav-link active" href="/">Home <span class="sr-only">(current)</span></a>
    </div>
    <div class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="myAccountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            My account
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="myAccountDropdown">
                <a class="dropdown-item" href="/admin">Dashboard</a>
                <a class="dropdown-item" href="/log-out">Log out</a>
            </div>
        </li>
    </div>
  </div>
</nav>