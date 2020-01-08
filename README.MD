# PHPSailors

## Description
<p>
  I created this project to cut down on the time spent coding when I'm building an app without using a framework, therefore,it's a bootstrapping application. It helps by providing all the core functionality of a modern web app while still having a vanilla PHP codebase. It has fewer dependencies and more ﬂexibility than a framework. I use it as a base for each application built on top of it and further developed into a more custom solution. <br/>
  
  I'm constantly looking to improve it and it has become a great tool for me to learn more about frameworks, what and how they do things, what problems are out there with apps built from scratch, what are the standards and get in touch with many more areas while working on it.
</p>

## TO DO
<ul>
  <li>Create a few versions equiped for different needs to further cut through the redundant coding in different scenarious: building an API, simple presentation website, multilanguage app, token based auth ~ right now it comes with a basic admin panel and a simple authentication/register system based on sessions</li>
  <li>Add an ORM?</li>
  <li>Add an interface for throables</li>
</ul>

## Requirements
<ul>
  <li>PHP version 7.0+</li>
  <li>A database created and ready to be used</li>
  <li>A webserver configured to point to <b>/public_html</b> as the public directory of the application</li>
  <li>Support for htaccess (Optional - you can implement your own solution to redirect all requests to the front end controller <b>/public_html/index.php</b>)</li>
  <li>The error log directives configured to point to <b>/logs/</b>(Optional)</li>
</ul>

## Installation
<ul>
  <li>Clone the repo by running: <b>git clone https://github.com/1istbesser/PHPSailors.git .</b> inside your project's folder from a terminal</li>
  <li>Install the dependencies with composer by running: <b>composer install</b> inside your project's root folder from a terminal</li>
  <li>Duplicate the <b>/src/Config/DatabaseConfig_template.php</b>, rename it to <b>DatabaseConfig.php</b> and edit the database connection details.</li>
  <li>Run the install script which will populate your database with the tables: user, role, authentication_log and will create an account for you that will be shown in your browser once the script is done</li>
  <li>Note down the admin account, delete the <b>/public_html/install</b> folder and change the name of your application from <b>/public_html/index.php</b> by changing the following line <b>define('APPNAME', "PHPSailors");</b> where PHPSailors is the name of your application</li>
  <li>Make sure your domain is pointing to <b>/public_html</b> directory as its public folder</li>
</ul>

## Components and libraries included
<ul>
  <li>Composer - dependency manager for PHP, documentation <a href="https://getcomposer.org/doc/">here</a></li>
  <li>PSR-4 Autoloader - a specification for autoloading classes from file paths, documentation <a href="https://www.php-fig.org/psr/psr-4/">here</a></li>
  <li>Symfony / Routing - symfony component that maps an HTTP request to a set of configuration variables used to associate URLs to some code to execute (controllers in our case), documentation <a href="https://symfony.com/doc/current/components/routing.html">here</a></li>
  <li>PHPUnit - unit testing framework, documentation <a href="https://phpunit.readthedocs.io/en/8.5/">here</a></li>
  <li>PHPMailer - fully-featured email creation/transfer library, documentation <a href="https://github.com/PHPMailer/PHPMailer">here</a></li>

</ul>

## Tests
<p> Running tests from the terminal:</p>

<p> Specific test: <br/>
app\vendor\bin\phpunit --bootstrap ./app/vendor/autoload.php ./tests/UserTest
</p>
<p>
All tests: <br/>
app\vendor\bin\phpunit --bootstrap ./app/vendor/autoload.php ./tests/
</p>
