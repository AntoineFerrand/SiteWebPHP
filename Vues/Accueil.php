<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="Vues/Accueil.css">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans&display=swap" rel="stylesheet">
    <title>Sites de news via Flux RSS</title>
</head>

<body>
<div>
    <nav>
        <a id="titre" href="index.php">SITE DE NEWS VIA FLUX RSS</a>
        <div id="menu">
            <a class="liensMenu" href="index.php">Accueil</a>
            <?php
                if (isset($_SESSION['role']) AND isset($_SESSION['login']))
                {
                    echo '<a class="liensMenu" href="?action=pageAdmin">Page administrateur</a>';
                    echo '<a class="liensMenu" href="?action=deconnexion">Déconnexion</a>';
                    echo 'Bienvenue admin ' . $_SESSION['login'];

                }
                else {
                    ?>
                    <a id="laConnexion" class="liensMenu" href="?action=connexion">Connexion</a>
                    <?php
                }
            ?>
        </div>
    </nav>
</div>
<div>
    <table>
        <tr id="colTab">
            <td>Nom</td>
            <td>Date</td>
            <td>Description</td>
        </tr>
        <tr>
            <td>
                <?php
                if (isset($tabNews)){
                    foreach ($tabNews as $news)
                        echo "<p><a href=" . $news->getUrl() . ">" . $news->getNom() . "</br>" . "</a></p>";
                ?>
            </td>
            <td>
                <?php
                    foreach ($tabNews as $news)
                        echo "<p>" . $news->getDate() . "</p>";
                ?>
            </td>
            <td>
                <?php
                    foreach ($tabNews as $news)
                        echo "<p>" . $news->getDescription() . "</p>";
                }
                else echo "Pas de news.</br>";
                ?>
            </td>
        </tr>
    </table>
</div>
<div id="divPages">
    <?php
    if (isset($nbPages) and isset($page)) {
        if ($nbPages > 1) {
            if ($page > 1) {
                echo '<a class="changerPage" href="?page=' . ($page - 1) . '">Page Précédente</a>';
            }
            echo '<a id="numeroPage" href="?page=' . ($page) . '">' . $page . '</a>';
            if ($page < $nbPages) {
                echo '<a class="changerPage" href="?page=' . ($page + 1) . '">Page Suivante</a>';
            }
        }
    }
    ?>
</div>

<footer>
    Créateurs du site : FERRAND Antoine et ARNOULD Tristan.
</footer>

</body>
</html>
