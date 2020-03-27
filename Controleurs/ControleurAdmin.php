<?php

class ControleurAdmin extends ControleurVisiteur
{
    public function __construct()
    {
        global $rep, $vues;
        $dVueErreur=array();
        try{
            $action=$_REQUEST['action'];
            if (isset($action)){
                $action=Validation::nettoyerChamp($action);
            }

            switch($action) {
                case NULL:

                    break;
                case 'deconnexion':
                    $this->seDeconnecter();
                    break;
                case 'pageAdmin':
                    $this->AfficherPageAdmin();
                    break;
                case 'ajouterFlux':
                    $this->ajouterFluxRSS();
                    break;
                case 'supprimerFlux':
                    $this->supprimerFluxRSS();
                    break;
                case 'parametrerPage':
                    $this->parametrerPage();
                    break;
                default:
                    $dVueErreur[]="Erreur d'appel php controleur admin";
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
        }
        exit(0);
    }

    function AfficherPageAdmin() {
        global $rep,$vues;
        $modelAdmin = new MdlAdmin();
        $tabflux = $modelAdmin->getAllFlux();
        require ($vues['Admin']);
    }

    function ajouterFluxRSS(){
        global $vues;
        $flux = $_POST['ajout'];
        if (isset($flux)){
            $flux=Validation::nettoyerChamp($flux);
        }
        $modelAdmin = new MdlAdmin();
        if ( preg_match ( "/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/" , $flux)){
            $modelAdmin->ajouterFlux($flux);
        }else{
            $dVueErreur[] = "Ce n'est pas une URL valide ! \n";
            require($vues['Erreur']);
        }
        $tabflux = $modelAdmin->getAllFlux();
        require_once ($vues['Admin']);
    }

    function supprimerFluxRSS(){
        global $vues;
        $flux = $_POST['suppression'];
        if (isset($flux)){
            $flux=Validation::nettoyerChamp($flux);
        }
        $modelAdmin = new MdlAdmin();
        if ( preg_match ( "/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/" , $flux)){
            $modelAdmin->supprimerFlux($flux);
        }else{
            $dVueErreur[] = "Ce n'est pas une URL valide ! \n";
            require($vues['Erreur']);
        }
        $tabflux = $modelAdmin->getAllFlux();
        require_once ($vues['Admin']);
    }

    function parametrerPage(){
        global $vues;
        $nombreParPage=$_POST['nombre'];
        if ($nombreParPage==null){
            $dVueErreur[] = "Veuillez marquer un nombre correct ! \n";
            require($vues['Erreur']);
        }
        else {
            $nombreParPage = Validation::nettoyerInt($nombreParPage);
            $model = new MdlAdmin();
            $model->insererNbNewsPage($nombreParPage);
        }
        $this->AfficherPageAdmin();
    }

    function seDeconnecter(){
        global $vues;
        $model = new MdlAdmin();
        $model->deconnexion();
        require ($vues['Connexion']);
    }

}
