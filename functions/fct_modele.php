<?php

function infoModele($modeleId){
    $requete = 'SELECT libelle '
            . 'FROM modele '
            . 'WHERE modele.id ='.$modeleId;
    $result = Connexion::query($requete);
    return $result[0][0];
}


function ajoutModele($libelle, $marque){
    $rq = 'INSERT INTO modele (libelle, idMarque) '
            . 'VALUES ("'.$libelle.'",'.$marque.')';
    Connexion::exec($rq);
}