<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of particulierDAO
 *
 * @author Quentin
 */
class particulierDAO {
    //put your code here
    function __construct() {
    }
    
    public function particulierList(){
        $query = 'SELECT  id, nom, prenom'
                . 'FROM particulier';
        $arrayParticuliers = Connection::query($query);
        foreach ($arrayParticuliers as $particulier) {
            $particuliers[] = new Particulier($particulier[0], $particulier[1], $particulier[2]);
        }
        return $particuliers;
    }
    
    public function particulierDetails($particulier){
        $query = 'SELECT  id, nom, prenom'
                . 'FROM particulier '
                . 'WHERE id = '.$particulier;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $particulier) {
            $particulier[] = new Particulier($particulier[0], $particulier[1], $particulier[2]);
        }
    }
}
