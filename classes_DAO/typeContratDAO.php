<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of typeContratDAO
 *
 * @author Quentin
 */
class typeContratDAO {
    //put your code here
    function __construct() {
    }
    
    public function typeContratList(){
        $query = 'SELECT  id, libelle '
                . 'FROM typecontrat';
        $arrayTypeContrats = Connection::query($query);
        foreach ($arrayTypeContrats as $typeContrat) {
            $typeContrats[] = new TypeContrat($typeContrat[1], $typeContrat[0]);
        }
        return $typeContrats;
    }
    
    public function typeContratDetails($idTypeContrat){
        $query = 'SELECT  id, libelle '
                . 'FROM typecontrat '
                . 'WHERE id = '.$idTypeContrat;
        $arrayDetails = Connection::query($query);
        $typeContrat = new TypeContrat($arrayDetails[0][1], $arrayDetails[0][0]);
        return $typeContrat;
    }
    
     public function addTypeContrat($typeContrat){
        $query = 'INSERT INTO typecontrat (libelle) '
                . 'VALUES ("'.$typeContrat->getLibelle().'")';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateTypeContrat($typeContrat){
        $query = 'UPDATE typecontrat '
                . 'SET libelle = "'.$typeContrat->getLibelle().'" '
                . 'WHERE id = '.$typeContrat->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteTypeContrat($typeContrat){
        $query = 'DELETE FROM typecontrat '
                . 'WHERE id = '.$typeContrat->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
