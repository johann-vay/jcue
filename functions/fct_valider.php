<?php
function infoValidation($ficheId){
    $requete = 'SELECT validationTechnique, validationCouts, validationDelais, validationQualite, '
                    . 'validationCommerciale, validationDirection, dateValidationTech, dateValidationCoutsDelais, dateValidationQualite, dateValidationCommerciale, '
                    . 'dateValidationDirection, commentaires, '
                    . 'majPlanFourn, majNomenc, majModeOp, dateActionBE, planTransmis, commandeModif, reintPrev, noLR, dateActionLog, '
                    . 'commentairesAction '
        . 'FROM valider '
        . 'WHERE idValidationFiche ='.$ficheId;
    $result = Connexion::query($requete);
    if (!empty($result)){
        return $result[0];
    }
    

}

function formulaireValiderBE() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireBE&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            //<input type="hidden" name="id" value="' . $fiche[6] . '">'
            .'<fieldset><legend>BE + expert métier (si besoin)</legend>'
            . champSelectOuiNon('Validation Technique', 'validTech')
            . textArea('Commentaires', 'commentValiderTech')
            . btnSubmit('validerValidBE')
            . '</fieldset></form>';
    return $html;
}

function ajouterValiderBE($ficheId, $dateValidationTech, $validationTech, $commentaires) {
    $query = 'INSERT INTO valider SET idValidationFiche=' . $ficheId . ', dateValidationTech="' . $dateValidationTech . '", '
            .'validationTechnique=' . $validationTech . ', commentaires="' . $commentaires . '"';
    return Connexion::exec($query);
}

function formulaireValiderOperationnel() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireOperationnel&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            //<input type="hidden" name="id" value="' . $fiche[6] . '">'
            .'<fieldset><legend>Opérationnel</legend>'
            . champSelectOuiNon('Validation Coûts', 'validCouts')
            . champSelectOuiNon('Validation Délais', 'validDelais')
            . textArea('Commentaires', 'commentValiderOperationnel')
            . btnSubmit('validerValidOperationnel')
            . '</fieldset></form>';
    return $html;
}

function ajouterValiderOperationnel($ficheId, $dateValidationCoutsDelais, $validationCouts, $validationDelais, $commentaires) {
    $query = 'UPDATE valider SET dateValidationCoutsDelais="' . $dateValidationCoutsDelais . '", '
            .'validationCouts=' . $validationCouts . ', validationDelais='.$validationDelais.', commentaires=CONCAT(commentaires, " // ' . $commentaires . '") '
            .'WHERE idValidationFiche='.$ficheId;
    return Connexion::exec($query);
}

function formulaireValiderSAV() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireQualite&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            //<input type="hidden" name="id" value="' . $fiche[6] . '">'
            .'<fieldset><legend>SAV / Qualité</legend>'
            . champSelectOuiNon('Validation Qualité', 'validQualite')
            . textArea('Commentaires', 'commentValiderQualite')
            . btnSubmit('validerValidSAV')
            . '</fieldset></form>';
    return $html;
}

function ajouterValiderSAV($ficheId, $dateValidationQualite, $validationQualite, $commentaires) {
    $query = 'UPDATE valider SET  dateValidationQualite="' . $dateValidationQualite . '", '
            .'validationQualite=' . $validationQualite. ', commentaires=CONCAT(commentaires, " // ' . $commentaires . '") '
            .'WHERE idValidationFiche ='.$ficheId;
    return Connexion::exec($query);
}

function formulaireValiderComm() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireCommerciale&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            //<input type="hidden" name="id" value="' . $fiche[6] . '">'
            .'<fieldset><legend>Commerce</legend>'
            . champSelectOuiNon('Validation Commerciale / Client', 'validComm')
            . textArea('Commentaires', 'commentValiderCommerciale')
            . btnSubmit('validerValidComm')
            . '</fieldset></form>';
    return $html;
}

