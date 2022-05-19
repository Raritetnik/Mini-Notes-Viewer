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
        <h2>Vaillez saisir le numero d'étudiant</h2>
        <form method="get">
            <h3><?php echo (isset($_GET['code'])) ?
        "<input id='recherche' type='text' name='code' value=".$_GET['code'].">" :
        "<input id='recherche' type='text' name='code'>"?>
        <input class='btn' type="submit" value="Recherche"></h3> </form>
    </header>
    <main>
    <?php
    if(isset($_GET['code'])){
        $codeEtudiant = $_GET['code'];
        $notes = filtreGroupe("");
        /** Expression regulière verification: AAAA00000 type d'entrée */
        $regExp = "/([A-Z][A-Z][A-Z][A-Z]\d\d\d\d\d)/";

        if(preg_match($regExp, $codeEtudiant)) {
            if(rechercheEtudiant($notes, $codeEtudiant)){
                $etudiant = $notes[$codeEtudiant];
                echo "<table class='tableNF'><tr>
                <th>Nom</th>
                <th>Travail Pratique 1</th>
                <th>Travail Pratique 2</th>
                <th>Examen Final</th>
                <th>Note Final</th>
                </tr>
                <tr>";
                echo "<td>".$etudiant[0]." ".$etudiant[1]."</td>
                <td>".$etudiant[4]."%</td>
                <td>".$etudiant[5]."%</td>
                <td>".$etudiant[6]."%</td>
                <td>".calculerNoteFinal($etudiant)."%</td>";
                echo "</tr></table>";
            } else {
                echo "<h3>Aucune élève a été trouvé.</h3>";
            }
        } else {
            echo "<h4>Entrée invalide, vailler saisir le bon format de numero d'étudiant...<h4>";
        }
    }
    ?>
    </main>
    <footer> <a class="menu-item" href="index.html">Retourner</a> </footer>
</body>

</html>
