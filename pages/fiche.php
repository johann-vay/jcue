<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

$ficheId=$_GET['ficheId'];
$fiche=infoFiches($ficheId);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo 'Fiche n° '.$ficheId;
            if ($_SESSION['idTypeUser'] == 1 && $fiche[9] == 0){
                echo '<br><br>'.lienArchive($ficheId);
            }elseif ($_SESSION['idTypeUser'] == 1 && $fiche[9] == 1){
                echo '<br><br>'.lienDesarchive($ficheId);
            }
            ?>			
        </h1>
    </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="row">
				<div class="col-sm-12">
                                    <?php                                
                                    $rqMontantDirection = 'SELECT montantValidation '
                                                        . 'FROM typeUtilisateur '
                                                        . 'WHERE id = 6';
                                    $resultMontant = Connexion::query($rqMontantDirection);
                                    $montantDirection = $resultMontant[0][0];

                                    $validation = infoValidation($ficheId);
                                    $commentairesDecision = explode('//', $validation[11]);
                                    $commentairesValidation = explode('//', $validation[21]);
                                    
                                    $extensions = ['.csv', '.xls', '.xlsx', '.xlsm', '.pdf'];
                                    $fichier = '..\upload\fichierImportFiche'.$ficheId;

                                    if ($_SESSION['idUser'] == $fiche[8] ){
                                        if (coutGainLie($ficheId) < ($montantDirection * -1) && $validation[5] == 1 && $fiche[10] == NULL) {
                                            echo lienBonPourValidation($ficheId).'<br><br>';
                                        } elseif(coutGainLie($ficheId) > ($montantDirection * -1) && $validation[4] == 1 && $fiche[10] == NULL) {
                                            echo lienBonPourValidation($ficheId).'<br><br>';
                                        }
                                    }

                                    $rqEmetteur = 'SELECT nom, prenom '
                                                . 'FROM utilisateur '
                                                . 'WHERE id = '.$fiche[8];
                                    $emetteur = Connexion::query($rqEmetteur);

                                    echo lienExport($ficheId).'<br><br>';
                                    echo '<b><u>Emetteur :</u> '.$emetteur[0][1].' '.$emetteur[0][0].'</b><br><br>';
                                    echo 'Date de création de la fiche : '.dateus2fr($fiche[0]).'<br>';
                                    echo 'Bateau concerné : '.infoMarqueBateau($fiche[7]).' '.infoModeleBateau($fiche[7]).' n° '.$fiche[3].'<br>';
                                    echo 'Type du bateau : '.infoTypeBateau($fiche[7]).'<br>';
                                    echo 'Motif de la demande : '.$fiche[5].'<br>';
                                    echo 'Descritption de la modification : '.$fiche[6].'<br>';

                                    foreach ($extensions as $extension){
                                        if (file_exists($fichier.$extension)){
                                            echo 'Lien fichier : <a href=".?page=download&ficheId='.$ficheId.'">Fichier joint</a><br>';
                                        }
                                    }

                                    if (coutGainLie($ficheId) < 0){
                                        echo 'Coût lié à l\'évolution du produit : '.coutGainLie($ficheId)*(-1).'€<br><br>';
                                    }else{
                                        echo 'Gain lié à l\'évolution du produit : '.coutGainLie($ficheId).'€<br><br>';
                                    }

                                    if ($fiche[9] == 0){
                                        echo lienFormulaireModificationFiche($ficheId).'<br><br><br>';
                                    }

                                    echo '<fieldset><legend><b>Circuit de décision</b></legend>';

                                    if ($validation[0] == 1){
                                        echo 'Validation Technique à la date du '.dateus2fr($validation[6]).' : OUI<br>';
                                            if (isset($commentairesDecision[0]) && $commentairesDecision[0] != ''){
                                                echo '<div class="tabComments">'.$commentairesDecision[0].'</div><br>';
                                            }else {
                                                echo '<br>';
                                            }
                                                
                                    }elseif ($validation[0] != null){
                                        echo 'Validation Technique à la date du '.dateus2fr($validation[6]).' : NON<br>';
                                                if (isset($commentairesDecision[0]) && $commentairesDecision[0] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[0].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }
                                    if ($validation[1] == 1){
                                        echo 'Validation Coûts à la date du '.dateus2fr($validation[7]).' : OUI<br>';
                                    }elseif ($validation[1] != null){
                                        echo 'Validation Coûts à la date du '.dateus2fr($validation[7]).' : NON<br>';
                                    }
                                    if ($validation[2] == 1){
                                        echo 'Validation Délais à la date du '.dateus2fr($validation[7]).' : OUI<br>';
                                                if (isset($commentairesDecision[1]) && $commentairesDecision[1] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[1].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }elseif ($validation[2] != null){
                                        echo 'Validation Délais à la date du '.dateus2fr($validation[7]).' : NON<br>';
                                                if (isset($commentairesDecision[1]) && $commentairesDecision[1] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[1].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }
                                    if ($validation[3] == 1){
                                        echo 'Validation Qualité à la date du '.dateus2fr($validation[8]).' : OUI<br>';
                                                if (isset($commentairesDecision[2]) && $commentairesDecision[2] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[2].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }elseif ($validation[3] != null){
                                        echo 'Validation Qualité à la date du '.dateus2fr($validation[8]).' : NON<br>';
                                                if (isset($commentairesDecision[2]) && $commentairesDecision[2] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[2].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }
                                    if ($validation[4] == 1){
                                        echo 'Validation Commerciale / Client à la date du '.dateus2fr($validation[9]).' : OUI<br>';
                                                if (isset($commentairesDecision[3]) && $commentairesDecision[3] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[3].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }elseif ($validation[4] != null){
                                        echo 'Validation Commerciale / Client à la date du '.dateus2fr($validation[9]).' : NON<br>';
                                                if (isset($commentairesDecision[3]) && $commentairesDecision[3] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[3].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }
                                    if ($validation[5] == 1){
                                        echo 'Validation Direction à la date du '.dateus2fr($validation[10]).' : OUI<br>';
                                                if (isset($commentairesDecision[4]) && $commentairesDecision[4] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[4].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }elseif ($validation[5] != null){
                                        echo 'Validation Direction à la date du '.dateus2fr($validation[10]).' : NON<br>';
                                                if (isset($commentairesDecision[4]) && $commentairesDecision[4] != ''){
                                                    echo '<div class="tabComments">'.$commentairesDecision[4].'</div><br>';
                                                }else {
                                                    echo '<br>';
                                                }
                                    }

                                    echo '</fieldset><br>';

                                    echo '<fieldset><legend><b>Circuit de validation</b></legend>';

                                    if ($validation[12] == 1){
                                        echo 'MAJ plan fournisseur à la date du '.dateus2fr($validation[15]).' : OUI<br>';
                                        
                                    }elseif ($validation[12] != null){
                                        echo 'MAJ plan fournisseur à la date du '.dateus2fr($validation[15]).' : N/A<br>';
                                    }
                                    if ($validation[13] == 1){
                                        echo 'MAJ nomenclature à la date du '.dateus2fr($validation[15]).' : OUI<br>';
                                    }elseif ($validation[13] != null){
                                        echo 'MAJ nomenclature à la date du '.dateus2fr($validation[15]).' : N/A<br>';
                                    }
                                    if ($validation[14] == 1){
                                        echo 'MAJ mode op. atelier à la date du '.dateus2fr($validation[15]).' : OUI<br>';
                                        if (isset($commentairesValidation[0]) && $commentairesValidation[0] != ''){
                                            echo '<div class="tabComments">'.$commentairesValidation[0].'</div><br>';
                                        }else {
                                            echo '<br>';
                                        }
                                    }elseif ($validation[14] != null){
                                        echo 'MAJ mode op. atelier à la date du '.dateus2fr($validation[15]).' : N/A<br>';
                                    }
                                    if ($validation[16] == 1){
                                        echo 'Plan transmis au fournisseur à la date du '.dateus2fr($validation[20]).' : OUI<br>';
                                    }elseif ($validation[16] != null){
                                        echo 'Plan transmis au fournisseur à la date du '.dateus2fr($validation[20]).' : N/A<br>';
                                    }
                                    if ($validation[17] == 1){
                                        echo 'Commande modifiée et envoyée à la date du '.dateus2fr($validation[20]).' : OUI<br>';
                                    }elseif ($validation[17] != null){
                                        echo 'Commande modifiée et envoyée à la date du '.dateus2fr($validation[20]).' : N/A<br>';
                                    }
                                    if ($validation[18] == 1){
                                        echo 'Réintégration à prévoir à la date du '.dateus2fr($validation[20]).' : OUI<br>';
                                    }elseif ($validation[18] != null){
                                        echo 'Réintégration à prévoir à la date du '.dateus2fr($validation[20]).' : N/A<br>';
                                    }
                                    if ($validation[19] != null){
                                        echo 'LR n° : '.$validation[19];
                                        if (isset($commentairesValidation[1]) && $commentairesValidation[1] != ''){
                                            echo '<div class="tabComments">'.$commentairesValidation[1].'</div><br>';
                                        }else {
                                            echo '<br>';
                                        }
                                    }
                                    
                                    echo '</fieldset><br><br><br>';



                                    echo '<b>Avant modification :  </b>'; 
                                    echo bouton('.?page=formulaireAjoutLigneAvantModif&ficheId='.$ficheId,'<i class="fa fa-plus"></i>');

                                    echo tableauAvantModification($ficheId).'<br><br><br>';

                                    echo '<b>Après modification :  </b>'; 
                                    echo bouton('.?page=formulaireAjoutLigneApresModif&ficheId='.$ficheId,'<i class="fa fa-plus"></i>');

                                    echo tableauApresModification($ficheId).'<br><br><br>';
                                    ?>
				</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </section><!-- /.content -->

<?php
if ($validation[0] == null && $_SESSION['idTypeUser'] == 2 ){

    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10">';

                                        echo formulaireValiderBE();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section><!-- /.content -->';

}elseif ($validation[1] == null && $validation[2] == null && $validation[0] == 1 && $_SESSION['idTypeUser'] == 3){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';

                                        echo formulaireValiderOperationnel();

                            echo ' </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';

}elseif ($validation[3] == null && $validation[1] == 1  && $validation[2] == 1  &&  $_SESSION['idTypeUser'] == 4){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-6">';

                                        echo formulaireValiderSAV();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';

}elseif ($validation[4] == null  && $validation[3] == 1 && $_SESSION['idTypeUser'] == 5 && $fiche[1] == 2 ){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';

                                        echo formulaireValiderComm();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';

}elseif ($validation[4] == null  && $validation[3] == 1 && $_SESSION['idTypeUser'] == 8 && $fiche[1] == 1 ){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';

                                        echo formulaireValiderComm();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';

}elseif ($validation[5] == null  && $validation[4] == 1 && $_SESSION['idTypeUser'] == 6 && coutGainLie($ficheId) < ($montantDirection * -1)){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';

                                        echo formulaireValiderDirection();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';
}

if (coutGainLie($ficheId) < ($montantDirection * -1) && $validation[5] == 1 && $_SESSION['idTypeUser'] == 2 && $validation[15] == NULL || coutGainLie($ficheId) > ($montantDirection * -1) && $validation[4] == 1 && $_SESSION['idTypeUser'] == 2 && $validation[15] == NULL){
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">';

                                        echo formulaireValiderActionBE();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';
} elseif (coutGainLie($ficheId) < ($montantDirection * -1) && $validation[5] == 1 && $_SESSION['idTypeUser'] == 7 && $validation[15] != NULL && $validation[20] == NULL || coutGainLie($ficheId) > ($montantDirection * -1) && $validation[4] == 1 && $_SESSION['idTypeUser'] == 7 && $validation[15] != NULL && $validation[20] == NULL) {
    echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';

                                        echo formulaireValiderActionLog();

                              echo '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
        </section><!-- /.content -->';
}
?>
</div><!-- /.content-wrapper -->
<?php
include('../pages/templates/footer.php');