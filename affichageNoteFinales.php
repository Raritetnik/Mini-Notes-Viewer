<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <?php include("fonctions.php"); ?>
    <title>Document</title>
</head>

<body>
    <header class="block">
        <form method="get">
            <h3>Selectionner le Groupe</h3>
            <select name="groupe" id="groupe">
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g1" ) ?
            "<option value='g1' selected>Groupe 1</option>": "<option value='g1'>Groupe 1</option>"; ?>
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g2" ) ?
            "<option value='g2' selected>Groupe 2</option>": "<option value='g2'>Groupe 2</option>"; ?>
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "all" ) ?
            "<option value='all' selected>Les deux groupes</option>": "<option value='all'>Les deux groupes</option>"; ?>
            </select>
            <h3><?php echo (isset($_GET['enEchec'])) ? "<input class='checkbox' type='checkbox' name='enEchec' value='1' checked>":
            "<input class='checkbox' type='checkbox' name='enEchec' value='1'>";?>
            <label for="enEchec">Afficher seulement les élèves en échec</label><br></h3>
            <h3>Selectionner les sexes des étudiants:</h3>
            <?php echo (isset($_GET['sexM'])) ? "<input class='checkbox' type='checkbox' name='sexM' value='M' checked>":
            "<input class='checkbox' type='checkbox' name='sexM' value='M'>";?>
            <label for="sexM">Les hommes</label>
            <?php echo (isset($_GET['sexF'])) ? "<input class='checkbox' type='checkbox' name='sexF' value='F' checked>":
            "<input class='checkbox' type='checkbox' name='sexF' value='F'>";?>
            <label for="sexF">Les femmes</label>
            <br><input class='btn' type="submit" value="Soumettre">
        </form>
    </header>
    <main>
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

            // Afficher chaque étudiant dans le tableau
            foreach($notes as $etudiant){
                echo "<tr>";
                $noteFinale = calculerNoteFinal($etudiant);
                $somme += $noteFinale;
                echo "<td>".$etudiant[0]." ".$etudiant[1]."</td>
                <td>".$etudiant[2]."</td>
                <td>$noteFinale%</td>";
                echo "</tr>";
            }
            $moyenne = $somme/count($notes);
            echo "<tr><td colspan='3' class='moyenne'><b>La moyenne du groupe est ".number_format($moyenne,2)."%</b></td></tr>";
            echo "</table>";
        } else {
            echo "<h3>Aucune élève a été trouvé.</h3>";
        }
    }
    ?>
    </main>
    <footer> <a class="menu-item" href="index.html">Retourner</a> </footer>
</body>
</html>
