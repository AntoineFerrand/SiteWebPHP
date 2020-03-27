<?php

class AdminGateway
{
    private $con;

    public function __construct(Connection $con) {
        $this->con=$con;
    }

    public function insert(string $nom, string $mdp) {
        $query="INSERT INTO tadmin VALUES(:id,:pseudo,:pass)";
        $this->con->executeQuery($query,array(
            ':id'=>array(NULL,PDO::PARAM_INT),
            ':pseudo'=>array($nom,PDO::PARAM_STR),
            ':pass'=>array($mdp,PDO::PARAM_STR)));
    }

    public function connexionGW(string $nom) : array {
        $query="SELECT id, pseudo, pass FROM tadmin WHERE pseudo = :pseudo";
        $this->con->executeQuery($query,array(
            ':pseudo'=>array($nom,PDO::PARAM_STR)));
        $resultat=$this->con->getResults();
        return $resultat;

    }

    public function getAllFLux() : array {
        $query="select * from tflux";
        $this->con->executeQuery($query);
        $resultats=$this->con->getResults();
        return $resultats;
    }

    public function ajouterFlux(string $flux){
        try{
            $query = "INSERT INTO tflux VALUES(:url)";
            $this->con->executeQuery($query, array(':url'=>array($flux, PDO::PARAM_STR)));
        }catch (PDOException $e){
        }
    }

    public function supprimerFlux(string $flux){
        $query = "delete from tflux where url = :url";
        $this->con->executeQuery($query, array(':url'=>array($flux, PDO::PARAM_STR)));
    }
}
