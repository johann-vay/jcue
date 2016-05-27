<?php

function formulaireParticulier($particulier) {

    $html = '<form action=".?page=validationFormulaireParticulier" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Nom', 'nom')
            . champTexte('Prénom','prenom')
            . champTexte('URL CV vidéo','urlVideo')
            . champSelectQuery('id_cv', 'id_cv', 'SELECT `id` FROM cv',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}
