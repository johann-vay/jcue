<?php

/**
 * Affiche un bouton qui est un lien vers les détails d'une fiche
 * 
 * @param int $ficheId  Id de la fiche dont on souhaite connaître les détails
 * @return string  Bouton HTML vers la fiche
 */
function lienFiche($ficheId) {
    $html = '<a href=".?page=fiche&ficheId=' . $ficheId . '"><i class="fa fa-eye"></i></a>';
    return $html;
}

/**
 * Sélectionne les données d'une fiche dans la base de données
 * 
 * @param int $ficheId  Id de la fiche dont on veut les données
 * @return array  Résultat de la requête contenant les données de la fiche
 */
function infoFiches($ficheId){
    $requete = 'SELECT dateCreation, marqueBateau, modeleBateau, rang, typeBateau, motifDemande, resume, id, emetteur, archive, bonPourAction '
            . 'FROM fiche '
            . 'WHERE fiche.id ='.$ficheId;
    $result = Connexion::query($requete);
    return $result[0];
}

/**
 * Crée un tableau contenant les fiches non archivées de la base de données 
 * 
 * @param array $fiches  Résultat d'une reqête contenant toutes les fiches non archivées de la base de données
 * @return string  Tableau HTML des fiches
 */
function afficherTableauFiches($marque, $modele){
    $html = '<fieldset><legend>Fiches '.$marque.' '.$modele.'</legend><table class="table table-bordered table-hover dataTable">'
                . '<thead>'
                    . '<tr>'
                        . '<th>Fiche</th><th>Date de création</th><th>Marque du bateau</th><th>Modèle du bateau</th><th>Rang</th><th>Type</th><th>Description</th><th></th>';
                        if ($_SESSION['idTypeUser'] == 1){
                            $html .= '<th></th>';
                        }
    $html .=        '</tr>'
                . '</thead>'
                . '<tbody>';
    $requete = 'SELECT fiche.id, fiche.dateCreation, marque.libelle, modele.libelle, fiche.rang, fiche.typeBateau, fiche.motifDemande, fiche.archive, fiche.resume '
                    . 'FROM marque '
                    . 'INNER JOIN fiche ON marque.id = fiche.marqueBateau '
                    . 'INNER JOIN modele ON fiche.modeleBateau = modele.id '
                    . 'WHERE fiche.archive = 0 '
                    . 'AND marque.libelle = "'.$marque.'" '
                    . 'AND modele.libelle = "'.$modele.'" '
                    . 'ORDER BY fiche.id DESC';
            $fiches = Connexion::query($requete);
                    foreach ($fiches as $fiche) {
                        $html .= '<tr>';
                            $html .= '<td>' . lienFiche($fiche[0]) . '</td>';
                            $html .= '<td>' . dateus2fr($fiche[1]) . '</td>';
                            $html .= '<td>' . $fiche[2] . '</td>';
                            $html .= '<td>' . $fiche[3] . '</td>';
                            $html .= '<td>' . $fiche[4] . '</td>';
                            $html .= '<td>' . infoTypeBateau($fiche[0]) . '</td>';
                            $html .= '<td>' . $fiche[8] . '</td>';
                            $html .= '<td>' . lienFormulaireModificationFiche($fiche[0]) . '</td>'.  modalSuppressionFiche($fiche[0]);
                            if ($_SESSION['idTypeUser'] == 1){
                                $html .= '<td>' . lienSuppressionFiche($fiche[0]) . '</td>';
                            }
                        $html .= '</tr>';
                    }
    $html .=    '</tbody>'
            . '</table></fieldset>';
    return $html;
}

/**
 * Crée un formulaire vide pour l'ajout d'une fiche
 * 
 * @return formulaireFiche  Formulaire de fiche vide
 */
function formulaireAjoutFiche(){
    $fiche = [date('Y-m-d'), '', '', '', '', '', '', ''];
    return formulaireFiche($fiche);
}

