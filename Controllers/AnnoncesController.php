<?php
namespace Controllers;

use Models\AnnoncesModel;

class AnnoncesController extends Controller{
    // Méthode pour afficher les dernieres annonces misent en ligne
    public static function accueil(){
        $annonces = AnnoncesModel::findAll("date DESC", "LIMIT 2");

        // On utilise la méthode render
        self::render('annonces/accueil', [
            'title' => 'Bienvenue sur mon bon coin',
            'annonces' => $annonces
        ]);
    }
}