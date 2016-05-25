<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of entrepriseDAO
 *
 * @author Quentin
 */
class entrepriseDAO {
    //put your code here
    function __construct() {
    }
    
    public function entrepriseList(){
        $query = 'SELECT  id, raisonSociale, numeroSiret '
                . 'FROM entreprise';
        $arrayEntreprises = Connection::query($query);
        foreach ($arrayEntreprises as $entreprise) {
            $entreprises[] = new Entreprise($entreprise[0], $entreprise[1], $entreprise[2]);
        }
        return $entreprises;
    }
    
    public function entrepriseDetails($entrepriseId){
        $query = 'SELECT  id, raisonSociale, numeroSiret '
                . 'FROM entreprise '
                . 'WHERE id = '.$entrepriseId;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $entreprise) {
            $entreprise[] = new Entreprise($entreprise[0], $entreprise[1], $entreprise[2]);
        }
    }
    
    public function addEntreprise(Entreprise $entreprise){
        $query = 'INSERT INTO entreprise (raisonSociale, numeroSiret) '
                . 'VALUES ("'.$entreprise->getRaisonSociale().'", "'.$entreprise->getNumeroSiret().')';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateEntreprise(Entreprise $entreprise){
        $query = 'UPDATE entreprise '
                . 'SET raisonSociale = "'.$entreprise->getRaisonSociale.'", numeroSiret = "'.$entreprise->getNumeroSiret().'" '
                . 'WHERE id = '.$entreprise->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteEntreprise(Entreprise $entreprise){
        $query = 'DELETE FROM entreprise '
                . 'WHERE id = '.$entreprise->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
