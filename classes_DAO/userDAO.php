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
        $query = 'SELECT  id, nom, prenom, adresse, codePostal, ville, mail, telephone, login, password, raisonSociale, numeroSIRET, id_typeutilisateur '
                . 'FROM utilisateur';
        $arrayUsers = Connection::query($query);
        foreach ($arrayUsers as $user) {
            $users[] = new User($user[3], $user[4], $user[5], $user[6], $user[7], $user[8], $user[9], $user[12], $user[1], $user[2], $user[10], $user[11], $user[0]);
        }
        return $users;
    }
    
    public function userByLogin($login){
        $query = 'SELECT id, nom, prenom, adresse, codePostal, ville, mail, telephone, login, password, raisonSociale, numeroSIRET, id_typeutilisateur '
                . 'FROM utilisateur '
                . 'WHERE login = "'.$login.'"';
        $arrayDetails = Connection::query($query);
        $user = new User($arrayDetails[0][3], $arrayDetails[0][4], $arrayDetails[0][5], $arrayDetails[0][6], 
               $arrayDetails[0][7], $arrayDetails[0][8], $arrayDetails[0][9], $arrayDetails[0][12], $arrayDetails[0][1], $arrayDetails[0][2],
                $arrayDetails[0][10], $arrayDetails[0][11], $arrayDetails[0][0]);

        return $user;
    }


    public function userDetails($userId){
        $query = 'SELECT id, nom, prenom, adresse, codePostal, ville, mail, telephone, login, password, raisonSociale, numeroSIRET, id_typeutilisateur '
                . 'FROM utilisateur '
                . 'WHERE id = '.$userId;
        $arrayDetails = Connection::query($query);
        $user = new User($arrayDetails[0][3], $arrayDetails[0][4], $arrayDetails[0][5], $arrayDetails[0][6], 
               $arrayDetails[0][7], $arrayDetails[0][8], $arrayDetails[0][9], $arrayDetails[0][12], $arrayDetails[0][1], $arrayDetails[0][2], 
                $arrayDetails[0][10], $arrayDetails[0][11], $arrayDetails[0][0]);
        
        return $user;
    }
    
    public function addParticulier($user){
        $query = 'INSERT INTO utilisateur (nom, prenom, adresse, codePostal, ville, mail, telephone, login, password, raisonSociale, numeroSIRET, id_typeutilisateur) '
                . 'VALUES ("'.$user->getNom().'", "'.$user->getPrenom().'", "'.$user->getAdresse().'", "'.$user->getCodePostal().'", "'.$user->getVille().'", '
                . '"'.$user->getMail().'", "'.$user->getTelephone().'", "'.$user->getLogin().'", "'.$user->getPassword().'", NULL, NULL, '.$user->getType().')';
        var_dump($query);
        $result = Connection::exec($query);
        return $result;
    }
    public function addEntreprise($user){
        $query = 'INSERT INTO utilisateur (nom, prenom, adresse, codePostal, ville, mail, telephone, login, password, raisonSociale, numeroSIRET, id_typeutilisateur) '
                . 'VALUES (NULL, NULL, "'.$user->getAdresse().'", "'.$user->getCodePostal().'", "'.$user->getVille().'", '
                . '"'.$user->getMail().'", "'.$user->getTelephone().'", "'.$user->getLogin().'", "'.$user->getPassword().'", "'.$user->getRaisonSociale().'", '
                . '"'.$user->getNumeroSiret.'", '.$user->getType().')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateUser($user){
        $query = 'UPDATE utilisateur '
                . 'SET nom = "'.$user->getNom().'", prenom = "'.$user->getPrenom().'", adresse = "'.$user->getAdresse().'", codePostal = "'.$user->getCodePostal().'", ville = "'.$user->getVille().'", '
                . 'mail = "'.$user->getMail().'", telephone = "'.$user->getTelephone().'", login = "'.$user->getLogin().'", password = "'.$user->getPassword().'", '
                . 'raisonSociale = "'.$user->getRaisonSociale().'", numeroSIRET = "'.$user->getNumeroSiret().'", id_typeutilisateur = '.$user->getType().' '
                . 'WHERE id = '.$user->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteUser($user){
        $query = 'DELETE FROM utilisateur '
                . 'WHERE id = '.$user->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function nbUsers(){
        $query = 'SELECT COUNT(id) '
                . 'FROM utilisateur';
        $result = Connection::query($query);
        return $result[0][0];
    }

}