<?php

use Models\UsersModel;
use Models\AnnoncesModel;
use Models\CategoriesModel;

require_once('autoloader.php');

// Tester la méthode findAll()
// $order = "price DESC";
// $annonces = AnnoncesModel::findALL(null, "LIMIT 2");

// var_dump($annonces);

// $id = [2];
// $annonces2 = AnnoncesModel::findById($id);

// var_dump($annonces2);

//Test de la méthode findByIdUser
// $idUser = [2];
// $annoncesUser = AnnoncesModel::findByUser($idUser);
// var_dump($annoncesUser);

//Test de la méthode findByCategorie
// $idCategorie = [2];
// $annoncesCategorie = AnnoncesModel::findByCategorie($idCategorie);
// var_dump($annoncesCategorie);

// Teste de la méthode creat

// $data = [1,2,"Tondeuse","maximum 250m², moteur éléctrique", 185, "tondeuse.jpg"];
// AnnoncesModel::create($data);

// Teste de la méthode Update()
// $data = [2,"Tondeuse à gazon","maximum 250m², moteur éléctrique", 185, "tondeuse.jpg", 4];
// AnnoncesModel::update($data);

// Teste de la méthode delete()
// $id = [4];
// AnnoncesModel::delete($id);

// Teste des méthodes pour les users
// var_dump(UsersModel::findALL());
// $id = [2];
// var_dump(UsersModel::findById($id));

// $login = ["admin@admin.fr"];
// var_dump(UsersModel::findByLogin($login));

// $data = [4];
// $resultat = UsersModel::findByIdOrLogin($data);
// if(!$resultat){
//     echo "Cet utilisateur n'est pas présent en base de donnée";
// }

// Teste de la méthode avec clé
// $user = ['password' => ['1234']];
// var_dump(UsersModel::findBy($user));

//Test de la méthode creat() users
$pass = password_hash("1234", PASSWORD_DEFAULT);
// $data = ["tchosdfds@yeah.com", $pass, "tchdsffdsupi", "tfdsfdsou", "66 Rue ddfsfsde Paris", 77140, "Nemours"];
// UsersModel::create($data);

//Test de la mthode update() users

// $data = ["romain@gmail.com", $pass, "Romain", "Cesarini", "40 rue des sablons", 77760, "Larchant", 2];
// UsersModel::update($data);

// Teste de la méhode delete
// UsersModel::delete([4]);

// var_dump(CategoriesModel::findAll());
// echo "<hr>";
// var_dump(CategoriesModel::findById([3]));
// echo "<hr>";
// var_dump(CategoriesModel::findByTitle(["jardin"]));

// CategoriesModel::create(["peluche"]);

// CategoriesModel::update(["musique", 7]);

// CategoriesModel::delete([7]);