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
        $query = 'SELECT  id, lieu, dateDebut, duree, posteOccupe, descriptionMission, id_cv '
                . 'FROM experiencepro';
        $arrayExperiencePros = Connection::query($query);
        foreach ($arrayExperiencePros as $experiencePro) {
            $experiencePros[] = new ExperiencePro($experiencePro[0], $experiencePro[1], $experiencePro[2], $experiencePro[3], $experiencePro[4], $experiencePro[5], $experiencePro[6]);
        }
        return $experiencePros;
    }
    
    public function experienceProDetails($experiencePro){
        $query = 'SELECT  id, lieu, dateDebut, duree, posteOccupe, descriptionMission, id_cv '
                . 'FROM experiencepro '
                . 'WHERE id = '.$experiencePro;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $experiencePro) {
            $experiencePro[] = new ExperiencePro($experiencePro[0], $experiencePro[1], $experiencePro[2], $experiencePro[3], $experiencePro[4], $experiencePro[5], $experiencePro[6]);
        }
    }
    
}
