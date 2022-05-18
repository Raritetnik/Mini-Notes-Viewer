<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <?php include("bd_notes.php"); ?>
    <title>Document</title>
</head>
<body>
    <form method="get">
        <select name="groupe" id="groupe">
            <option value="g1">Groupe 1</option>
            <option value="g2">Groupe 2</option>
        </select>
        <select name="travail" id="travail">
            <option value="4">Travail 1</option>
            <option value="5">Travail 2</option>
            <option value="6">Examen final</option>
        </select>
        <input type="submit" value="Soumettre">
    </form>
<?php
    if(isset($_GET['travail']) && isset($_GET['groupe'])) {
        $groupe = $_GET['groupe'];
        $travail = $_GET['travail'];

        $notes = filtreGroupe($groupe);
        $somme = 0;
        foreach($notes as $etudiant){
            $somme += $etudiant[$travail];
            echo "<h3>".$etudiant[0]." ".$etudiant[1].": ".$etudiant[$travail]."%</h3>";
        }
        $moyenne = $somme/count($notes);
        echo "La moyenne du groupe est ".number_format($moyenne,2)."%";
    }
?>
</body>
</html>