<?php
namespace PHPSailors\Services;
use PHPSailors\Core\Service;
use PHPSailors\Core\Database;
use PDO;

class MainService extends Service{
    const ACTIVE = "active";
    const INACTIVE = "inactive";

    public function __construct()
    {
           
    }


    public function registerUser($email, $password){
        try{
            $dateTimeNow = date("Y-m-d H:m:i");
            $default_user_role = 1;
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query="SELECT COUNT(id_user) FROM `user` WHERE email=?";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([ $email ]);
            $existentAccount = $stmt->fetchColumn();

            if($existentAccount > 0){
                return 409;
                exit;
            }

            $query = "INSERT INTO `user`(email, password, id_role, status, last_modified_at, created_at) VALUES(?,?,?,?,?,?);";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([ $email, $password, $default_user_role, MainService::ACTIVE, $dateTimeNow, $dateTimeNow ]);
            return 200;

        } catch(\Exception $e){
            error_log($e);
            return 500;
            exit;
        }

    }

    public function deleteUser($email){
        $query="DELETE FROM `user` WHERE email=?";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([ $email ]);
    }

    public function login($email, $password){
        $query="SELECT u.id_user, u.password, r.role as role FROM `user` u INNER JOIN `role` r ON u.id_role = r.id_role WHERE u.email=?";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([ $email ]);
        $user = $stmt->fetchObject();
        $response = (Object)[
            "response_code" => "",
            "role" => "",
            "id_user" => ""
        ];

        if(false === $user->password){
            $response->response_code = 404;
            return $response;
            exit;
        }

        if(password_verify($password, $user->password)){
            $response->response_code = 200;
            $response->role = $user->role;
            $response->id_user = $user->id_user;
            return $response;
            exit;
        } else {
            $response->response_code = 403;
            return $response;
            exit;
        }

    }

    function getAuthToken($id_user){
        $query="SELECT `auth_token` FROM `user` WHERE `id_user`=?";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([ $id_user ]);
        $auth_token_db = $stmt->fetchColumn();
        $response = (Object)[
            'response_code' => "",
            'auth_token_db' => ""
        ];
        if(false === $auth_token_db){
            $response->response_code = 403;
        } else {
            $response->response_code = 200;
            $response->auth_token_db = $auth_token_db;
        }

        return $response;
    }

    function logout($id_user, $auth_token){
        $query="UPDATE `user` SET `auth_token` = ? WHERE `id_user`=? && auth_token=?";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->execute([ '', $id_user, $auth_token ]);
    }

    function random_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}