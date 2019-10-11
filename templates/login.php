<!DOCTYPE html>
<html>
    <head>
        <?php require_once('_head.php'); ?>
        <title><?= APPNAME ?> - Authentication page</title>
    </head>
    <body>

        <?php require_once("_nav.php"); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-lg-4 offset-md-4">
                    <h3 class="text-center">Sign in</h3>
                    <?php if($this->get("msg") === '404'): ?>
                    <div class="col-lg-12">
                      <p class="text-center text-danger">The account does not exist.</p>
                    </div>
                    <?php elseif($this->get("msg") === '403'): ?>
                    <div class="col-lg-12">
                      <p class="text-center text-danger">The email/password combination is not valid.</p>
                    </div>
                    <?php elseif($this->get("msg") === 'offline'): ?>
                    <p class='text-center text-danger'>Failed to log in, the database is unavailable.</p>
                    <?php endif; ?>
                    <form action="/log-in" method="POST">
                      <div class="form-group">
                        <label for="emailInput">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email" required>
                      </div>
                      <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password" required>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Sign in</button>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once("_scripts.php"); ?>
    </body>
</html>