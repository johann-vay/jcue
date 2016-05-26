<?php
function infoLignesAvModif($ligneId) {
    $requete = 'SELECT id,codeComposant, fournisseur,designation, quantite,unite,stock, prixUnit, prixTotal '
             . 'FROM modification '
             . 'WHERE avantModif=1 '
             . 'AND id=' . $ligneId;
    $result = Connexion::query($requete);
    return $result[0];
}

function infoLignesApModif($ligneId) {
    $requete = 'SELECT id,codeComposant, fournisseur,designation, quantite,unite,stock, prixUnit, prixTotal '
             . 'FROM modification '
             . 'WHERE avantModif=0 '
             . 'AND id=' . $ligneId;
    $result = Connexion::query($requete);
    return $result[0];
}

function tableauAvantModification($ficheId){
    $requete = 'SELECT modification.id, modification.codeComposant, modification.fournisseur, modification.designation, modification.quantite, '
                     .'modification.unite, stock, prixUnit, prixTotal '
            .'FROM modification, fiche '
            .'WHERE modification.idFiche = fiche.id '
            .'AND fiche.id='.$ficheId.' '
            .'AND modification.avantModif=1';
    $results = Connexion::query($requete);
    $totalAvModif = 0;
    $html = '<table class="table table-bordered table-hover dataTable">'
            . '<tr>'
            . '<th>CC</th><th>Fournisseur</th><th>Désignation</th><th>Qté</th><th>Un</th><th>Stk</th><th>Prix Unit.</th><th>Prix total</th>'
            . '<th></th>'
            . '</tr><tbody>';
    foreach ($results as $result) {
        $html.='<tr>';
        $html.='<td>' . $result[1] . '</td>';
        $html.='<td>' . $result[2] . '</td>';
        $html.='<td>' . $result[3] . '</td>';
        $html.='<td>' . $result[4] . '</td>';
        $html.='<td>' . $result[5] . '</td>';
        $html.='<td>' . $result[6] . '</td>';
        $html.='<td>' . $result[7] . ' €</td>';
        $html.='<td>' . $result[8] . ' €</td>';
        $html.='<td>' . lienFormulaireModificationLigneAvModif($result[0]) . '</td>';
        $html.='</tr>';
        $totalAvModif += $result[8];
    }
    $html.='<tr><td colspan="6" ></td><td><div class="pull-right"><b>Total avant modification : </b></div></td><td><b>' . $totalAvModif . ' €</b></td></tr>';
    $html.= '</tbody></table>';
    return $html;
}

function coutGainLie($ficheId){
    $requete1 = 'SELECT SUM(modification.prixTotal) '
              . 'FROM modification '
              . 'WHERE modification.avantModif=1 '
              . 'AND modification.idFiche='.$ficheId;
    $result1 = Connexion::query($requete1);
    $prixTotalAvModif = $result1[0][0];
    
    $requete2 = 'SELECT SUM(modification.prixTotal) '
              . 'FROM modification '
              . 'WHERE modification.avantModif=0 '
              . 'AND modification.idFiche='.$ficheId;
    $result2 = Connexion::query($requete2);
    $prixTotalApModif = $result2[0][0];

    return $prixTotalAvModif - $prixTotalApModif;
}

function tableauApresModification($ficheId){
    $requete = 'SELECT modification.id, modification.codeComposant, modification.fournisseur, modification.designation, modification.quantite, '
                     .'modification.unite, stock, prixUnit, prixTotal '
            .'FROM modification, fiche '
            .'WHERE modification.idFiche = fiche.id '
            .'AND modification.avantModif=0 '
            .'AND fiche.id='.$ficheId;
    $results = Connexion::query($requete);
    $totalApModif = 0;
    $html = '<table class="table table-bordered table-hover dataTable">'
            . '<tr>'
            . '<th>CC</th><th>Fournisseur</th><th>Désignation</th><th>Qté</th><th>Un</th><th></th><th>Prix Unit.</th><th>Prix total</th>'
            . '<th></th>'
            . '</tr><tbody>';
    foreach ($results as $result) {
        $html.='<tr>';
        $html.='<td>' . $result[1] . '</td>';
        $html.='<td>' . $result[2] . '</td>';
        $html.='<td>' . $result[3] . '</td>';
        $html.='<td>' . $result[4] . '</td>';
        $html.='<td>' . $result[5] . '</td>';
        $html.='<td></td>';
        $html.='<td>' . $result[7] . ' €</td>';
        $html.='<td>' . $result[8] . ' €</td>';
        $html.='<td>' . lienFormulaireModificationLigneApModif($result[0]) . '</td>';
        $html.='</tr>';
        $totalApModif += $result[8];
    }
    $html.='<tr><td colspan="6" ></td><td><div class="pull-right"><b>Total après modification : </b></div></td><td><b>' . $totalApModif . ' €</b></td></tr>';
    $html.= '</tbody></table>';
    return $html;
}

function formulaireModificationLigneAvModif($ligneId) {
    $ligne = infoLignesAvModif($ligneId);
    return formulaireLigneAvantModif($ligne);
}

function formulaireAjoutLigneAvModif() {
    $fiche = ['', '', '', '', '', '', '', '', '', '', ''];
    return formulaireLigneAvantModif($fiche);
}

