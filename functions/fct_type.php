<?php

function infoType($typeId){
    $requete = 'SELECT libelle '
            . 'FROM typebateau '
            . 'WHERE typebateau.id ='.$typeId;
    $result = Connexion::query($requete);
    return $result[0][0];
}