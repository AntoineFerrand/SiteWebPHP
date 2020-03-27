<?php

/*
class FrontController
{
    public function __construct()
    {
        global $vues;
        session_start();
        //error_reporting(0) permet d'enlever les warnings, notices, ...
        //error_reporting(0);
        $dVueErreur=array();
        try{
            $action=$_REQUEST['action'];

            switch($action) {
                case NULL :
                    new ControleurVisiteur();
                    break;
                case 'verificationConnexion':
                case 'deconnexion':
                case 'connexion':
                case 'pageAdmin':
                case 'parametrerPage':
                    new ControleurAdmin();
                    break;
                default:
                    $dVueErreur[]="Erreur d'appel php";
                    require($vues['Erreur']);
                    break;
            }
        }catch(PDOException $e1){
            $dVueErreur[]="Erreur inattendue de base de donnée.\n";
        }
        catch(Exception $e2){
            $dVueErreur[]="Erreur inattendue.\n";
        }
        exit(0);
    }
}*/

class FrontController
{
    public function __construct()
    {
        global $vues;
        session_start();
        //error_reporting(0) permet d'enlever les warnings, notices, ...
        error_reporting(0);
        $listeAction_admin=array('deconnexion', 'parametrerPage', 'pageAdmin', 'supprimerFlux', 'ajouterFlux');
        $dVueErreur=array();

        try{
            $modelAdmin=new MdlAdmin();
            $admin=$modelAdmin->isAdmin();
            $action=$_REQUEST['action'];
            if (isset($action)){
                $action=Validation::nettoyerChamp($action);
            }

            if (in_array($action, $listeAction_admin)){
                if ($admin == null){
                    require ($vues['Connexion']);
                }
                else {
                    new ControleurAdmin();
                }
            }
            else {
                new ControleurVisiteur();
            }
        }catch(PDOException $e1){
            $dVueErreur[]="Erreur inattendue de base de donnée.\n";
            require ($vues['Erreur']);
        }
        catch(Exception $e2){
            $dVueErreur[]="Erreur inattendue.\n";
            require ($vues['Erreur']);
        }
        exit(0);
    }
}
