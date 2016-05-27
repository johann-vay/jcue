<?php

function formulairePostuler($postuler) {

    $html = '<form action=".?page=validationFormulairePostuler" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champSelectQuery('id_utilisateur', 'id_utilisateur', 'SELECT `id` FROM utilisateur',$valeur=null)
            . champSelectQuery('id_offre', 'id_offre', 'SELECT `id` FROM offre',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}
