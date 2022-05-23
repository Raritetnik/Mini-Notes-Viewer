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
    <header class='block'>
        <form method="get">
            <h3>Selectionner le groupe</h3>
            <select name="groupe" id="groupe">
            <option value='g1' <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g1" ) ? "selected" : ""; ?>>Groupe 1</option>
            <option value='g2' <?php echo (isset($_GET['groupe']) && $_GET['groupe'] == "g2" ) ? "selected" : ""; ?>>Groupe 2</option>
            </select>


            <h3>Selectionner le travail</h3>
            <select name="travail" id="travail">
            <option value='4' <?php echo (isset($_GET['travail']) && $_GET['travail'] == "4" ) ?"selected": ""; ?>>Travail pratique 1</option>
            <option value='5' <?php echo (isset($_GET['travail']) && $_GET['travail'] == "5" ) ?"selected": ""; ?>>Travail pratique 2</option>
            <option value='6' <?php echo (isset($_GET['travail']) && $_GET['travail'] == "6" ) ?"selected": ""; ?>>Examen final</option>
            </select>
            <br>
            <input type="submit" class='btn' value="Soumettre"> </form>
    </header>
    <main>
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
        // Afficher chaque étudiant dans le tableau
        foreach($notes as $etudiant){
            echo "<tr>";
            $somme += $etudiant[$travail];
            echo "<td>".$etudiant[0]." ".$etudiant[1]."</td>
                <td>$etudiant[$travail]%</td>";
                echo "</tr>";
        }
        $moyenne = $somme/count($notes);
        echo "<tr><td colspan='2' class='moyenne'><b>La moyenne du groupe est ".number_format($moyenne,2)."%</b></td></tr>";
        echo "</table>";
    }
    ?>
    </main>
    <footer> <a class="menu-item" href="index.html">Retourner</a> </footer>
</body>

</html>
