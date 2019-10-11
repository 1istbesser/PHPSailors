<!DOCTYPE html>
<html>
    <head>
        <?php require_once('_head.php'); ?>
        <title><?= APPNAME ?> - Register page</title>
    </head>
    <body>

        <?php require_once("_nav.php"); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-lg-4 offset-md-4">
                    <h3 class="text-center mb-3">Create a new account</h3>
                    <?= !empty($this->get("msg")) ? $this->get("msg") : ""?>
                    <form action="/register" method="POST">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" name="email" class="form-control" id="emailInput" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                      </div>
                      <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password">
                      </div>
                      <div class="form-group form-check">
                        <input type="checkbox" name="gdprCheckbox" class="form-check-input" id="gdrpCheckbox">
                        <label class="form-check-label" for="gdrpCheckbox">I consent to the use and storage of my personal data inline with the <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                      </div>
                      <button type="submit" name="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>

        <?php require_once("_scripts.php"); ?>
    </body>
</html>