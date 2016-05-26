<?php

include('../pages/templates/header.php');
include('../pages/templates/menu.php');


$requete = 'SELECT fiche.id, fiche.dateCreation, marque.libelle, modele.libelle, fiche.rang, fiche.typeBateau, fiche.motifDemande, fiche.archive, fiche.resume '
        . 'FROM marque '
        . 'INNER JOIN fiche ON marque.id = fiche.marqueBateau '
        . 'INNER JOIN modele ON fiche.modeleBateau = modele.id '
        . 'WHERE fiche.archive = 0 '
        . 'ORDER BY fiche.id DESC';
$fiches = Connexion::query($requete);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste des fiches
           
            <?php 
                echo bouton('.?page=formulaireAjoutFiche','<i class="fa fa-plus"></i>');                  
            ?>
        </h1>
    </section>
    <?php
    $requete1 = 'SELECT marque.libelle, modele.libelle, marque.id, modele.id '
            . 'FROM marque '
            . 'INNER JOIN modele ON marque.id = modele.idMarque';
    $arrayModele = Connexion::query($requete1);
    
    $r = 0;
    foreach ($arrayModele as $modele) {
        $rq = 'SELECT COUNT(id) '
                . 'FROM fiche '
                . 'WHERE marqueBateau ='.$modele[2].' '
                . 'AND modeleBateau ='.$modele[3].' '
                . 'AND archive = 0';
        $result = Connexion::query($rq);
        
        
        if ($result[0][0] > 0){
    

            echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">'.

                                            afficherTableauFiches($modele[0], $modele[1]).

                                    '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section><!-- /.content -->';
            $r += 1;
        }
        
    }
    
    if ($r == 0){
        echo '<section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong>Aucune fiche.</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section><!-- /.content -->';
    }

echo '</div><!-- /.content-wrapper -->';


include('../pages/templates/footer.php');