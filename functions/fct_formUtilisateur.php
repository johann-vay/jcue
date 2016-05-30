<?php

function formulaireUser($user) {

    $html = '<form action=".?page=validationFormulaireUser" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Adresse', 'adresse')
            . champTexte('Code Postal','codePostal')
            . champTexte('Ville','ville')
            . champTexte('Mail','mail')
            . champTexte('Téléphone','telephone')
            . champTexte('Login','login')
            . champTexte('Mot de passe', 'password',"",'password')
            . champTexte('Type','type')
            . btnSubmit()
            . '</form>';
    return $html;
}

function lienParticulier($particulierId) {
    $html = '<a href=".?page=particuliere&particulierId=' . $particulierId . '"><i class="fa fa-eye"></i></a>';
    return $html;
}

function saltHash($password){
    $prefixe ='Gz55ZEf6F';
    $suffixe ='ZERqg48D77d';
    $passwordHash = openssl_digest($prefixe.$password.$suffixe, 'sha256');
    
    return $passwordHash;
}