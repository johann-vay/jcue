<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php
            $offreId = $_GET['offreId'];
            $offreDAO = new offreDAO();
            $offre = $offreDAO->offreDetails($offreId);
            
            $userDAO = new UserDAO();
            $emetteur = $userDAO->userDetails($offre->getId_utilisateur());
            
            $typeContratDAO = new typeContratDAO();
            $typeContrat = $typeContratDAO->typeContratDetails($offre->getId_typeContrat());
            
            echo 'Offre n° '.$offre->getId().' - '.$offre->getLibelle();
            if ($_SESSION['userType'] == 1) {
                $postulerDAO = new postulerDAO();
                $postuler = $postulerDAO->offrePostulee($_SESSION['idUser'], $offreId);
                if (!$postuler){
                     echo '<br><br>'.lienPostuler($offreId);
                }
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
                                    
                                    echo '<b><u>'.$offre->getLibelle().'</u></b><br><br>';
                                    echo 'Entreprise : '.lienEntreprise($offre->getId_utilisateur(), $emetteur->getRaisonSociale()).'<br>';
                                    echo 'Durée : '.$offre->getDuree().'<br>';
                                    echo 'Description : '.$offre->getDescriptionMission().'<br>';
                                    echo 'Date de début : '.  dateus2fr($offre->getDateDebut()).'<br>';
                                    echo 'Type de contrat : '.$typeContrat->getLibelle().'<br>';
                                    ?>
				</div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
        </section><!-- /.content -->
        <?php
        if ($_SESSION['userType'] == 2 && $_SESSION['idUser'] == $offre->getId_utilisateur()){
            $postulerDAO = new postulerDAO();
            $postulants = $postulerDAO->postulants($offre->getId());
            echo '<section class="content"><h3>Postulants</h3>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table table-bordered table-hover dataTable">'
                                                    . '<thead>'
                                                        . '<tr>'
                                                            . '<th>Postulant</th><th>NOM Prénom</th><th>Mail</th><th>Téléphone</th>'
                                                        . '</tr>'
                                                    . '</thead>'
                                                    . '<tbody>';
                                                        if (isset($postulants)){
                                                           foreach ($postulants as $postulant) {

                                                                echo '<tr>'
                                                                        .'<td>' . lienParticulier($postulant->getId()) . '</td>'
                                                                        .'<td>' . $postulant->getNom().' '.$postulant->getPrenom(). '</td>'
                                                                        .'<td>' . $postulant->getMail() . '</td>'
                                                                        .'<td>' . $postulant->getTelephone() . '</td>'
                                                                    .'</tr>';
                                                            } 
                                                        }

                                               echo '</tbody>'
                                              . '</table>

                                    </div>
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