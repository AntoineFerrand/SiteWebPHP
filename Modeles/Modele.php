<?php

class Modele
{
    public function getNews() : array {
        global $serveur, $base, $login, $mdp;

        $gw = new NewsGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $tabnews=$gw->getAllNews();
        return $tabnews;
    }

    public function getNbNews() : int {
        global $serveur, $base, $login, $mdp;

        $gw = new NewsGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        return $gw->getNbTotalNews();
    }

    public function getNewsPage(int $page, int $nbNews) : array {
        global $serveur, $base, $login, $mdp;

        $gw = new NewsGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $results = $gw->getNewsParPage($page, $nbNews);
        foreach($results as $news){
            $tNews[] = new News($news["nom"], $news["description"], $news["date"], $news["url"]);
        }
        return $tNews;
    }
}