<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of experienceProDAO
 *
 * @author Quentin
 */
class experienceProDAO {
    //put your code here
    
    function __construct() {
    }
    
    public function experienceProList(){
        $query = 'SELECT  id, lieu, dateDebut, duree, posteOccupe, descriptionMission, id_experiencePro '
                . 'FROM experiencepro';
        $arrayExperiencePros = Connection::query($query);
        foreach ($arrayExperiencePros as $experiencePro) {
            $experiencePros[] = new ExperiencePro($experiencePro[0], $experiencePro[1], $experiencePro[2], $experiencePro[3], $experiencePro[4], $experiencePro[5], $experiencePro[6]);
        }
        return $experiencePros;
    }
    
    public function experienceProDetails($experiencePro){
        $query = 'SELECT  id, lieu, dateDebut, duree, posteOccupe, descriptionMission, id_experiencePro '
                . 'FROM experiencepro '
                . 'WHERE id = '.$experiencePro;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $experiencePro) {
            $experiencePro[] = new ExperiencePro($experiencePro[0], $experiencePro[1], $experiencePro[2], $experiencePro[3], $experiencePro[4], $experiencePro[5], $experiencePro[6]);
        }
    }
    
    public function addExperiencePro($experiencePro){
        $query = 'INSERT INTO experiencepro (id, lieu, dateDebut, duree, posteOccupe, descriptionMission, id_experiencePro) '
                . 'VALUES ("'.$experiencePro->getLieu().'", "'.$experiencePro->getDateDebut().'", "'.$experiencePro->getDuree().'", '
                . '"'.$experiencePro->getPosteOccupe().'", "'.$experiencePro->getDescriptionMission().'", '.$experiencePro->getId_experiencePro().')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateExeperiencePro($experiencePro){
        $query = 'UPDATE experiencepro '
                . 'SET lieu = "'.$experiencePro->getLieu().'", dateDebut = "'.$experiencePro->getDateDebut().'", duree = "'.$experiencePro->getDuree().'", '
                . 'posteOccupe = "'.$experiencePro->getPosteOccupe().'", descriptionMission = "'.$experiencePro->getDescriptionMission().'", id_experiencePro = "'.$experiencePro->getId_experiencePro().'" '
                . 'WHERE id = '.$experiencePro->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteCV($experiencePro){
        $query = 'DELETE FROM experiencePro '
                . 'WHERE id = '.$experiencePro->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
}
