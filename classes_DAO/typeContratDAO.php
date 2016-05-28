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
                . 'FROM typeContrat';
        $arrayTypeContrats = Connection::query($query);
        foreach ($arrayTypeContrats as $typeContrat) {
            $typeContrats[] = new TypeContrat($typeContrat[0], $typeContrat[1]);
        }
        return $typeContrats;
    }
    
    public function typeContratDetails($typeContrat){
        $query = 'SELECT  id, libelle '
                . 'FROM typeContrat '
                . 'WHERE id = '.$typeContrat;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $typeContrat) {
            $typeContrat[] = new TypeContrat($typeContrat[0], $typeContrat[1]);
        }
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