function ajouterValiderComm($ficheId, $dateValidationCommerciale, $validationCommerciale, $commentaires) {
    $query = 'UPDATE valider SET dateValidationCommerciale="' . $dateValidationCommerciale . '", '
            .'validationCommerciale=' . $validationCommerciale . ', commentaires=CONCAT(commentaires, " // ' . $commentaires . '") '
            .'WHERE idValidationFiche ='.$ficheId;
    return Connexion::exec($query);
}

function formulaireValiderDirection() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireDirection&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            //<input type="hidden" name="id" value="' . $fiche[6] . '">'
            .'<fieldset><legend>Direction</legend>'
            . champSelectOuiNon('Validation Direction', 'validDirection')
            . textArea('Commentaires', 'commentValiderDirection')
            . btnSubmit('validerValidDirection')
            . '</fieldset></form>';
    return $html;
}

function ajouterValiderDirection($ficheId, $dateValidationDirection, $validationDirection, $commentaires) {
    $query = 'UPDATE valider SET dateValidationDirection="' . $dateValidationDirection . '", '
            .'validationDirection=' . $validationDirection . ', commentaires=CONCAT(commentaires, " // ' . $commentaires . '") '
            .'WHERE idValidationFiche ='.$ficheId;
    return Connexion::exec($query);
}


function ouiNonExport($booleen){
    if ($booleen == 1){
        return 'OUI';
    } elseif ($booleen == 0){
        return 'NON';
    }
}




function formulaireValiderActionBE() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireActionBE&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            .'<fieldset><legend>BE - GDT</legend>'
            . champSelectOuiNA('MAJ plan fournisseur', 'majPlanFourn')
            . champSelectOuiNA('MAJ nomenclature', 'majNomenc')
            . champSelectOuiNA('MAJ mode op. atelier', 'majModeOp')
            . textArea('Commentaires', 'commentValiderActionBE')
            . btnSubmit('validerActionBE')
            . '</fieldset></form>';
    return $html;
}


function formulaireValiderActionLog() {
    $ficheId = $_GET['ficheId'];
    $html = '<form action=".?page=validationFormulaireActionLog&ficheId='.$ficheId.'" method="POST" class="form-horizontal">'
            .'<fieldset><legend>Logistique</legend>'
            . champSelectOuiNA('Plan transmis au fournisseur', 'planTransmis')
            . champSelectOuiNA('Commande modifiée et envoyée', 'commandeModif')
            . champSelectOuiNA('Réintégration. à prévoir', 'reintPrev')
            . champTexte('LR N°', 'noLR')
            . textArea('Commentaires', 'commentValiderActionLog')
            . btnSubmit('validerActionLog')
            . '</fieldset></form>';
    return $html;
}


function ouiNAExport($booleen){
    if ($booleen == 1){
        return 'OUI';
    } elseif ($booleen == 0){
        return 'N/A';
    }
}

function ajoutActionBE  ($ficheId, $majPlanFourn, $majNomenc, $majModeOp, $dateActionBE, $commentaires){
    $query = 'UPDATE valider SET dateActionBE="' . $dateActionBE . '", '
            .'majPlanFourn=' . $majPlanFourn . ', majNomenc=' . $majNomenc . ', majModeOp=' . $majModeOp . ', commentairesAction="' . $commentaires . '" '
            .'WHERE idValidationFiche ='.$ficheId;
    return Connexion::exec($query);
}

function ajoutActionLog  ($ficheId, $planTransmis, $commandeModif, $reintPrev, $noLR, $dateActionLog, $commentaires){
    $query = 'UPDATE valider SET dateActionLog="' . $dateActionLog . '", '
            .'planTransmis=' . $planTransmis . ', commandeModif=' . $commandeModif . ', '
            .'reintPrev=' . $reintPrev . ', noLR=' . $noLR . ', commentairesAction=CONCAT(commentairesAction, " // ' . $commentaires . '") '
            .'WHERE idValidationFiche ='.$ficheId;
    return Connexion::exec($query);
}