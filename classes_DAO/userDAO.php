<?php
require_once '../required.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userDAO
 *
 * @author Johann
 */
class UserDAO {
    
    
    function __construct() {
    }
    
    public function usersList(){
        $query = 'SELECT  id, adresse, codePostal, ville, mail, telephone, login, password, type '
                . 'FROM utilisateur';
        $arrayUsers = Connection::query($query);
        foreach ($arrayUsers as $user) {
            $users[] = new User($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8]);
        }
        return $users;
    }
    
    public function userDetails($userId){
        $query = 'SELECT id, adresse, codePostal, ville, mail, telephone, login, password, type '
                . 'FROM utilisateur '
                . 'WHERE id = '.$userId;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $user) {
            $user[] = new User($user[0], $user[1], $user[2], $user[3], $user[4], $user[5], $user[6], $user[7], $user[8]);
        }
        
        return $user;
    }

}