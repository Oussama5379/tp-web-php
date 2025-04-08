<?php


class User {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getPassword($username){
        $query = 'SELECT password FROM user WHERE username = :username';
        $response = $this->db->prepare($query);
        $response->execute(['username' => $username]);
        $pass = $response->fetch(PDO::FETCH_ASSOC);
        if($pass){
            return $pass['password'];
        }else{
            return "" ;
        }
        
    }
    public function isUserExist($username){
        $query = 'SELECT * FROM user WHERE username = :username';
        $response = $this->db->prepare($query);
        $response->execute(['username' => $username]);
        $user = $response->fetch(PDO::FETCH_ASSOC);

        return $user;
        
    }

    
};