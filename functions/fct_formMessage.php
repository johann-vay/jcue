<?php

function formulaireMessage($message) {

    $html = '<form action=".?page=validationFormulaireMessage" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Contenu', 'contenu')
            . champSelectQuery('id_expediteur', 'id_utilisateur', 'SELECT `id`,`login` FROM utilisateur',$valeur=null)
            . champSelectQuery('id_destinataire', 'id_utilisateur', 'SELECT `id`,`login` FROM utilisateur',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}

