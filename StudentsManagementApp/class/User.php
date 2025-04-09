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
    public function getRole($username){
        $query = 'SELECT role FROM user WHERE username = :username';
        $response = $this->db->prepare($query);
        $response->execute(['username' => $username]);
        $role = $response->fetch(PDO::FETCH_ASSOC);
    
        return $role['role'];
        
    }
    public function deleteStudent($id){
        $query="DELETE FROM student WHERE id=:id ";
        $response = $this->db->prepare($query);
        $response->execute(['id' => $id]);

    }
    
    
};