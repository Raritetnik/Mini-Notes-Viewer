<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>
<body>
    <?php require_once("bd_notes.php"); ?>
    <div class="block">
    <form method="get">
        <h3>Selectionner le groupe: <select name="groupe" id="groupe">
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g1" ) ?
            "<option value='g1' selected>Groupe 1</option>": "<option value='g1'>Groupe 1</option>"; ?>
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g2" ) ?
            "<option value='g2' selected>Groupe 2</option>": "<option value='g2'>Groupe 2</option>"; ?>
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "all" ) ?
            "<option value='all' selected>Les deux groupes</option>": "<option value='all'>Les deux groupes</option>"; ?>
        </select></h3>

        <h3><?php echo (isset($_GET['enEchec'])) ? "<input type='checkbox' name='enEchec' value='1' checked>":
        "<input type='checkbox' name='enEchec' value='1'>";?>
        <label for="enEchec">Afficher seulement les élèves en échec</label><br></h3>

        <h3>Selectionner les sexes des étudiants:
        <?php echo (isset($_GET['sexM'])) ? "<input type='checkbox' name='sexM' value='M' checked>":
        "<input type='checkbox' name='sexM' value='M'>";?>
        <label for="sexM">Les hommes</label>
        <?php echo (isset($_GET['sexF'])) ? "<input type='checkbox' name='sexF' value='F' checked>":
        "<input type='checkbox' name='sexF' value='F'>";?>
        <label for="sexF">Les femmes</label><br></h3>
        <input class='btn' type="submit" value="Soumettre">
    </form>
    </div>
    <?php
    if(isset($_GET['groupe'])) {
        /**
         * Reception et gestion de groupes
         */
        $groupe = $_GET['groupe'];
        $notes = filtreGroupe($groupe);
        /**
         * Reception de filtre sur le sexe de l'etudiant
         */
        if(isset($_GET['sexF']) && isset($_GET['sexM'])){
            $sex = "MF";
        } else if(isset($_GET['sexM'])) {
            $sex = $_GET['sexM'];
        } else if(isset($_GET['sexF'])) {
            $sex = $_GET['sexF'];
        } else {
            $sex = "";
        }
        /**
         * Reception d'affichage ceux qui ont échoués ou non
         */
        if(isset($_GET['enEchec'])) {
            $enEchec = $_GET['enEchec'];
        } else {
            $enEchec = 0;
        }
        /**
         *  Filtre sur le sex demandé homme / femme / tout / rien
        */
        $notes = filtreSex($sex, $notes);
        /**
         *  Filtre sur le sur les etudiant qui echouent
        */
        $notes = filtreEchec($enEchec, $notes);
        /**
         * Affichage des résultats
         */
        $somme=0;
        if(!empty($notes)){
            echo "<table class='tableNF'><tr>
            <th>Nom</th>
            <th>Sex</th>
            <th>Note Final</th>
            </tr>";

            foreach($notes as $etudiant){
                echo "<tr>";
                $noteFinale = ($etudiant[4]*0.15) + ($etudiant[5]*0.35) + ($etudiant[6]*0.50);
                $somme += $noteFinale;
                echo "<td>".$etudiant[0]." ".$etudiant[1]."</td>
                <td>".$etudiant[2]."</td>
                <td>$noteFinale%</td>";
                echo "</tr>";
            }
            $moyenne = $somme/count($notes);
            echo "<tr><td colspan='3'><b>La moyenne du groupe est ".number_format($moyenne,2)."%</b></td></tr>";
            echo "</table>";
        } else {
            echo "<h3>Aucune élève a été trouvé.</h3>";
        }
    }
    ?>
</body>
</html>