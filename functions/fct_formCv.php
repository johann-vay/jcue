<?php
function formulaireCv($cv) {

    $html = '<form action=".?page=validationFormulaireCv" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Titre', 'titre')
            . champTexte('Langue parlée','langueParlee')
            . champTexte('Langue écrite','langueEcrite')
            . champTexte('Centre d\'intérêts','centreInteret')
            . champTexte('Compétences','competences')
            . champSelectQuery('id_utilisateur', 'id_utilisateur', 'SELECT `id`,`login` FROM utilisateur',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}
