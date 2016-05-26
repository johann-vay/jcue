<?php

$id =  htmlspecialchars($_POST['id']);
$marque = htmlspecialchars($_POST['idMarqueBateau']);
$modele = htmlspecialchars($_POST['idModeleBateau']);
$rang = htmlspecialchars($_POST['rang']);
$idTypeBateau = htmlspecialchars($_POST['idTypeBateau']);
$motifDemande = htmlspecialchars($_POST['motifDemande']);
$resumeModif = htmlspecialchars($_POST['resumeModif']);
$idEmetteur = htmlspecialchars($_SESSION['idUser']);

if (isset($_POST['validerFiche'])){
    if ($id == ''){
        $nbFiche = ajouterFiche(date('Y-m-d'), $marque, $modele, $rang, $idTypeBateau, $motifDemande, $resumeModif, $idEmetteur);
        
        //------------------------------------------------------------------------------------------
        //       Gestion d'envoi de mail automatique !
        //------------------------------------------------------------------------------------------
        $req = 'SELECT MAX(id) FROM fiche';
        $result = Connexion::query($req);
        $lastId = $result[0][0];
        $infosFiche = infoFiches($lastId);
        
        $reqEmailBE = 'SELECT mail '
                . 'FROM utilisateur '
                . 'WHERE idTypeUtilisateur = 2';
        $resultEmailBE = Connexion::query($reqEmailBE);
        $emailBE = $resultEmailBE[0][0];
        
        mailAutoValidation($emailBE, $infosFiche);
       
    } else {
        $nbFiche = modifierFiche($id, $marque, $modele, $rang, $idTypeBateau, $motifDemande, $resumeModif);
    }
}

//------------------------------------------------------------------------------------------
//       Gestion d'upload de fichiers (Excel et pdf) pour les fiches !
//------------------------------------------------------------------------------------------

if (isset($_FILES['fichierUp'])){
    $codeErreur = [0 => 'Aucune erreur, le téléchargement est correct.',
                    1 => 'La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini.',
                    2 => 'La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML.',
                    3 => 'Le fichier n\'a été que partiellement téléchargé.',
                    4 => 'Aucun fichier n\'a été téléchargé.',
                    6 => 'Un dossier temporaire est manquant. Introduit en PHP 5.0.3.',
                    7 => 'Échec de l\'écriture du fichier sur le disque. Introduit en PHP 5.1.0.',
                    8 => 'Une extension PHP a arrêté l\'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L\'examen du phpinfo() peut aider. Introduit en PHP 5.2.0.'];

    $dossier = '..\upload\\';
    $fichier = basename($_FILES['fichierUp']['tmp_name']);
    $taille = filesize($_FILES['fichierUp']['tmp_name']);
    $extensions = ['.csv', '.xls', '.xlsx', '.xlsm', '.pdf'];
    $extension = strrchr($_FILES['fichierUp']['name'], '.');

    if (!in_array($extension, $extensions)){
        $erreur = 'Vous devez uploader un fichier au format xls, xlsm, xlsx, csv, ou pdf ...';
    }

    if ($_POST['id'] != ''){
        if (!isset($erreur)){
            $nomFichier = 'fichierImportFiche'.$id.$extension;
            if (move_uploaded_file($_FILES['fichierUp']['tmp_name'], $dossier.$nomFichier)){
                echo 'Upload effectué avec succès !'
                    . 'Taille max : '.$_POST['MAX_FILE_SIZE'].'<br/>'
                    . 'Taille fichier : '.$taille;
            } else {
                echo '<br/><b>'.$codeErreur[$_FILES['fichierUp']['error']].'</b><br/>'
                    . 'Taille max : '.$_POST['MAX_FILE_SIZE'].'<br/>'
                    . 'Taille fichier : '.$taille;
            }
        } else {
            echo $erreur;
        }
    } elseif ($_POST['id'] == ''){
        $req = 'SELECT MAX(id) FROM fiche';
        $result = Connexion::query($req);
        $lastId = $result[0][0];
        if (!isset($erreur)){
            $nomFichier = 'fichierImportFiche'.$lastId.$extension;
            if (move_uploaded_file($_FILES['fichierUp']['tmp_name'], $dossier.$nomFichier)){
                echo 'Upload effectué avec succès !'
                    . 'Taille max : '.$_POST['MAX_FILE_SIZE'].'<br/>'
                    . 'Taille fichier : '.$taille;
            } else {
                echo '<br/><b>'.$codeErreur[$_FILES['fichierUp']['error']].'</b><br/>'
                        . 'Taille max : '.$_POST['MAX_FILE_SIZE'].'<br/>'
                        . 'Taille fichier : '.$taille;
            }
        } else {
            echo $erreur;
        }
    }
}


