<?php

include('../pages/templates/header.php');
include('../pages/templates/menu.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste des offres
            
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
                                    $offreDAO = new offreDAO();
                                    $typeContratDAO = new typeContratDAO();
                                    $userDAO = new UserDAO();
                                    $listeOffres = $offreDAO->offresList($_SESSION['idUser']);
                                    
                                    echo '<table class="table table-bordered table-hover dataTable">'
                                            . '<thead>'
                                                . '<tr>'
                                                    . '<th>Offre</th><th>Libelle</th><th>Duree</th><th>Description mission</th><th>Emetteur</th><th>Type de contrat</th><th></th>'
                                                . '</tr>'
                                            . '</thead>'
                                            . '<tbody>';
                                                if (isset($listeOffres)){
                                                   foreach ($listeOffres as $offre) {
                                                        $idTypeContrat = $offre->getId_typeContrat();
                                                        $typeContrat = $typeContratDAO->typeContratDetails($idTypeContrat);

                                                        $idEmetteur = $offre->getId_utilisateur();
                                                        $emetteur = $userDAO->userDetails($idEmetteur);
                                                        echo '<tr>'
                                                                .'<td>' . lienOffre($offre->getId()) . '</td>'
                                                                .'<td>' . $offre->getLibelle(). '</td>'
                                                                .'<td>' . $offre->getDuree() . '</td>'
                                                                .'<td>' . $offre->getDescriptionMission() . '</td>'
                                                                .'<td>' . $emetteur->getRaisonSociale() . '</td>'
                                                                .'<td>' . $typeContrat->getLibelle() . '</td>'.  modalSuppressionOffre($offre->getId());
                                                                if ($_SESSION['userType'] == 3){
                                                                    echo '<td>' . lienSupprimerOffre($offre->getId()) . '</td>';
                                                                }

                                                            echo '</tr>';
                                                    } 
                                                }
                                                   
                                       echo '</tbody>'
                                      . '</table>';
                                ?>
                            </div>
			</div>
                    </div>
		</div>
            </div> <!-- /.col-md-12 -->
	</div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<?php
include('../pages/templates/footer.php');
