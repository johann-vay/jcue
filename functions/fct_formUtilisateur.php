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