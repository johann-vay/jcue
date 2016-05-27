<?php

function formulairePersonnel($personnel) {

    $html = '<form action=".?page=validationFormulairePersonnel" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Nom', 'nom')
            . champTexte('Prénom','prenom')
            . btnSubmit()
            . '</form>';
    return $html;
}
