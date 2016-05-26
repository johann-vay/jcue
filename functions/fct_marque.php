<?php

function infoMarque($marqueId){
    $requete = 'SELECT libelle '
            . 'FROM marque '
            . 'WHERE marque.id ='.$marqueId;
    $result = Connexion::query($requete);
    return $result[0][0];
}