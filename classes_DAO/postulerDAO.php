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
        $query = 'SELECT  id_utilisateur, id_offre '
                . 'FROM postuler';
        $arrayPostulers = Connection::query($query);
        foreach ($arrayPostulers as $postuler) {
            $postulers[] = new Postuler($postuler[0], $postuler[1]);
        }
        return $postulers;
    }
    
    public function postulerDetails($idUtilisateur){
        $query = 'SELECT  id_utilisateur, id_offre '
                . 'FROM postuler '
                . 'WHERE id_utilisateur = '.$idUtilisateur;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $postuler) {
            $postuler[] = new Postuler($postuler[0], $postuler[1]);
        }
    }
    
    public function offrePostulee($idUtilisateur, $idOfrre){
        $query = 'SELECT COUNT(id_offre) '
                . 'FROM postuler '
                . 'WHERE id_offre = '.$idOfrre.' '
                . 'AND id_utilisateur = '.$idUtilisateur;
        $result = Connection::query($query);
        if ($result[0][0] == 1){
            return true;
        } else {
            return false;
        }
    }
    
    public function addPostuler($postuler){
        $query = 'INSERT INTO postuler (id_utilisateur, id_offre) '
                . 'VALUES ('.$postuler->getIdUtilisateur().', '.$postuler->getId_offre().')';
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
    
    function nbOffresPostulees($idUtilisateur){
        $query = 'SELECT COUNT(id_utilisateur) '
                . 'FROM postuler '
                . 'WHERE id_utilisateur = '.$idUtilisateur;
        $result = Connection::query($query);
        return $result[0][0];
    }
    
    public function postulants($idOffre){
        $userDAO = new UserDAO();
        $query = 'SELECT id_utilisateur '
                . 'FROM postuler '
                . 'WHERE id_offre = '.$idOffre;
        $arrayPostulants = Connection::query($query);
        foreach ($arrayPostulants as $idPostulant) {
            $postulants[] = $userDAO->userDetails($idPostulant[0]);
        }
        return $postulants;
    }
}
