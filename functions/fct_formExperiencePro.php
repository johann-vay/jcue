<?php

function formulaireExperiencePro($experiencePro) {

    $html = '<form action=".?page=validationFormulaireExperiencePro" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Lieu', 'lieu')
            . champDate('Date début','dateDebut')
            . champDate('Date fin','dateFin')
            . champTexte('Durée','duree')
            . champTexte('Poste occupé','posteOccupe')
            . champTexte('Description mission','descriptionMission')
            . champSelectQuery('id_cv', 'id_cv', 'SELECT `id` FROM cv',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}