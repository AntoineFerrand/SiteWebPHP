<?php


class MdlAdmin
{
    public function getAdmin($pseudo) : ?Admin {
        global $serveur, $base, $login, $mdp;

        //$pass=Validation::hachagePass($pass);

        $gw = new AdminGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        //Si on veut inserer un nouvel admin
        //$gw->insert($pseudo,$pass);

        //pour se connecter
        $resultat=$gw->connexionGW($pseudo);
        if(empty($resultat)){
            return NULL;
        }

        $admin = $resultat[0];
        return  new Admin($admin['id'], $admin['pseudo'], $admin['pass']);
    }

    public function connexion(string $login, $mdp){
        global $vues;
        if (!Validation::validerChamp($login)){
            throw new Exception("Ce n'est pas un login");
        }
        $admin=$this->getAdmin($login);
        if ($admin == null){
            throw new Exception("Mauvais login");
        }

        if (!password_verify($mdp, $admin->getPassword())){
            throw new Exception("Mauvais mot de passe");
        }
        $_SESSION['login']=$login;
        $_SESSION['role']='admin';
    }

    public function deconnexion(){
        session_unset();
        session_destroy();
        $_SESSION=array();
    }

    public function isAdmin() : ?Admin{
        if (isset($_SESSION['login']) && isset($_SESSION['role'])){
            $login=Validation::nettoyerChamp($_SESSION['login']);
            $admin=$this->getAdmin($login);
            return $admin;
        }
        else return null;
    }

    public function insererNbNewsPage(int $nb){
        global $serveur, $base, $login, $mdp;
        $gw = new ConfigGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $gw->insererNbNewsPage($nb);
    }

    public function recupererNbNewsPage() : int {
        global $serveur, $base, $login, $mdp;
        $gw = new ConfigGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $result=$gw->getNbNewsPage();
        return $result;
    }

    public function getAllFlux () : array {
        global $serveur, $base, $login, $mdp;

        $gw = new AdminGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $tabflux=$gw->getAllFLux();
        foreach ($tabflux as $flux){
            $tflux[] = new Flux($flux["url"]);
        }
        return $tflux;
    }

    public function ajouterFlux(string $flux){
        global $serveur, $base, $login, $mdp;

        $gw = new AdminGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $gw->ajouterFlux($flux);
    }

    public function supprimerFlux(string $flux){
        global $serveur, $base, $login, $mdp;

        $gw = new AdminGateway(new Connection("mysql:host=$serveur;dbname=$base","$login", "$mdp"));
        $gw->supprimerFlux($flux);
    }
}
