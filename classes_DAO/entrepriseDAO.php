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
}