//-------------------------------------------------------------------------------
//          Génération du fichier Excel pour Export (Première partie du tableau)
//-------------------------------------------------------------------------------


if ($id != ''){
    $ficheId = $id;
} else {
    $ficheId = $lastId;
}
$infosFiche = infoFiches($ficheId);

$file = 'ficheSEP'.$ficheId.'.xlsx';

$rqEmetteur = 'SELECT utilisateur.nom, utilisateur.prenom '
            . 'FROM utilisateur '
            . 'WHERE id = '.$infosFiche[8];
$resultEmetteur = Connexion::query($rqEmetteur);
$emetteur = $resultEmetteur[0];


$marqueBateau = infoMarque($infosFiche[1]);
$modeleBateau = infoModele($infosFiche[2]);
$typeBateau = infoType($infosFiche[4]);


if (file_exists('..\export\\'.$file)){
    unlink('..\export\\'.$file);
}

$objet = PHPExcel_IOFactory::createReader('Excel2007');

$excel = $objet->load('..\export\SEPvierge.xlsx');

$sheet = $excel->getSheet(0);

$sheet->setCellValue('O2', $ficheId);
$sheet->setCellValue('O4', date('d/m/Y'));
$sheet->setCellValue('B5', dateus2fr($infosFiche[0]));
$sheet->setCellValue('F5', $emetteur[0].' '.$emetteur[1]);
$sheet->setCellValue('C8', $marqueBateau);
$sheet->setCellValue('E8', $modeleBateau);
$sheet->setCellValue('H8', $infosFiche[3]);
$sheet->setCellValue('J8', $typeBateau);
$sheet->setCellValue('A11', $infosFiche[5]);
$sheet->setCellValue('C14', $infosFiche[6]);

$rqMontantDirection = 'SELECT montantValidation '
                    . 'FROM typeUtilisateur '
                    . 'WHERE id = 6';
$resultMontant = Connexion::query($rqMontantDirection);
$montantDirection = $resultMontant[0][0];
$sheet->setCellValue('A49', 'DIRECTION (si coût > '.$montantDirection.'€) :');

//Tableau avant Modification

$reqLignesAvModif = 'SELECT codeComposant, fournisseur, designation, quantite, unite, stock, prixUnit, '
                        . 'prixTotal '
                    . 'FROM modification '
                    . 'WHERE avantModif = 1 '
                    . 'AND idFiche = '.$ficheId;

$lignesAvModif = Connexion::query($reqLignesAvModif);

$numLigneAvModif = 17;
$totalAvModif = 0;
foreach ($lignesAvModif as $ligne){
    $sheet->setCellValue('A'.$numLigneAvModif, $ligne[0]);
    $sheet->setCellValue('B'.$numLigneAvModif, $ligne[1]);
    $sheet->setCellValue('C'.$numLigneAvModif, $ligne[2]);
    $sheet->setCellValue('D'.$numLigneAvModif, $ligne[3]);
    $sheet->setCellValue('E'.$numLigneAvModif, $ligne[4]);
    $sheet->setCellValue('F'.$numLigneAvModif, $ligne[5]);
    $sheet->setCellValue('G'.$numLigneAvModif, $ligne[6]);
    $sheet->setCellValue('H'.$numLigneAvModif, $ligne[7]);
    
    $totalAvModif += $ligne[7];
    $numLigneAvModif++;
}


//Tableau après Modification

$reqLignesApModif = 'SELECT codeComposant, fournisseur, designation, quantite, unite, prixUnit, '
                        . 'prixTotal '
                    . 'FROM modification '
                    . 'WHERE avantModif = 0 '
                    . 'AND idFiche = '.$ficheId;

$lignesApModif = Connexion::query($reqLignesApModif);

$numLigneApModif = 17;
$totalApModif = 0;
foreach ($lignesApModif as $ligne){
    $sheet->setCellValue('I'.$numLigneApModif, $ligne[0]);
    $sheet->setCellValue('J'.$numLigneApModif, $ligne[1]);
    $sheet->setCellValue('K'.$numLigneApModif, $ligne[2]);
    $sheet->setCellValue('L'.$numLigneApModif, $ligne[3]);
    $sheet->setCellValue('M'.$numLigneApModif, $ligne[4]);
    $sheet->setCellValue('N'.$numLigneApModif, $ligne[5]);
    $sheet->setCellValue('O'.$numLigneApModif, $ligne[6]);
    
    $totalApModif += $ligne[6];
    $numLigneApModif++;
}

