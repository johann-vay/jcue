<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of personnelDAO
 *
 * @author Quentin
 */
class personnelDAO {
    //put your code here
    function __construct() {
    }
    
    public function personnelList(){
        $query = 'SELECT  id, nom, prenom'
                . 'FROM personnel';
        $arrayPersonnels = Connection::query($query);
        foreach ($arrayPersonnels as $personnel) {
            $personnels[] = new Personnel($personnel[0], $personnel[1], $personnel[2]);
        }
        return $personnels;
    }
    
    public function personnelDetails($personnel){
        $query = 'SELECT  id, nom, prenom'
                . 'FROM personnel '
                . 'WHERE id = '.$personnel;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $personnel) {
            $personnel[] = new Personnel($personnel[0], $personnel[1], $personnel[2]);
        }
    }
}
