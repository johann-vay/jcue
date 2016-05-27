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

function formulairePassword($userId) {
    $html = '<form action=".?page=perso&userId='.$userId.'" method="POST" class="form-horizontal pull-left col-sm-6">'
            . champTexte('Mot de passe actuel', 'oldPassword',"",'password')
            . champTexte('Nouveau mot de passe', 'newPassword', "", 'password')
            . champTexte('Confirmer le nouveau mot de passe', 'confirmNewPassword', "", 'password')
            . btnSubmit('validerNewPassword')
            . '</form>';
    return $html;
}