/**
 * Crée un formulaire de fiche (ajout ou modification)
 * 
 * @param array $fiche  Tableau contenant les données d'une fiche
 * @return string  Formulaire HTML d'ajout ou de modification d'une fiche
 */
function formulaireFiche($fiche){
    $html = '<form action=".?page=validationFormulaireFiche" method="POST" enctype="multipart/form-data" class="form-horizontal">
                <input type="hidden" name="id" value="'.$fiche[7].'">'
                .champSelectMarqueBateau($fiche[1])
                .champSelectModeleBateau($fiche[2])
                .champTexte('Rang', 'rang', $fiche[3])
                .champSelectTypeBateau($fiche[4])
                .champTexte('Motif de la demande', 'motifDemande', $fiche[5])
                .textArea('Description de la modification', 'resumeModif', $fiche[6]);

                $extensions = ['.csv', '.xls', '.xlsx', '.xlsm', '.pdf', ];
                $fichier = '..\upload\fichierImportFiche'.$fiche[7];
                $nb = 0;
                foreach ($extensions as $extension) {
                    if (file_exists($fichier.$extension)){
                        $nb += 1;
                    }
                }
                if ($nb == 0){
                    $html .= champUpload('Importer un fichier', 'fichierUp', 'Importer un fichier Excel (type tableur) ou pdf !');
                }
                
                $html .= btnSubmit('validerFiche')
            .'</form>';
    return $html;
}

/**
 * Crée un formulaire pour modifier une fiche
 * 
 * @param int $ficheId  L'id de la fiche que l'on souhaite modifier
 * @return formulaireFiche  Formulaire contenant les données de la fiche à modifier
 */
function formulaireModificationFiche($ficheId){
    $fiche = infoFiches($ficheId);
    return formulaireFiche($fiche);
}

/**
 * Ajoute une fiche dans la base de données
 * 
 * @param date $dateCreation  Date de création de la fiche à ajouter
 * @param int $marqueBateau  Id de la marque du bateau de la fiche à ajouter
 * @param int $modeleBateau  Id du modele du bateau de la fiche à ajouter 
 * @param int $rang  Rang du bateau de la fiche à ajouter
 * @param int $typeBateau  Id du type de bateau de la fiche à ajouter
 * @param string $motifDemande  Motif de la demande de la fiche à ajouter
 * @param string $resume  Résumé de la fiche à ajouter
 * @return boolean  True si l'ajout s'est effectué avec succès sinon False
 */
function ajouterFiche($dateCreation, $marqueBateau, $modeleBateau, $rang, $typeBateau, $motifDemande, $resume, $idEmetteur) {
    $query = 'INSERT INTO fiche (dateCreation, marqueBateau, modeleBateau, rang, typeBateau, motifDemande, resume, archive, bonPourAction, emetteur) '
           . 'VALUES ("' . $dateCreation . '", ' . $marqueBateau. ', ' . $modeleBateau . ', "' . $rang . '", ' . $typeBateau . ', "' . $motifDemande . '", "'.$resume.'", 0, 0, '.$idEmetteur.')';
    return Connexion::exec($query);
}

/**
 * Crée un bouton qui est lien vers le formulaire de modification d'une fiche
 * 
 * @param int $ficheId  Id de la fiche à modifier
 * @return string Bouton HTMl vers le formulaire
 */
function lienFormulaireModificationFiche($ficheId) {
    return '<a class="btn btn-default" href=".?page=formulaireModificationFiche&ficheId=' . $ficheId . '"><i class="fa fa-edit"></i></a>';
}

/**
 * Crée un bouton qui est lien vers la suppression d'une fiche
 * 
 * @param int $ficheId  Id de la fiche à supprimer
 * @return string Bouton HTMl vers la page de suppression
 */
function lienSuppressionFiche($ficheId) {
    return '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modalSupprFiche'.$ficheId.'"><i class="fa fa-trash-o" style="color:red"></i></a>';
}

