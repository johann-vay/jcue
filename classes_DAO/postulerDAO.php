<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of postulerDAO
 *
 * @author Quentin
 */
class postulerDAO {
    //put your code here
    function __construct() {
    }
    
    public function postulerList(){
        $query = 'SELECT  id, id_offre '
                . 'FROM postuler';
        $arrayPostulers = Connection::query($query);
        foreach ($arrayPostulers as $postuler) {
            $postulers[] = new Postuler($postuler[0], $postuler[1]);
        }
        return $postulers;
    }
    
    public function postulerDetails($postuler){
        $query = 'SELECT  id, id_offre '
                . 'FROM postuler '
                . 'WHERE id = '.$postuler;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $postuler) {
            $postuler[] = new Postuler($postuler[0], $postuler[1]);
        }
    }
    
    public function addPostule($postuler){
        $query = 'INSERT INTO postuler (id_utilisateur, id_offre) '
                . 'VALUES ('.$postuler->getIdUtilisateur().', '.$postuler->getId_offre.')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updatePostuler($postuler){
        $query = 'UPDATE postulert '
                . 'SET id_utilisateur = '.$postuler->getIdUtilisateur().', id_offre = '.$postuler->getId_offre()
                . 'WHERE id = '.$postuler->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deletePostuler($postuler){
        $query = 'DELETE FROM postuler '
                . 'WHERE id_utilisateur = '.$postuler->getIdUtilisateur()
                . 'AND id_offre = '.$postuler->getId_offre();
        $result = Connection::exec($query);
        return $result;
    }
}
