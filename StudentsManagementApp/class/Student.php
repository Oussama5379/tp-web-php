<?php


class Student {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function  getStudentById( $id){
        $query ='SELECT St.id ,St.name , St.birthday ,St.image ,Se.designation as section
                FROM Student St , Section Se where  St.sectionId = Se.id and St.id=:stId  ';
        $response = $this->db->prepare($query);
        $response->execute(['stId' => $id]);
        $student = $response->fetch(PDO::FETCH_ASSOC);
        return $student;
    }
    public function getAllStudents(){
        $query ='SELECT St.id ,St.name , St.birthday ,St.image ,Se.designation as section
                FROM Student St , Section Se where St.sectionId = Se.id  ';
        $response = $this->db->query($query);
        $students = $response->fetchAll(PDO::FETCH_ASSOC);
        return $students;

    }
    
};