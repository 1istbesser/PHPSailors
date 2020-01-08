# PHPSailors

## Description

## Requirements

## Installation

<ul>
  <li>Clone the repo by running: <b>git clone https://github.com/1istbesser/PHPSailors.git .</b> inside your project's folder from a terminal</li>
  <li>Install the dependencies with composer by running: <b>composer install</b> inside your project's root folder from a terminal</li>
  <li>Duplicate the <b>/src/Config/DatabaseConfig_template.php</b>, rename it to <b>DatabaseConfig.php</b> and edit the database connection details.</li>
  <li>Run the install script which will populate your database with the tables: user, role, authentication_log and will create an account for you that will be shown in your browser once the script is done</li>
  <li>Note down the admin account, delete the <b>/public_html/install</b> folder and change the name of your application from <b>/public_html/index.php</b> by changing the following line <b>define('APPNAME', "PHPSailors");</b> where PHPSailors is the name of your application</li>
</ul>

## Components

## Tests
<p> Running tests from the terminal:</p>

<p> Specific test: <br/>
app\vendor\bin\phpunit --bootstrap ./app/vendor/autoload.php ./tests/UserTest
</p>
<p>
All tests: <br/>
app\vendor\bin\phpunit --bootstrap ./app/vendor/autoload.php ./tests/
</p>
