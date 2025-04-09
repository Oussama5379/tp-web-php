<?php
class Etudiant {
    public $nom;
    public $notes;

    public function __construct($nom, $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function afficherNotes() {
        foreach ($this->notes as $note) {
            if ($note < 10) {
                $couleur = "rouge";
            } elseif ($note == 10) {
                $couleur = "orange";
            } else {
                $couleur = "vert";
            }
            echo "<div class='$couleur'>$note</div>";
        }
    }

    public function calculerMoyenne() {
        $somme = array_sum($this->notes);
        return $somme / count($this->notes);
    }

    public function estAdmis() {
        return $this->calculerMoyenne() >= 10;
    }
}
?>