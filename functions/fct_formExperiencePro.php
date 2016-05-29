<?php

function formulaireAjoutExperiencePro(){
    $experiencePro = new ExperiencePro(NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireExperiencePro($experiencePro);
}

function formulaireModificationExperiencePro($idExperiencePro){
    $experienceProDAO = new experienceProDAO();
    $experiencePro = $experienceProDAO->experienceProDetails($idExperiencePro);
    return formulaireExperiencePro($experiencePro);
}

function formulaireExperiencePro($experiencePro) {

    $html = '<form action=".?page=validationFormulaireExperiencePro" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$experiencePro->getId().'">'
            . champTexte('Lieu', 'lieu', $experiencePro->getLieu())
            . champDate('Date début','dateDebut', $experiencePro->getDateDebut())
            . champDate('Date fin','dateFin', $experiencePro->getDateFin())
            . champTexte('Durée','duree', $experiencePro->getDuree())
            . champTexte('Poste occupé','posteOccupe', $experiencePro->getPosteOccupe())
            . champTexte('Description mission','descriptionMission', $experiencePro->getDescriptionMission())
            . btnSubmit('validerExperiencePro')
            . '</form>';
    return $html;
}