<?php
namespace Controllers;

use Models\AnnoncesModel;
use Models\CategoriesModel;

class AnnoncesController extends Controller{
    // Méthode pour afficher les dernieres annonces misent en ligne
    public static function accueil(){
        $annonces = AnnoncesModel::findAll("date DESC", "LIMIT 2");

        // On utilise la méthode render
        self::render('annonces/accueil', [
            'title' => 'Bienvenue sur mon bon coin',
            'annonces' => $annonces,
            'sousTitre' => "Les dernières annonces misent en ligne"
        ]);
    }

    // Méthode pour afficher le détail d'un annonce
    public static function detail(int $id){
        $annonce = AnnoncesModel::findById([$id]);
        $msg ='';
        if (!$annonce) {
            $msg = "Cette annonce n'existe pas";
        }
        self::render('annonces/detail', [
            'title' => 'Détail de l\'annonce',
            'annonce' => $annonce,
            'msg' => $msg
        ]);
    }

    // Méthode pour afficher toutes les annonces
    public static function annonces($order =null, $categorie =null){
        if ($categorie == null) {
            $annonces = AnnoncesModel::findAll($order);
        }else{
        $annonces = AnnoncesModel::findByCategorie([$categorie], $order);
        }
        // Récupération des catégories
        $categories = CategoriesModel::findAll();

        self::render('annonces/annonces', [
            'title' => "Les annonces de mon bon coin",
            'annonces' => $annonces,
            'categories' => $categories
        ]);
    }

    //Méthode pour crée une annonce
    public static function annonceAjout(){
        // Récupérer les catégories
        $categories = CategoriesModel::findAll();

        // Traitement du formulaire
        $errMsg = "";
        if(!empty($_POST['title']) &&
            !empty($_POST['idCategorie']) &&
            !empty($_POST['price']) &&
            !empty($_POST['description']) &&
            !empty($_FILES['image'])
            ){
                if (($_FILES['image']['size'] < 3000000) &&
                    (($_FILES['image']['type'] == 'image/jpeg') || 
                    ($_FILES['image']['type'] == 'image/jpg') ||
                    ($_FILES['image']['type'] == 'image/webp') ||
                    ($_FILES['image']['type'] == 'image/png'))
                ){
                    // On sécurise
                    $secu = self::security();
                    // On renomme la photo
                    $photoName = uniqid() . $_FILES['image']['name'];
                    // On copie la photo sur le serveur
                    copy($_FILES['image']['tmp_name'], ROOT . "/public/img/annonces/" . $photoName);
                    // On appel la requête d'enregistrement en BDD
                    $user = $_SESSION['user']['id'];
                    $categorie = (int)$_POST['idCategorie'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = (int)$_POST['price'];
                    $photoName;
                    $newAnnonce = AnnoncesModel::create([$user, $categorie, $title, $description, $price, $photoName]);
                    header('Location: ' . SITEBASE);
                }else{
                    $errMsg = "Image trop lourde ou mauvais format";
                }
            }elseif(!empty($_POST)){
                $errMsg = "Merci de remplir tous les champs";
            }
        self::render('annonces/ajout', [
            'title' => "Nouvelle annonce",
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }

    // Méthode pour modifier une annonce
    public static function annonceModif($id){
        $errMsg = "";
        // On récupére les catégories
        $categories = CategoriesModel::findAll();
        // On récupére l'annonce que l'ont souhaite modifier
        $annonce = AnnoncesModel::findById([$id]);
        !$annonce ? header('Location: annonces') : null;
        // Vérifier que l'utilisateur est admin ou que l'utilisateur est le propriétaire de l'annonce
        if($_SESSION['user']['role'] == 1 || $_SESSION['user']['id'] == $annonce['idUser']){
            // Traitement de mon formulaire
            if(!empty($_POST['title']) &&
                !empty($_POST['idCategorie']) &&
                !empty($_POST['price']) &&
                !empty($_POST['description'])){
                    // COntrole sur la photo
                    if (!empty($_FILES['image']['name']) && (
                        ($_FILES['image']['size'] < 3000000) &&
                        (($_FILES['image']['type'] == 'image/jpeg') || 
                        ($_FILES['image']['type'] == 'image/jpg') ||
                        ($_FILES['image']['type'] == 'image/webp') ||
                        ($_FILES['image']['type'] == 'image/png')))
                    ){
                        $photoName = uniqid() . $_FILES['image']['name'];
                        copy($_FILES['image']['tmp_name'], ROOT . "/public/img/annonces/" . $photoName);
                    }elseif(!empty($_FILES['image']['name'])){
                        $errMsg = "photo trop lourde ou mauvais format";
                    }
                    self::security();
                    $categorie = (int)$_POST['idCategorie'];
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = (int)$_POST['price'];
                    $idAnnonce = $annonce['idAnnonce'];
                    if(isset($photoName)){
                        $data = [$categorie, $title, $description, $price, $photoName,$idAnnonce ];
                    }else{
                        $data = [$categorie, $title, $description, $price, $annonce['image'],$idAnnonce ];
                    }
                    // Executer la requete update
                    $annonceModif = AnnoncesModel::update($data);
                    header('Location: annonces');

                }elseif(!empty($_POST)){
                    $errMsg = "Merci de remplir tous les champs (hors mis la photo)";
                }
        }else{
            header('Location: annonces');
        }

        self::render('annonces/modification', [
            'title' => 'Modification de l\'annonce',
            'annonce' => $annonce,
            'categories' => $categories,
            'errMsg' => $errMsg
        ]);
    }
}