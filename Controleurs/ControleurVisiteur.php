<?php


class ControleurVisiteur
{
    public function __construct()
    {
        global $vues;
        $dVueErreur=array();
        try{
            $action=$_REQUEST['action'];
            if (isset($action)){
                $action=Validation::nettoyerChamp($action);
            }

            switch($action) {
                case NULL :
                    $this->AfficherPagePrinc();
                    break;
                case 'connexion':
                    $this->AfficherPageConnexion();
                    break;
                case 'verificationConnexion':
                    $this->VerificationConnexion();
                    break;
                default:
                    $dVueErreur[]="Erreur d'appel php controleur visiteur";
                    require($vues['Erreur']);
                    break;
            }
        }catch(PDOException $e1){
            $dVueErreur[]="Erreur inattendue de base de donnée.\n";
            require($vues['Erreur']);
        }
        catch(Exception $e2){
            $dVueErreur[]=$e2->getMessage()."\n";
            require($vues['Erreur']);
            if (strcmp ( $e2->getMessage() , "Ce n'est pas un login" ) == 0 || strcmp ( $e2->getMessage() , "Mauvais login" ) == 0 || strcmp ( $e2->getMessage() , "Mauvais mot de passe" ) == 0)
                require($vues['Connexion']);
        }
        exit(0);
    }

    function AfficherPageConnexion() {
        global $rep,$vues;

        require ($vues['Connexion']);

    }

    function VerificationConnexion() {
        global $rep,$vues;
        $dVueErreur=array();

        $modelAdmin=new MdlAdmin();

        $login=$_POST['pseudo'];
        $mdp=$_POST['pass'];

        if (!Validation::validerChamp($login) AND !Validation::validerChamp($mdp)){
            $dVueErreur[]="Les 2 champs ont mal été saisi.</br>";
            require ($vues['Erreur']);
            require ($vues['Connexion']);
        }
        else {
            $pass = Validation::nettoyerChamp($mdp);
            $pseudo = Validation::nettoyerChamp($login);

            $modelAdmin->connexion($pseudo, $pass);
            $tabflux = $modelAdmin->getAllFlux();
            require($vues['Admin']);
        }
    }

    function AfficherPagePrinc() {
        global $rep,$vues;

        $m=new Modele();
        $modelAdmin=new MdlAdmin();

        $nbNewsAfficher=$modelAdmin->recupererNbNewsPage();

        $page = (isset($_GET['page'])) ? $page = $_GET['page'] : $page = 1;
        $nbNewsTotal=$m->getNbNews();
        $tabNews = $m->getNewsPage(($page - 1)*$nbNewsAfficher, $nbNewsAfficher);
        $nbPages = ceil($nbNewsTotal/$nbNewsAfficher);

        //$tabNews=$m->getNews();
        require ($vues['Accueil']);

    }
}