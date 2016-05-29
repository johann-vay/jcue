<?php

function formulaireAjoutCv(){
    $cv = new Cv(NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireCv($cv);
}

function formulaireModificationCv($idCv){
    $cvDAO = new cvDAO();
    $cv = $cvDAO->cvDetails($idCv);
    return formulaireCv($cv);
}
function formulaireCv($cv) {

    $html = '<form action=".?page=validationFormulaireCv" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$cv->getId().'">'
            . champTexte('Titre', 'titre', $cv->getTitre())
            . champTexte('Langue parlée','langueParlee', $cv->getLangueParlee())
            . champTexte('Langue écrite','langueEcrite', $cv->getLangueEcrite())
            . champTexte('Centre d\'intérêts','centreInteret', $cv->getCentreInterets())
            . champTexte('Compétences','competences', $cv->getCompetences())
            . btnSubmit('validerCV')
            . '</form>';
    return $html;
}
