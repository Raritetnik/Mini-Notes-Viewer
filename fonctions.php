<?php
    /**
     * La base de données avec les tableaux des étudiants
     * array(
     * [0] le prénom,
     * [1] le nom,
     * [2] le sexe,
     * [3] l’âge,
     * [4] la note au TP1,
     * [5] la note au TP2,
     * [6] la note à l’examen final);
     */
    class BD {
        public $NotesGroupe1 = array(
            "HARG200181" => array("Guillaume", "Harvey", "M", 36, 90, 70, 76),
            "CHAM010283" => array("Marc-André", "Charpentier", "M", 34, 80, 73, 96),
            "TREV290991" => array("Valérie", "Tremblay", "F", 26, 70, 71, 69),
            "PELL180584" => array("Laurence", "Pelletier", "F", 30, 65, 89, 76),
            "MALF110194" => array("Francis", "Maltais", "M", 20, 61, 50, 59),
            "GAUM220654" => array("Martine", "Gauthier", "F", 60, 65, 40, 76)
        );

        public $NotesGroupe2 = array(
            "GIRM230383" => array("Marc-Olivier", "Girard", "M", 31, 75, 85, 56),
            "TREM300878" => array("Michel", "Tremblay", "M", 36, 50, 50, 55),
            "POID250468" => array("Diane", "Poitras", "F", 46, 61, 75, 59),
            "LEML180586" => array("Laurence", "Lemieux", "F", 31, 80, 89, 100),
            "VANL130395" => array("Jeff", "Van Cleef", "M", 19, 61, 68, 33)
        );
    }

    /**=========================================================
     * =================   Les fonctions  ======================
     * =========================================================*/

    /**
     * Reçoit en paramètre le groupe demandé et retourne le tableau nécessaire
     */
    function filtreGroupe($groupe) {
        $bd = new BD();
        if($groupe == "g1") {   // Groupe 1 seulement
            return $bd->NotesGroupe1;
        } else if ($groupe == "g2") { // Groupe 2 seulement
            return $bd->NotesGroupe2;
        } else { // Les deux groupes
            $notes = array_merge($bd->NotesGroupe1, $bd->NotesGroupe2);
            return $notes;
        }
    }

    /**
     * Reçoit en paramètre le sex des étudiants et retourne un nouveau tableau sans lui
     */
    function filtreSex($sex, $notes) {
        if(empty($notes)){
            return null;
        }
        $notesFiltre = null;
        if($sex == "F" || $sex == "M"){
            foreach($notes as $etudiant) {
                if($sex == $etudiant[2]){
                    $notesFiltre[] = $etudiant;
                }
            }
        } else if ($sex == "MF"){
            $notesFiltre = $notes;
        }
        return $notesFiltre;
    }

    /**
     * Reçoit en s'il faut afficher seulement les étudiant en échec et retourne le tableau
     */
    function filtreEchec($echec, $notes) {
        if(empty($notes)){
            return null;
        }
        $notesFiltre = null;
        foreach($notes as $etudiant){
            $notesFinale = ($etudiant[4]*0.15) + ($etudiant[5]*0.35) + ($etudiant[6]*0.50);
            if($echec && $notesFinale < 60){
                $notesFiltre[] = $etudiant;
            } else if(!$echec) {
                $notesFiltre[] = $etudiant;
            }
        }
        return $notesFiltre;
    }

?>
