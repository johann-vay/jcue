<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of typeUtilisateurDAO
 *
 * @author Johann
 */
class TypeUtilisateurDAO {
    
    function __construct() {
    }
    
    public function typeUtilisateurList(){
        $query = 'SELECT  id, libelle '
                . 'FROM typeutilisateur';
        $arrayTypeUtilisateur = Connection::query($query);
        foreach ($arrayTypeUtilisateur as $typeUtilisateur) {
            $typeUtilisateur[] = new TypeUtilisateur($typeUtilisateur[1], $typeUtilisateur[0]);
        }
        return $typeUtilisateur;
    }
    
    public function typeUtilisateurDetails($idTypeUtilisateur){
        $query = 'SELECT  id, libelle '
                . 'FROM typeutilisateur '
                . 'WHERE id = '.$idTypeUtilisateur;
        $arrayDetails = Connection::query($query);
        $typeUtilisateur = new TypeUtilisateur($arrayDetails[0][1], $arrayDetails[0][0]);
        return $typeUtilisateur;
    }
    
     public function addTypeUtilisateur($typeUtilisateur){
        $query = 'INSERT INTO typeutilisateur (libelle) '
                . 'VALUES ("'.$typeUtilisateur->getLibelle().'")';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateTypeUtilisateur($typeUtilisateur){
        $query = 'UPDATE typeutilisateur '
                . 'SET libelle = "'.$typeUtilisateur->getLibelle().'" '
                . 'WHERE id = '.$typeUtilisateur->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
