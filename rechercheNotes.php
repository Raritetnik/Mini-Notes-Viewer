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
    <form method="get">
        <?php echo (isset($_GET['code'])) ?
        "<input type='text' name='code' value=".$_GET['code'].">" :
        "<input type='text' name='code'>)"?>
        <input type="submit">
    </form>
    <?php
    if(isset($_GET['code'])){
        $codeEtudiant = $_GET['code'];
        $regExp = "/([A-Z][A-Z][A-Z][A-Z]\d\d\d\d\d)/";
        if(preg_match($regExp, $codeEtudiant)) {
            echo 'Ressemble';
        } else {
            echo "Non";
        }


    }
    ?>
</body>
</html>