/**
 * Modification d'une fiche dans la base de données
 * 
 * @param int $id  Id de la fiche à modifier
 * @param int $marqueBateau  Id de la marque du bateau de la fiche à modifier
 * @param int $modeleBateau  Id du modele du bateau de la fiche à modifier 
 * @param int $rang  Rang du bateau de la fiche à modifier
 * @param int $typeBateau  Id du type de bateau de la fiche à modifier
 * @param string $motifDemande  Motif de la demande de la fiche à modifier
 * @param string $resume  Résumé de la fiche à modifier
 * @return boolean  True si la modification s'est effectuée avec succès sinon False
 */
function modifierFiche($id, $marqueBateau, $modeleBateau, $rang, $typeBateau, $motifDemande, $resume) {
    $query = 'UPDATE fiche 
              SET marqueBateau="' . $marqueBateau . '", modeleBateau="' . $modeleBateau . '", rang="' . $rang . '", typeBateau="' . $typeBateau . '", motifDemande="' . $motifDemande . '", resume="' .$resume.'"
              WHERE id =' . $id;
    return Connexion::exec($query);
}

/**
 * Crée une liste déroulante HTML des types de bateau
 * 
 * @param int $typeBateauId  Id du type bateau si c'est une modification (pour attribut selected)
 * @return champSelectquery  Liste déroulante HTML
 */
function champSelectTypeBateau($typeBateauId='') {
    return champSelectQuery('Type', 'idTypeBateau', 'SELECT id, libelle FROM typeBateau ORDER BY id', $typeBateauId);
}

/**
 * Crée une liste déroulante HTML des marques de bateau
 * 
 * @param int $marqueBateauId  Id de la marque du bateau si c'est une modification (pour attribut selected)
 * @return champSelectquery  Liste déroulante HTML
 */
function champSelectMarqueBateau($marqueBateauId=''){
    return champSelectQuery('Marque', 'idMarqueBateau', 'SELECT id, libelle FROM marque ORDER BY id', $marqueBateauId);
}

/**
 * Crée une liste déroulante HTML des modèles de bateau
 * 
 * @param int $modeleBateauId  Id du modele de bateau si c'est une modification (pour attibut selected)
 * @return string  Liste déroulante HTML
 */
function champSelectModeleBateau($modeleBateauId='') {
    $query = 'SELECT id, libelle, idMarque '
           . 'FROM modele '
           . 'ORDER BY id';
    $name = 'idModeleBateau';
    $label = 'Modèle';
    $liste = Connexion::query($query);
    $html = '<div class="form-group">
                <label for="' . $name . '" class="col-sm-5 col-md-5 col-lg-4 left-control-label">' . $label . '</label>
                    <div class="col-sm-7 col-md-5 col-lg-8">
                        <select name="' . $name . '" class="form-control">';
                            foreach ($liste as $l) {
                                $id = $l[0];
                                if ($id == $modeleBateauId) {
                                    $html .= '<option value="' . $l[0] . '" data-marque="'.$l[2].'" selected>' . $l[1] . '</option>';
                                } else {
                                    $html .= '<option value="' . $l[0] . '" data-marque="'.$l[2].'">' . $l[1] . '</option>';
                                }
                            }
              $html .= '</select>
                    </div>
            </div>';
    return $html;
}

/**
 * Renvoie le libellé du type de bateau d'une fiche en fonction de son id
 * 
 * @param int $ficheId  Id de la fiche dont on souhaite connaitre le libellé du type de bateau
 * @return array  Libellé du type de bateau
 */
function infoTypeBateau($ficheId){
    $requete = 'SELECT typeBateau.libelle '
             . 'FROM typebateau '
             . 'INNER JOIN fiche ON typeBateau.id = fiche.typeBateau '
             . 'AND fiche.id ='.$ficheId;
    $result = Connexion::query($requete);
    return $result[0][0];
}


/**
 * Renvoie le libellé de la marque du bateau d'une fiche en fonction de son id
 * 
 * @param int $ficheId  Id de la fiche dont on souhaite connaitre le libellé de la marque du bateau
 * @return array  Libellé de la marque du bateau
 */
