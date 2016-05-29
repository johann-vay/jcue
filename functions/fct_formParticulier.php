<?php

function formulaireAjoutParticulier(){
    $particulier = new Particulier(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireParticulier($particulier);
}

function formulaireModificationParticulier($idParticulier){
    $particulierDAO = new particulierDAO();
    $particulier = $particulierDAO->particulierDetails($idParticulier);
    return formulaireParticulier($particulier);
}
    
function formulaireParticulier($particulier) {

    $html = '<form action=".?page=validationFormulaireParticulier" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$particulier->getId().'">'
            . champTexte('Libellé', 'libelle', $particulier->getLibelle())
            . champTexte('Durée','duree', $particulier->getDuree())
            . champTexte('Decription mission','descriptionMission', $particulier->getDecriptionMission())
            . champDate('Date début','dateDebut', $particulier->getDateDebut())
            . champSelectQuery('Type Contrat', 'id_typeContrat', 'SELECT `id` FROM typeContrat',$valeur=null)
            . btnSubmit('validerParticulier')
            . '</form>';
    return $html;
}
