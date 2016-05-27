<?php

function formulaireEntreprise($entreprise) {

    $html = '<form action=".?page=validationFormulaireEntreprise" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Raison Sociale', 'raisonSociale')
            . champTexte('Numéro Siret','numeroSiret')
            . btnSubmit()
            . '</form>';
    return $html;
}