function infoMarqueBateau($ficheId) {
    $requete = 'SELECT marque.libelle '
             . 'FROM marque '
             . 'INNER JOIN fiche ON marque.id = fiche.marqueBateau '
             . 'AND fiche.id ='.$ficheId;
    $result = Connexion::query($requete);
    return $result[0][0];
}

/**
 * Renvoie le libellé du modèle du bateau d'une fiche en fonction de son id
 * 
 * @param int $ficheId  Id de la fiche dont on souhaite connaitre le libellé du modèle du bateau
 * @return array  Libellé du modèle du bateau
 */
function infoModeleBateau($ficheId){
    $requete = 'SELECT modele.libelle '
             . 'FROM modele '
             . 'INNER JOIN fiche ON modele.id = fiche.modeleBateau '
             . 'AND fiche.id ='.$ficheId;
    $result = Connexion::query($requete);
    return $result[0][0];
}

/**
 * Supprime une fiche de la base de données (avec les données associées : Modifications et validations)
 * 
 * @param int $ficheId Id de la fiche à supprimer
 * @return boolean  True si la suppression a fonctionné sinon False
 */
function supprimerFiche($ficheId){
    $requete1 = 'DELETE '
              . 'FROM modification '
              . 'WHERE idFiche ='.$ficheId;
    Connexion::exec($requete1);
    $requete2 = 'DELETE '
              . 'FROM valider '
              . 'WHERE idValidationFiche ='.$ficheId;
    Connexion::exec($requete2);
    $requete3 = 'DELETE '
              . 'FROM fiche '
              . 'WHERE id ='.$ficheId;
    Connexion::exec($requete3);
    $extensions = ['.csv', '.xls', '.xlsx', '.xlsm', '.pdf'];
    $fichier = '..\upload\fichierImportFiche'.$ficheId;
    foreach ($extensions as $extension) {
        if (file_exists($fichier.$extension)){
            unlink($fichier.$extension);
        }
    }
    $ficheExport = '..\Export\FicheSEP'.$ficheId.'.xlsx';
    unlink($ficheExport);
}

/**
 * Compte le nombre de fiches présentes dans la base de données
 * 
 * @return array  Nombre de fiches
 */
function nbFiches(){
    $nbFiches = Connexion::query('SELECT COUNT(id) FROM fiche WHERE archive = 0');
    return $nbFiches[0][0];
}
/**
 * Compte le nombre de fiches archivées présentes dans la base de données
 * 
 * @return array  Nombre de fiches
 */
function nbFichesArchivees(){
    $nbFiches = Connexion::query('SELECT COUNT(id) FROM fiche WHERE archive = 1');
    return $nbFiches[0][0];
}

/**
 * Retourne l'id de l'emetteur (utilisateur) de la fiche
 * 
 * @param int $ficheId  id de la fiche dont on souhaite connaitre l'émetteur
 * @return int  id de l'emetteur
 */
function emetteurFiche($ficheId){
    $query = 'SELECT emetteur '
            . 'FROM fiche '
            . 'WHERE id = '.$ficheId;
    $result = Connexion::query($query);
    $idEmetteur = $result[0][0];
    return $idEmetteur;
    
}

/**
 * Bouton de lien à la page d'archivage de la fiche
 * 
 * @param int $ficheId  id de la fiche à archiver
 * @return String  Bouton html
 */
function lienArchive($ficheId) {
    return '<a class="btn btn-default" href=".?page=archivageFiche&ficheId=' . $ficheId . '"><i class="fa fa-archive"></i><span> Archiver</span></a>';
}

function updateArchive($ficheId){
    $query = 'UPDATE fiche '
            . 'SET archive = 1 '
            . 'WHERE id = '.$ficheId;
    return Connexion::exec($query);
}

/**
 * Bouton de lien à lap age d'archivage de la fiche
 * 
 * @param int $ficheId  id de la fiche à archiver
 * @return String  Bouton html
 */
