<?php
namespace PHPSailors\Config;

/* 
Duplicate the file, fill in your database connection details 
and remove the "_template" part of the filename.
*/

class DatabaseConfig{
    private  $host             = 'host';
    private  $db               = 'database';
    private  $user             = 'user';
    private  $password         = 'password';

    public function __construct(){}
        
    public  function getHost(){
        return $this->host;
    }
    public  function getDB(){
        return $this->db;
    }
    public  function getUser(){
        return $this->user;
    }
    public  function getPassword(){
        return $this->password;
    }
}