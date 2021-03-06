<?php
namespace PHPSailors\Services;
use PHPSailors\Core\Service;
use PHPSailors\Core\Database;
use PDO;

class MainService extends Service{
    const ACTIVE = "active";
    const INACTIVE = "inactive";

    public function __construct(){
           
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
        try{
            $query="DELETE FROM `user` WHERE email=?";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([ $email ]);
            return 200;
        } catch(\Exception $e){
            error_log($e);
            return 500;
            exit;
        }
    }

    public function login($email, $password){
        try{
            $query="SELECT u.first_name, u.last_name, u.id_user, u.password, r.role as role FROM `user` u INNER JOIN `role` r ON u.id_role = r.id_role WHERE u.email=?";
            $stmt = $this->getConnection()->prepare($query);
            $stmt->execute([ $email ]);
            $user = $stmt->fetchObject();

            $response = (Object)[
                "id_user" => "",
                "role" => "",
                "response_code" => ""
            ];

            if(false === $user){
                $response->response_code = 404;
            } else {
                if(password_verify($password, $user->password)){
                    $response->id_user = $user->id_user;
                    $response->role = $user->role;
                    $response->first_name = $user->first_name;
                    $response->last_name = $user->last_name;
                    $response->response_code = 200;
                } else {
                    $response->response_code = 403;
                }
            }

            return $response;
            exit;

        } catch(\Exception $e){
            error_log($e);
            return 500;
            exit;
        }

    }

    function random_code($limit){
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}