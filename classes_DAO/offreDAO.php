<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of offreDAO
 *
 * @author Quentin
 */
class offreDAO {
    //put your code here
    function __construct() {
    }
    
    public function offreList(){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre';
        $arrayOffres = Connection::query($query);
        $offres = [];
        foreach ($arrayOffres as $offre) {
            $offres = new Offre($offre[0], $offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6]);
        }
        return $offres;
    }
    
    public function offreDetails($offre){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre '
                . 'WHERE id = '.$offre;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $offre) {
            $offre[] = new Offre($offre[0], $offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6]);
        }
    }
    public function addOffre($offre){
        $query = 'INSERT INTO offre (id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat) '
                . 'VALUES ("'.$offre->getLibelle().'", "'.$offre->getDuree().'", "'.$offre->getDescriptionMission().'", '
                . '"'.$offre->getDateDebut().'", "'.$offre->getId_utilisateur().'", '.$offre->getId_typeContrat().')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateOffre($offre){
        $query = 'UPDATE offre '
                . 'SET lieu = "'.$offre->getLibelle().'", duree = "'.$offre->getDuree().'", descriptionMission = "'.$offre->getDescriptionMission().'", '
                . 'dateDebut = "'.$offre->getDateDebut().'", id_utilisateur = "'.$offre->getId_utilisateur().'", id_typeContrat = "'.$offre->getId_typeContrat().'" '
                . 'WHERE id = '.$offre->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteOffre($offre){
        $query = 'DELETE FROM offre '
                . 'WHERE id = '.$offre->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