function lienDesarchive($ficheId) {
    return '<a class="btn btn-default" href=".?page=desarchivageFiche&ficheId=' . $ficheId . '"><i class="fa fa-archive"></i><span> Désarchiver</span></a>';
}

function updateDesarchive($ficheId){
    $query = 'UPDATE fiche '
            . 'SET archive = 0 '
            . 'WHERE id = '.$ficheId;
    return Connexion::exec($query);
}

/**
 * Crée un tableau contenant les fiches archivées de la base de données
 * 
 * @param array $fiches  Résultat d'une reqête contenant toutes les fiches archivées de la base de données
 * @return string  Tableau HTML des fiches
 */
function afficherTableauFichesArchivees($marque, $modele){

    $html = '<fieldset><legend>Fiches '.$marque.' '.$modele.'</legend><table class="table table-bordered table-hover dataTable">'
            . '<thead>'
                . '<tr>'
                    . '<th>Fiche</th><th>Date de création</th><th>Marque du bateau</th><th>Modèle du bateau</th><th>Rang</th><th>Type</th><th>Description</th>';
                    if ($_SESSION['idTypeUser'] == 1){
                        $html .= '<th></th>';
                    }
    $html .=      '</tr>'
            . '</thead>'
            . '<tbody>';

    $requete = 'SELECT fiche.id, fiche.dateCreation, marque.libelle, modele.libelle, fiche.rang, fiche.typeBateau, fiche.motifDemande, fiche.archive, fiche.resume '
             . 'FROM marque '
             . 'INNER JOIN fiche ON marque.id = fiche.marqueBateau '
             . 'INNER JOIN modele ON fiche.modeleBateau = modele.id '
             . 'WHERE fiche.archive = 1 '
             . 'AND marque.libelle = "'.$marque.'" '
             . 'AND modele.libelle = "'.$modele.'" '
             . 'ORDER BY fiche.id DESC';
    $fiches = Connexion::query($requete);
                    foreach ($fiches as $fiche) {
                        $html .= '<tr>';
                            $html .= '<td>' . lienFiche($fiche[0]) . '</td>';
                            $html .= '<td>' . dateus2fr($fiche[1]) . '</td>';
                            $html .= '<td>' . $fiche[2] . '</td>';
                            $html .= '<td>' . $fiche[3] . '</td>';
                            $html .= '<td>' . $fiche[4] . '</td>';
                            $html .= '<td>' . infoTypeBateau($fiche[0]) . '</td>';
                            $html .= '<td>' . $fiche[8] . '</td>';
                            if ($_SESSION['idTypeUser'] == 1){
                                $html .= '<td>' . lienSuppressionFiche($fiche[0]) . '</td>'.  modalSuppressionFiche($fiche[0]);
                            }
                        $html .= '</tr>';
                    }
    $html .= '</tbody>'
            . '</table></fieldset>';

    return $html;
}

function lienExport($ficheId) {
    return '<a class="btn btn-default" href=".?page=exportExcel&ficheId=' . $ficheId . '"><i class="fa fa-file-excel-o"></i> Export Excel</a>';
}


function lienBonPourValidation($ficheId){
    return '<a class="btn btn-default" href=".?page=bonPourAction&ficheId=' . $ficheId . '"><i class="fa fa-thumbs-o-up"></i> Bon pour Action</a>';
}

function updateBonPourAction($ficheId){
    $rq = 'UPDATE fiche '
        . 'SET bonPourAction = 1 '
        . 'WHERE id = '.$ficheId;
    Connexion::exec($rq);
}

function modalSuppressionFiche($ficheId){
    $html = '<div class="modal modal-danger" id="modalSupprFiche'.$ficheId.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Supprimer la fiche</h4>
              </div>
              <div class="modal-body">
                <p>Attention ! Vous allez supprimer une fiche. Cette action est irrévocable.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                <a href=".?page=supprimerFiche&ficheId='.$ficheId.'"><button type="button" class="btn btn-outline">Supprimer</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>';
    
    return $html;
}