function formulaireLigneAvantModif($ligne) {
    if (!is_null($_GET['ficheId'])){
        $ficheId = $_GET['ficheId'];
    }
    $html = '<form action=".?page=validationFormulaireLigneAvantModif&ficheId='.$ficheId.'" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="' . $ligne[0] . '">'
            . champTexte('Code composant', 'codeComposant', $ligne[1])
            . champTexte('Fournisseur', 'fournisseur',$ligne[2])
            . champTexte('Désignation', 'designation',$ligne[3])
            . champTexte('Quantité', 'quantite',$ligne[4])
            . champTexte('Unité', 'unite',$ligne[5])
            . champTexte('Stock', 'stock', $ligne[6], 'text', '1-Utilisable à épuisement<br/> 2-Utilisable à une autre position<br/> 3-Utilisable après modification<br/> 4-Obsolète')
            . champTexte('Prix unitaire', 'prixUnit',$ligne[7])
            . btnSubmit('validerLigneAvModif')
            . '</form>';
    return $html;
}

function lienFormulaireModificationLigneAvModif($ligneId) {
    if (!is_null($_GET['ficheId'])){
        return '<a class="btn btn-default" href=".?page=formulaireModificationLigneAvantModif&ficheId='.$_GET['ficheId'].'&ligneId=' . $ligneId . '"><i class="fa fa-edit"></i></a>';
    }   
}

function ajouterLigneAvModif($codeComposant, $fournisseur, $designation, $quantite, $unite, $stock, $prixUnit, $prixTotal, $idFiche) {
    $query = 'INSERT INTO modification SET codeComposant="' . $codeComposant . '", fournisseur="' . $fournisseur. '", designation="' . $designation . '", '
            .'quantite=' . $quantite . ', unite="' . $unite . '", '
            .'stock="' . $stock . '", prixUnit='.$prixUnit.', prixTotal='.$prixTotal.', avantModif=1, idFiche='.$idFiche;
    return Connexion::exec($query);
}

function modifierLigneAvModif($id, $codeComposant, $fournisseur, $designation, $quantite, $unite, $stock, $prixUnit) {
    $query = 'UPDATE modification 
              SET codeComposant="' . $codeComposant . '", fournisseur="' . $fournisseur. '", designation="' . $designation . '", '
            .'quantite=' . $quantite . ', unite="' . $unite . '", '
            .'stock="' . $stock . '", prixUnit='.$prixUnit.', prixTotal='.$quantite*$prixUnit.', avantModif=1 where id='.$id;
    return Connexion::exec($query);
}

//----------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------

function formulaireModificationLigneApModif($ligneId) {
    $ligne = infoLignesApModif($ligneId);
    return formulaireLigneApresModif($ligne);
}

function formulaireAjoutLigneApModif() {
    $ligne = ['', '', '', '', '', '', '', '', '', '', ''];
    return formulaireLigneApresModif($ligne);
}

function formulaireLigneApresModif($ligne) {
    if(!is_null($_GET['ficheId'])){
        $ficheId = $_GET['ficheId'];
    }
    $html = '<form action=".?page=validationFormulaireLigneApresModif&ficheId='.$ficheId.'" method="POST" class="form-horizontal">
             <input type="hidden" name="id" value="' . $ligne[0] . '">'
            . champTexte('Code composant', 'codeComposant',$ligne[1])
            . champTexte('Fournisseur', 'fournisseur',$ligne[2])
            . champTexte('Désignation', 'designation',$ligne[3])
            . champTexte('Quantité', 'quantite',$ligne[4])
            . champTexte('Unité', 'unite',$ligne[5])
            . champTexte('Prix unitaire', 'prixUnit',$ligne[7])
            . btnSubmit('validerLigneApModif')
            . '</form>';
    return $html;
}

function ajouterLigneApModif($codeComposant, $fournisseur, $designation, $quantite, $unite, $prixUnit, $prixTotal, $idFiche) {
    $query = 'INSERT INTO modification SET codeComposant="' . $codeComposant . '", fournisseur="' . $fournisseur. '", designation="' . $designation . '", '
            .'quantite=' . $quantite . ', unite="' . $unite . '", '
            .'stock= NULL, prixUnit='.$prixUnit.', prixTotal='.$prixTotal.', avantModif=0, idFiche='.$idFiche;
    return Connexion::exec($query);
}

function modifierLigneApModif($id, $codeComposant, $fournisseur, $designation, $quantite, $unite, $prixUnit) {
    $query = 'UPDATE modification 
              SET codeComposant="' . $codeComposant . '", fournisseur="' . $fournisseur. '", designation="' . $designation . '", '
            .'quantite=' . $quantite . ', unite="' . $unite . '", '
            .'stock=NULL , prixUnit='.$prixUnit.', prixTotal='.$quantite*$prixUnit.', avantModif=0 where id='.$id;
    return Connexion::exec($query);
}

function lienFormulaireModificationLigneApModif($ligneId) {
    if (!is_null($_GET['ficheId'])){
        return '<a class="btn btn-default" href=".?page=formulaireModificationLigneApresModif&ficheId='.$_GET['ficheId'].'&ligneId='.$ligneId.'"><i class="fa fa-edit"></i></a>';
    }
    
}