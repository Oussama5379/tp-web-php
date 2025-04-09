<?php 
class Etudiant{
    private $nom;
    private $notes;
    public function __construct($nom,$notes){
        $this->nom=$nom;
        $this->notes=$notes;

    }
    public function afficherNotes(){
        echo "les notes de " .$this->nom . ": ";
        foreach($this->notes as $note){
            echo $note . " ";
        }
        echo "<br>";
    }
    public function calculerMoyenne() {
        $somme = array_sum($this->notes);  
        $moyenne = $somme / count($this->notes);  
        return $moyenne;
    }

    public function afficherStatut() {
        $moyenne = $this->calculerMoyenne();  
        if ($moyenne >= 10) {
            echo $this->nom . " est admis avec une moyenne de " . $moyenne . "<br>";
        } else {
            echo $this->nom . " n'est pas admis avec une moyenne de " . $moyenne . "<br>";
        }
    }
}
?>


