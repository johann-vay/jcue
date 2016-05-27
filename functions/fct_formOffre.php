<?php

function formulaireOffre($offre) {

    $html = '<form action=".?page=validationFormulaireOffre" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Libelle', 'libelle')
            . champTexte('Durée', 'duree')
            . champTexte('Description mission', 'descriptionMission')
            . champDate('Date début','dateDebut')
            . champSelectQuery('id_utilisateur', 'id_utilisateur', 'SELECT `id` FROM utilisateur',$valeur=null)
            . champSelectQuery('id_typeContrat', 'id_typeContrat', 'SELECT `id` FROM typeContrat',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}
