<?php
//Gen
$rep=__DIR__.'/../';

//Base de données à l'iut
/*
$serveur="berlin.iut.local";
$base="dbanferrand1";
$login="anferrand1";
$mdp="dabman";*/

//Base de données maison
$serveur="localhost";
$base="dbanferrand1";
$login="root";
$mdp="";

//ne pas oublier de changer le nom de la table TNews et TAdmin

//Vues
$vues['Erreur']='Vues/Erreur.php';
$vues['Accueil']='Vues/Accueil.php';
$vues['Connexion']='Vues/ConnexionAdmin.php';
$vues['Admin']='Vues/ViewAdmin.php';

//Parser
$parser='RSS/parser.php';