<?php

function formulaireAjoutEntreprise(){
    $entreprise = new Entreprise(null, null);
    return formulaireEntreprise($entreprise);
}

function formulaireModificationEntreprise($idEntreprise){
    $entrepriseDAO = new entrepriseDAO();
    $entreprise = $entrepriseDAO->entrepriseDetails($idEntreprise);
    return formulaireEntreprise($entreprise);
}

function formulaireEntreprise($entreprise) {

    $html = '<form action=".?page=validationFormulaireEntreprise" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$entreprise->getId().'">'
            . champTexte('Raison Sociale', 'raisonSociale', $entreprise->getRaisonSociale())
            . champTexte('Numéro Siret','numeroSiret', $entreprise->getNumeroSiret())
            . btnSubmit('validEntreprise')
            . '</form>';
    return $html;
}
