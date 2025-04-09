<?php


class Section {
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }
    public function getListOfSections()
    {
        $query = 'Select * from section ';
        $response = $this->db->query($query);
        return $response->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getListOfStudentsBySection($section){
        $query ='SELECT St.id ,St.name , St.birthday ,St.image 
                FROM Student St , Section Se where Se.designation=:section and St.sectionId == Se.id  ';
        $response = $this->db->prepare($query);
        $response->execute(['section' => $section]);
        $students = $response->fetchAll(PDO::FETCH_ASSOC);
        return $students;
    }


    

    
};