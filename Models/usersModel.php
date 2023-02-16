<?php

namespace Models;

use PDO;
use App\Db;

class UsersModel extends Db{
    ///////////////////////////////// CRUD ///////////////////////////

    ///////////////////////////// Méthode de lecture READ /////////////////////////////

    //Trouver tout les utilisateur

    public static function findAll(){

    $request = "SELECT * FROM users";
    $response = self::getDb()->prepare($request);
    $response->execute();

    return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    // Trouver un utilisateur par son id

    /**
     * Attend un id d'utilisateurs
     * @param array id[int]
     */
    public static function findById($id){
        $request = "SELECT * FROM users WHERE idUser = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($id);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    // Trouver un utilisateur par son login
    public static function findByLogin($login){
        $request = "SELECT * FROM users WHERE login = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($login);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    //exo recherche par id ou login
    public static function findByIdOrLogin(array $data){
        if(is_int($data[0])){
            $request = "SELECT * FROM users WHERE idUser = ?";
        }else{
            $request = "SELECT * FROM users WHERE login = ?";
        }
        $response = self::getDb()->prepare($request);
        $response->execute($data);

        return $response->fetch(PDO::FETCH_ASSOC);
    }

    // Recherche par clé
    /**
     * Cette méthode permet de trouver un ou des utilisateurs par n'importe quel critère
     * elle attend un tableau addociatif
     * @param array $user["clé" => ["valeur"]]
     */
    public static function findBy(array $user){
        $request = "SELECT * FROM users WHERE " . key($user) ."= ?";
        $response = self::getDb()->prepare($request);
        $response->execute(current($user));

        return $response->fetchAll(PDO::FETCH_ASSOC);
    }

    /////////////////////////////// Méthode d'écriture CREATE ////////////////////////////////

    public static function create(array $data){
        // $data est un tableau qui contient les valeurs à inserer en BDD
        
        $request = "INSERT INTO users (login, password, firstName, lastName, adress, cp, city) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }

    ////////////////////////////// UPDATE ////////////////////////////////////

    // Modification d'un utilisateur
    public static function update(array $data){
        $request = "UPDATE users SET login = ?, password = ?, firstName = ?, lastName = ?, adress = ?, cp = ?, city = ? WHERE idUser = ?";
        $response = self::getDb()->prepare($request);
        $response->execute($data);
    }

    //////////////////////////////// DELETE ////////////////////////////////

    // Méthode de supression
    public static function delete(array $id){
        $request = "DELETE FROM users WHERE idUser = ?";
        $response = self::getDb()->prepare($request);

        return $response->execute($id);
    }
}