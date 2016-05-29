<?php

function formulaireAjoutOffre(){
    $offre = new Offre(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireOffre($offre);
}

function formulaireModificationOffre($idOffre){
    $offreDAO = new offreDAO();
    $offre = $offreDAO->offreDetails($idOffre);
    return formulaireOffre($offre);
}
    
function formulaireOffre($offre) {

    $html = '<form action=".?page=validationFormulaireOffre" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$offre->getId().'">'
            . champTexte('Libellé', 'libelle', $offre->getLibelle())
            . champTexte('Durée','duree', $offre->getDuree())
            . champTexte('Decription mission','descriptionMission', $offre->getDecriptionMission())
            . champDate('Date début','dateDebut', $offre->getDateDebut())
            . champSelectQuery('Type Contrat', 'id_typeContrat', 'SELECT `id` FROM typeContrat',$valeur=null)
            . btnSubmit('validerOffre')
            . '</form>';
    return $html;
}
