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
    <form class='block' action="get">
    <h3>Selectionner le groupe: <select name="groupe" id="groupe">
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g1" ) ?
            "<option value='g1' selected>Groupe 1</option>": "<option value='g1'>Groupe 1</option>"; ?>
            <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g2" ) ?
            "<option value='g2' selected>Groupe 2</option>": "<option value='g2'>Groupe 2</option>"; ?>
        </select></h3>
        <h3>Selectionner le travail: <select name="travail" id="travail">
            <?php echo (isset($_GET['travail']) && $_GET['travail'] == "4" ) ?
            "<option value='4' selected>Travail pratique 1</option>": "<option value='4'>Travail pratique 1</option>"; ?>
            <?php echo (isset($_GET['travail']) && $_GET['travail'] == "5" ) ?
            "<option value='5' selected>Travail pratique 2</option>": "<option value='5'>Travail pratique 2</option>"; ?>
            <?php echo (isset($_GET['travail']) && $_GET['travail'] == "6" ) ?
            "<option value='6' selected>Examen final</option>": "<option value='6'>Examen final</option>"; ?>
        </select></h3>
        <input type="submit" class='btn' value="Soumettre">
    </form>
<?php
    if(isset($_GET['travail']) && isset($_GET['groupe'])) {
        $groupe = $_GET['groupe'];
        $travail = $_GET['travail'];

        $notes = filtreGroupe($groupe);
        $somme = 0;
        echo "<table class='tableNF'><tr>
            <th>Nom</th>
            <th>Note</th>
            </tr>";

        foreach($notes as $etudiant){
            echo "<tr>";
            $somme += $etudiant[$travail];
            echo "<td>".$etudiant[0]." ".$etudiant[1]."</td>
                <td>$etudiant[$travail]%</td>";
                echo "</tr>";
        }
        $moyenne = $somme/count($notes);
        echo "<tr><td colspan='2'><b>La moyenne du groupe est ".number_format($moyenne,2)."%</b></td></tr>";
        echo "</table>";
    }
?>
</body>
</html>