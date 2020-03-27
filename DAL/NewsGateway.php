<?php

class NewsGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function findNewsByURL(string $url) : array
    {
        $query = "select * from tnews where url=:url";
        $this->con->executeQuery($query, array(":url" => array($url, PDO::PARAM_STR)));
        $results=$this->con->getResults();
        return $results;
    }

    public function findNewsByName(string $nom) : array
    {
        $query = "select * from tnews where nom=:nom";
        $this->con->executeQuery($query, array(":nom" => array($nom, PDO::PARAM_STR)));
        $results=$this->con->getResults();
        return $results;
    }

    public function getAllNews() : array
    {
        $query = "select * from tnews";
        $this->con->executeQuery($query);
        $results=$this->con->getResults();
        foreach($results as $news)
                $tableauNews[]=new News($news["nom"], $news["description"], $news["date"], $news["url"]);
        return $tableauNews;
    }

    public function getNbTotalNews() : int {
        $query='select * from tnews';
        $this->con->executeQuery($query);
        $result = $this->con->getResults();
        return count($result);
    }

    public function getNewsParPage(int $page, int $nbNews) : array {
        $query = 'select * from tnews order by date desc limit :page, :nbNews';
        $this->con->executeQuery($query, array (':page' => array($page, PDO::PARAM_INT),
                                                ':nbNews' => array($nbNews, PDO::PARAM_INT)));
        return $this->con->getResults();
    }

    public function insert(string $url, string $nom, string $description) : string
    {
        $date=date("d/m/Y");
        $query="insert into tnews values(:url,:nom,:description,:d)";
        $this->con->executeQuery($query, array(
            ":url" => array("$url", PDO::PARAM_STR),
            ":nom" => array("$nom", PDO::PARAM_STR),
            ":description" => array("$description", PDO::PARAM_STR),
            ":d" => array("$date", PDO::PARAM_STR),
        ));
        return $this->con->lastInsertId();
    }
}