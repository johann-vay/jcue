<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of particulierDAO
 *
 * @author Quentin
 */
class particulierDAO {
    //put your code here
    function __construct() {
    }
    
    public function particulierList(){
        $query = 'SELECT  id, nom, prenom'
                . 'FROM particulier';
        $arrayParticuliers = Connection::query($query);
        foreach ($arrayParticuliers as $particulier) {
            $particuliers[] = new Particulier($particulier[0], $particulier[1], $particulier[2]);
        }
        return $particuliers;
    }
    
    public function particulierDetails($idParticulier){
        $query = 'SELECT  id, nom, prenom '
                . 'FROM particulier '
                . 'WHERE id = '.$idParticulier;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $particulier) {
            $particulier[] = new Particulier($particulier[0], $particulier[1], $particulier[2]);
        }
    }
    
    public function addParticulier($particulier){
        $query = 'INSERT INTO particulier (id, nom, prenom) '
                . 'VALUES ("'.$particulier->getNom().'", "'.$particulier->getPrenom().'")';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateParticulier($particulier){
        $query = 'UPDATE particulier '
                . 'SET nom = "'.$particulier->getNom().'", prenom = "'.$particulier->getPrenom().'" '
                . 'WHERE id = '.$particulier->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteParticulier($particulier){
        $query = 'DELETE FROM particulier '
                . 'WHERE id = '.$particulier->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
