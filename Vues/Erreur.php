<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Vues/Accueil.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans&display=swap" rel="stylesheet">
    <title>Sites de news via Flux RSS</title>
</head>

<body>

<?php
    if (isset($dVueErreur)) {
        foreach ($dVueErreur as $value) {
            echo $value . '</br>';
        }
    }
?>



<footer>
    Créateurs du site : FERRAND Antoine et ARNOULD Tristan.
</footer>

</body>
</html>
