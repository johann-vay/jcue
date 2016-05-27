<?php

function formulaireTypeContrat($typeContrat) {

    $html = '<form action=".?page=validationFormulaireTypeContrat" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Libelle', 'libelle')
            . btnSubmit()
            . '</form>';
    return $html;
}

