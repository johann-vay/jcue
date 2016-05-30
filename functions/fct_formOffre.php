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
    $typeContratDAO = new typeContratDAO();
    $listeTypesContrat = $typeContratDAO->typeContratList();

    $html = '<form action="" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$offre->getId().'">'
            . champTexte('Libellé', 'libelle', $offre->getLibelle())
            . champTexte('Durée','duree', $offre->getDuree())
            . champTexte('Decription mission','descriptionMission', $offre->getDescriptionMission())
            . champDate('Date début','dateDebut', $offre->getDateDebut())
            . champSelect('Type contrat', 'idTypeContrat', $listeTypesContrat, $offre->getId_typeContrat())
            . btnSubmit('validerOffre')
            . '</form>';
    return $html;
}
