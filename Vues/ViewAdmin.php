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
                <a class="liensMenu" href="?action=deconnexion">Déconnexion</a>
                <?php
                    if (isset($_SESSION['role']) AND isset($_SESSION['login'])) {
                        echo 'Bienvenue admin ' . $_SESSION['login'];
                    }
                ?>
            </div>
        </nav>
    </div>
    <form method="post">
        <p>
            <label for="nombre">Nombre de news à afficher : </label>
            <input type="number" min="1" name="nombre" id="nombre" />
        </p>
        <p>
            <input type="submit" value="Envoyer"/>
        </p>
        <input type="hidden" name="action" value="parametrerPage">
    </form>
    <div>
        <?php
            echo "Listes des flux : ";
            if (isset($tabflux)){
                foreach ($tabflux as $flux){
                    echo "<p>" . $flux->getUrl() . "</br>" . "</p>";
                }
            }
        ?>

        <form method="post">
            <p>
                <label for="ajout">URL du flux à ajouter : </label>
                <input type="text" name="ajout" id="ajout" />
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
            <input type="hidden" name="action" value="ajouterFlux">
        </form>

        <form method="post">
            <p>
                <label for="suppression">URL du flux à supprimer : </label>
                <input type="text" name="suppression" id="suppression" />
            </p>
            <p>
                <input type="submit" value="Envoyer"/>
            </p>
            <input type="hidden" name="action" value="supprimerFlux">
        </form>
    </div>
    </body>
    <footer>
        Créateurs du site : FERRAND Antoine et ARNOULD Tristan.
    </footer>
</html>
