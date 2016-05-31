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
    
    public function offresList($idUilisateur){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre ';
        $arrayOffres = Connection::query($query);
        if (!empty($arrayOffres)){
            foreach ($arrayOffres as $offre) {
                $objetOffre = new Offre($offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6], $offre[0]);
                $offres[] = $objetOffre;
            }
            return $offres;
        }
        
    }
    public function offresNonPostuleesList($idUilisateur){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre '
                . 'WHERE offre.id NOT IN ( SELECT postuler.id_offre '
                                        . 'FROM postuler '
                                        . 'WHERE postuler.id_utilisateur = '.$idUilisateur.')';
        $arrayOffres = Connection::query($query);
        if (!empty($arrayOffres)){
            foreach ($arrayOffres as $offre) {
                $objetOffre = new Offre($offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6], $offre[0]);
                $offres[] = $objetOffre;
            }
            return $offres;
        }
        
    }
    public function offresPostuleesList($idUilisateur){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre '
                . 'WHERE offre.id IN ( SELECT postuler.id_offre '
                                        . 'FROM postuler '
                                        . 'WHERE postuler.id_utilisateur = '.$idUilisateur.')';
        $arrayOffres = Connection::query($query);
        if (!empty($arrayOffres)){
            foreach ($arrayOffres as $offre) {
                $objetOffre = new Offre($offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6], $offre[0]);
                $offres[] = $objetOffre;
            }
            return $offres;
        }
        
    }
    
    public function offresProposeesList($idEntreprise){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre '
                . 'WHERE offre.id_utilisateur = '.$idEntreprise;
        $arrayOffres = Connection::query($query);
        if (!empty($arrayOffres)){
            foreach ($arrayOffres as $offre) {
                $objetOffre = new Offre($offre[1], $offre[2], $offre[3], $offre[4], $offre[5], $offre[6], $offre[0]);
                $offres[] = $objetOffre;
            }
            return $offres;
        }
        
    }
    
    public function offreDetails($offre){
        $query = 'SELECT  id, libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat '
                . 'FROM offre '
                . 'WHERE id = '.$offre;
        $arrayDetails = Connection::query($query);
        $offre = new Offre($arrayDetails[0][1], $arrayDetails[0][2], $arrayDetails[0][3], $arrayDetails[0][4], $arrayDetails[0][5], $arrayDetails[0][6], $arrayDetails[0][0]);
        
        return $offre;
    }
    public function addOffre($offre){
        $query = 'INSERT INTO offre (libelle, duree, descriptionMission, dateDebut, id_utilisateur, id_typeContrat) '
                . 'VALUES ("'.$offre->getLibelle().'", "'.$offre->getDuree().'", "'.$offre->getDescriptionMission().'", '
                . '"'.$offre->getDateDebut().'", '.$offre->getId_utilisateur().', '.$offre->getId_typeContrat().')';
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
    
    public function nbOffresEntreprise($idUtilisateur){
        $query = 'SELECT COUNT(id) '
                . 'FROM offre '
                . 'WHERE id_utilisateur = '.$idUtilisateur;
        $result = Connection::query($query);
        return $result[0][0];
    }
    
    public function nbOffresNonPostulees($idUtilisateur){
        $query = 'SELECT COUNT(offre.id) '
                . 'FROM offre '
                . 'WHERE offre.id NOT IN (SELECT postuler.id_offre '
                                        . 'FROM postuler '
                                        . 'WHERE postuler.id_utilisateur = '.$idUtilisateur.')';
        $result = Connection::query($query);
        return $result[0][0];
    }
}
