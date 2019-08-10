<!DOCTYPE html>
<html>
    <head>
        <?php require_once('_head.php'); ?>
        <title>PHPSailors - Authentication page</title>
    </head>
    <body>

        <?php require_once("_nav.php"); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-lg-8 offset-md-2">
                    <h3 class="text-center">Sing in</h3>
                    <form action="/log-in" method="POST">
                      <div class="form-group">
                        <label for="emailInput">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>
                      <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Sing in</button>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once("_scripts.php"); ?>
    </body>
</html>