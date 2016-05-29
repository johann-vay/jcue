<?php

function formulaireAjoutFormation(){
    $formation = new Formation(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireFormation($formation);
}

function formulaireModificationFormation($idFormation){
    $formationDAO = new formationDAO();
    $formation = $formationDAO->formationDetails($idFormation);
    return formulaireFormation($formation);
}

function formulaireFormation($formation) {

    $html = '<form action=".?page=validationFormulaireFormation" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$formation->getId().'">'
            . champTexte('Intitulé', 'intitule', $formation->getIntitule())
            . champDate('Année début','anneeDebut', $formation->getAnneeDebut())
            . champDate('Année fin','anneeFin', $formation->getAnneeFin())
            . champTexte('Nom établissement','nomEtablissement', $formation->getNomEtablissement())
            . champTexte('Ville établissement','villeEtablissement', $formation->getVilleEtablissement())
            . champTexte('Diplôme visé','diplomeVise', $formation->getDiplomeVise())
            . champTexte('Diplôme obtenu','diplomeObtenu', $formation->getDiplomeObtenu())
            . btnSubmit('validerFormation')
            . '</form>';
    return $html;
}

