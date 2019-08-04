<!DOCTYPE html>
<html>
    <head>
        <?php require_once('_head.php'); ?>
        <title>PHPSailors - Index page</title>
    </head>
    <body>

        <?php require_once("_nav.php"); ?>

        <div class="container my-5">
            <div class="row">
                <div class="col-lg-8 offset-md-2">
                    <h3 class="text-center">Greetings sailor,</h3>
                    <p class="text-center">
                        I've created this application with one purpose in mind: <br/><br/>

                        Have a plug and play application that includes all the components, file/folder structures, 
                        initial configurations and basic functionality that a C.R.U.D application in vanilla PHP 
                        might need. <br/><br/>

                        Using frameworks like Laravel or Symfony is much better in some scenarios, but when not 
                        using any frameworks for whatever reasons, there is still a need for a proper architecture of the application.
                        Writing it from scratch everytime can be tedious and frankly a waste of time. <br/><br/>

                        Head off to documentation to find out what it contains and how to get started or feel free to explore.
                    </p>
                    <p class="text-left"><u>Useful links:</u></p>
                    <ul>
                        <li><i class="fab fa-github"></i> GitHub: <a href="https://github.com/1istbesser/PHPSailors"> github.com/1istbesser/PHPSailors</a></li>
                        <li><i class="fas fa-book"></i> Documentation: <a href="https://github.com/1istbesser/PHPSailors/blob/master/README.md">github.com/1istbesser/PHPSailors/blob/master/README.md</a></li>
                        <li><i class="fas fa-id-badge"></i> License: <a href="https://github.com/1istbesser/PHPSailors/blob/master/.gitignore">github.com/1istbesser/PHPSailors/blob/master/LICENSE.txt</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <?php require_once("_scripts.php"); ?>
    </body>
</html>