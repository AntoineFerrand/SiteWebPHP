<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="600"/>
    <title>Parser Flux RSS</title>
</head>
<body>

<?php
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

require("../DAL/Connection.php");
$connexion = new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp");


$query = "select * from tflux";
$connexion->executeQuery($query);
$results=$connexion->getResults();
foreach($results as $contenu) {
    $feed = new SimpleXMLElement($contenu["url"], NULL, TRUE); //recup le contenu du fichier
    foreach ($feed->channel->item as $v) {
        try{
            $query2 = "insert into tnews values(:url,:nom,:description,:d)";
            $connexion->executeQuery($query2, array(
                ":url" => array("$v->link", PDO::PARAM_STR),
                ":nom" => array(substr($v->title, 0, 70), PDO::PARAM_STR),
                ":description" => array(substr($v->description, 0, 150), PDO::PARAM_STR),
                ":d" => array(date("Y-m-d H:i", strtotime($v->pubDate)), PDO::PARAM_STR)));
        }catch (PDOException $e){
            $dVueErreur[]="PDOException\n";
        }
    }
    try{
        $query3 = "delete from tnews where NOW()>DATE_ADD(date, INTERVAL 30 DAY)";
        $connexion->executeQuery($query3);
    }catch (PDOException $e){
        $dVueErreur[]="PDOException\n";
    }
}

?>

</body>
</html>

