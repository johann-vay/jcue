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
            $entrepriseId = $_GET['entrepriseId'];
            $entrepriseDAO = new UserDAO();
            
            $entreprise= $entrepriseDAO->userDetails($entrepriseId);   

            echo $entreprise->getRaisonSociale();
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
                                    
                                    echo 'Numéro Siret'.$entreprise->getNumeroSiret().'<br><br>';
                                    echo 'Adresse : '.$entreprise->getAdresse().'<br>';
                                    echo 'Code postal: '.$entreprise->getCodePostal().'<br>';
                                    echo 'Ville : '.$entreprise->getVille().'<br>';
                                    echo 'Téléphone '.  $entreprise->getTelephone().'<br>';
                                    echo 'Mail : '.$entreprise->getMail().'<br>';
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