<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cvDAO
 *
 * @author Quentin
 */
class cvDAO {
    

    function __construct() {
    }
    
    public function cvList(){
        $query = 'SELECT  id, titre, langueParlee, langueEcrite, centreInterets, competences, id_utilisateur '
                . 'FROM cv';
        $arrayCv = Connection::query($query);
        foreach ($arrayCv as $cv) {
            $cvs[] = new Cv($cv[0], $cv[1], $cv[2], $cv[3], $cv[4], $cv[5], $cv[6]);
        }
        return $cvs;
    }
    
    public function cvDetails($cvId){
        $query = 'SELECT  id, titre, langueParlee, langueEcrite, centreInterets, competences, id_utilisateur '
                . 'FROM cv '
                . 'WHERE id = '.$cvId;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $cv) {
            $cv[] = new Cv($cv[0], $cv[1], $cv[2], $cv[3], $cv[4], $cv[5], $cv[6]);
        }
    }
    
    
    public function addCV($cv){
        $query = 'INSERT INTO cv (titre, langueParlee, langueEcrite, centreInterets, competences, id_utilisateur) '
                . 'VALUES ("'.$cv->getTitre().'", "'.$cv->getLangueParlee().'", "'.$cv->getLangueEcrite().'", '
                . '"'.$cv->getCentreInterets().'", "'.$cv->getCompetences().'", '.$cv->getId_utilisateur().')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateCV($cv){
        $query = 'UPDATE cv '
                . 'SET titre = "'.$cv->getTitre().'", langueParlee = "'.$cv->getLangueParlee().'", langueEcrite = "'.$cv->getLangueEcrite().'", '
                . 'centreInterets = "'.$cv->getCentreInterets().'", competences = "'.$cv->getCompetences().'" '
                . 'WHERE id = '.$cv->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteCV($cv){
        $query = 'DELETE FROM cv '
                . 'WHERE id = '.$cv->getId();
        $result = Connection::exec($query);
        return $result;
    }
}