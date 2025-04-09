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
    public function editStudent($id,$name,$birthday,$section) {
        $query="UPDATE student
            SET name = :name, birthday = :birthday, sectionId=:section
                WHERE id=:id";
        $response = $this->db->prepare($query);
        $response->execute(['name'=>$name,'birthday'=>$birthday,'section'=>$section,'id' => $id]);

    }
    public function addStudent($id,$name,$birthday,$section,$image){
        $query="INSERT INTO student (name, birthday, image, sectionId) VALUES ( :name, :birthday, :image, :section);";
        $response = $this->db->prepare($query);
        $response->execute(['name'=>$name,'birthday'=>$birthday,'section'=>$section,'image' => $image]);

    }
    public function editSection($id,$designation,$description){
        $query="UPDATE section
            SET designation = :designation, description = :description
                WHERE id=:id";
        $response = $this->db->prepare($query);
        $response->execute(['designation'=>$designation,'description'=>$description,'id' => $id]);
    }
    
    
};