//pied de tableau
if ($totalAvModif - $totalApModif < 0){
    $sheet->setCellValue('A29', 'Coût lié à l\'évolution du produit');
    $sheet->setCellValue('M29', ($totalAvModif-$totalApModif) * (-1));
}else {
    $sheet->setCellValue('A29', 'Gain lié à l\'évolution du produit');
    $sheet->setCellValue('M29', $totalAvModif-$totalApModif);
}


//Circuit Décision

$reqValidations = 'SELECT validationTechnique, dateValidationTech, validationCouts, validationDelais, dateValidationCoutsDelais, '
                    . 'validationQualite, dateValidationQualite, validationCommerciale, dateValidationCommerciale, '
                    . 'validationDirection, dateValidationDirection, commentaires, '
                    . 'majPlanFourn, majNomenc, majModeOp, dateActionBE, planTransmis, commandeModif, reintPrev, noLR, dateActionLog, '
                    . 'commentairesAction '
                . 'FROM valider '
                . 'WHERE idValidationFiche = '.$ficheId;
$results = Connexion::query($reqValidations);

if (!empty($results)){
    $validations = $results[0];

    $commentaires = explode('//', $validations[11]);

        //BE
    if ($validations[0] != NULL){
        $sheet->setCellValue('C35', ouiNonExport($validations[0]));
        $sheet->setCellValue('F35', dateus2fr($validations[1]));

        //Commentaire
        if (isset($commentaires[0])){
            $sheet->setCellValue('C37', $commentaires[0]);
        }
    }

        //Operationnel
    if ($validations[2] != NULL && $validations[3] != NULL){
        $sheet->setCellValue('J34', ouiNonExport($validations[2]));
        $sheet->setCellValue('J35', ouiNonExport($validations[3]));
        $sheet->setCellValue('N35', dateus2fr($validations[4]));

        //Commentaire
        if (isset($commentaires[1])){
            $sheet->setCellValue('J37', $commentaires[1]);
        }
    }

        //SAV / Qualite
    if ($validations[5] != NULL){
        $sheet->setCellValue('C43', ouiNonExport($validations[5]));
        $sheet->setCellValue('F43', dateus2fr($validations[6]));

        //Commentaire
        if (isset($commentaires[2])){
            $sheet->setCellValue('C45', $commentaires[2]);
        }
    }

        //Commerce
    if ($validations[7] != NULL){
        $sheet->setCellValue('K43', ouiNonExport($validations[7]));
        $sheet->setCellValue('N43', dateus2fr($validations[8]));

        //Commentaire
        if (isset($commentaires[3])){
            $sheet->setCellValue('J45', $commentaires[3]);
        }
    }

        //Direction
    if ($validations[9] != NULL){
        $sheet->setCellValue('C51', ouiNonExport($validations[9]));
        $sheet->setCellValue('F51', dateus2fr($validations[10]));

        //Commentaire
        if (isset($commentaires[4])){
            $sheet->setCellValue('C53', $commentaires[4]);
        }
    }


    //Circuit Validation

    $commentairesAction = explode('//', $validations[21]);


        //BE - GDT
    if ($validations[15] != NULL){
        $sheet->setCellValue('C60', ouiNAExport($validations[12]));
        $sheet->setCellValue('C61', ouiNAExport($validations[13]));
        $sheet->setCellValue('C62', ouiNAExport($validations[14]));
        $sheet->setCellValue('F60', dateus2fr($validations[15]));
        
        //Commentaire
        if (isset($commentairesAction[0])){
            $sheet->setCellValue('C64', $commentairesAction[0]);
    }
    }
    
    

        //Logistique
    if ($validations[20] != NULL){
        $sheet->setCellValue('K60', ouiNAExport($validations[16]));
        $sheet->setCellValue('K61', ouiNAExport($validations[17]));
        $sheet->setCellValue('K62', ouiNAExport($validations[18]));
        $sheet->setCellValue('N62', $validations[19]);
        $sheet->setCellValue('N60', dateus2fr($validations[20]));


        //Commentaire
        if (isset($commentairesAction[0])){
            $sheet->setCellValue('J64', $commentairesAction[1]);
        }
    }
    
}



$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
$writer->save('..\export\\'.$file);





header('Location:.?page=fiche&ficheId='.$ficheId);