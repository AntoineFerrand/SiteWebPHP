<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="Vues/Accueil.css">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|Open+Sans&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Connexion administrateur</title>
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
                        echo '<a class="liensMenu" href="?action=deconnexion">Déconnexion</a>';
                        echo 'Bienvenue admin ' . $_SESSION['login'];

                    }
                    else {
                        ?>
                    <a id="laConnexion" class="liensMenu" href="?action=connexion">Connexion</a>
            </div>
        </nav>
                    <form method="post">
                        <p>
                            <label for="pseudo">Pseudo : </label>
                            <input type="text" name="pseudo" id="pseudo" />
                        </p>
                        <p>
                            <label for="pass">Mot de passe : </label>
                            <input type="password" name="pass" id="pass" />
                        </p>
                        <p>
                            <input type="submit" value="Envoyer"  />
                        </p>
                        <input type="hidden" name="action" value="verificationConnexion">
                    </form>
                    <?php
                }
                ?>


    </div>

    </body>
</html>
