<?php

namespace App;

use Controllers\Controller;
use Controllers\AnnoncesController;

class Routeur{
    public function app(){
        // On test le routeur
        // echo "le routeur fonctionne";

        // Récupérer l'url
        $request = $_SERVER['REQUEST_URI'];
        // echo $request;

        // On suprime "/monboncoin/public" de $request
        $nb =strlen(SITEBASE);
        $request = substr($request, $nb);
        // echo "<hr>";
        // echo $request;
        // On casse $request pour récupérer uniquement la route et demandé et pas les aram GET
        $request = explode("?", $request);
        $request = $request[0];
        // echo $request;

        // On définit les routes du projet
        switch ($request){
            case '':
                // echo "vous êtes sur la page d'accueil";
                $accueil = AnnoncesController::accueil();
                break;
            case 'annonces':
                echo "vous êtes sur la page annonces";
                break;
            case 'annonceDetail':
                // echo "vous êtes sur la page annoncesDetail";
                if (isset($_GET['id'])) {
                    $id = (int)$_GET['id'];
                }
                AnnoncesController::detail($id);
                break;
            case 'annonceAjout':
                echo "page création d'annonce";
                break;
            case 'annonceModif':
                echo "page modification d'annonce";
                break;
            case 'annonceSupp':
                echo "page de suppression d'annonce";
                break;
            case 'panier':
                echo "page paner";
                break;
            case 'inscription':
                echo "page d'inscription";
                break;
            case 'connexion':
                echo "page de connexion";
                break;
            case 'deconnexion';
                echo "page de deconnexion";
                break;
            case 'profil':
                echo "page de profil";
                break;
            default:
                echo "cette pasge n'existe pas";
                break;
        }
    }
}