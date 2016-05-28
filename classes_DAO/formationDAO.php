<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of formationDAO
 *
 * @author Quentin
 */
class formationDAO {
    //put your code here
    
    function __construct() {
    }
    
    public function formationList(){
        $query = 'SELECT  id, intitule, anneeDebut, anneeFin, nomEtablissement, villeEtablissement, diplomeVise, diplomeObtenu, id_cv '
                . 'FROM formation';
        $arrayFormations = Connection::query($query);
        foreach ($arrayFormations as $formation) {
            $formations[] = new Formation($formation[0], $formation[1], $formation[2], $formation[3], $formation[4], $formation[5], $formation[6], $formation[7], $formation[8]);
        }
        return $formations;
    }
    
    public function formationDetails($formation){
        $query = 'SELECT  id, intitule, anneeDebut, anneeFin, nomEtablissement, villeEtablissement, diplomeVise, diplomeObtenu, id_cv '
                . 'FROM formation '
                . 'WHERE id = '.$formation;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $formation) {
            $formation[] = new Formation($formation[0], $formation[1], $formation[2], $formation[3], $formation[4], $formation[5], $formation[6], $formation[7], $formation[8]);
        }
    }
    public function addFormation($formation){
        $query = 'INSERT INTO formation (id, intitule, anneeDebut, anneeFin, nomEtablissement, villeEtablissement, diplomeVise, diplomeObtenu, id_cv) '
                . 'VALUES ("'.$formation->getNomEtablissement().'", "'.$formation->getVilleEtablissement().'", "'.$formation->getDiplomeVise().'", '
                . '"'.$formation->getDiplomeObtenu().'", "'.$formation->getId_cv().'")';
        $result = Connection::exec($query);
        return $result;
    }
    
    public function updateFormation($formation){
        $query = 'UPDATE formation '
                . 'SET intitule = "'.$formation->getIntitule().'", anneeDebut = "'.$formation->getAnneeDebut().'", anneeFin = "'.$formation->getAnneeDebut().'", '
                . 'nomEtablissement = "'.$formation->getNomEtablissement().'", villeEtablissement = "'.$formation->getVilleEtablissement().'", diplomeVise = "'.$formation->getDiplomeVise().'", diplomeObtenu = "'.$formation->getDiplomeObtenu().'", id_cv = "'.$formation->getId_cv().'" '
                . 'WHERE id = '.$formation->getId();
        $result = Connection::exec($query);
        return $result;
    }
    
    public function deleteFormation($formation){
        $query = 'DELETE FROM formation '
                . 'WHERE id = '.$formation->getId();
        $result = Connection::exec($query);
        return $result;
    }
}
