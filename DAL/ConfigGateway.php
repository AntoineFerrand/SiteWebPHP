<?php


class ConfigGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con=$con;
    }

    public function insererNbNewsPage(int $nb){
        $query = "update tconfig set nbNewsPage = :nb";
        $this->con->executeQuery($query, array(':nb' => array($nb, PDO::PARAM_INT)));
    }

    public function getNbNewsPage() : int {
        $query = "select nbNewsPage from tconfig";
        $this->con->executeQuery($query);
        $result=$this->con->getResults();
        return $result[0]['nbNewsPage'];
    }
}