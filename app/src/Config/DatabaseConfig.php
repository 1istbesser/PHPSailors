<?php
namespace PHPSailors\Config;

class DatabaseConfig{
    private  $host             = 'localhost';
    private  $db               = 'database';
    private  $user             = 'root';
    private  $password         = '';

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