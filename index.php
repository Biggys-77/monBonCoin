<?php

use Models\AnnoncesModel;

require_once('autoloader.php');

// Tester la méthode findAll()
$order = "price DESC";
$annonces = AnnoncesModel::findALL(null, "LIMIT 2");

var_dump($annonces);

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
$data = [2,"Tondeuse à gazon","maximum 250m², moteur éléctrique", 185, "tondeuse.jpg", 4];
AnnoncesModel::update($data);

$id = [4];
AnnoncesModel::delete($id);
