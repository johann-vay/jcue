<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <u>Tableau de bord</u>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Info boxes -->
             <?php
            
            if ($_SESSION['userType'] == 1){
                $postulerDAO = new postulerDAO();
                $offreDAO = new offreDAO();
                echo '<div class="row">
                        <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href=".?page=listeOffresPostulees"><span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span></a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Offres postulées</span>
                                    <span class="info-box-number">'.$postulerDAO->nbOffresPostulees($_SESSION['idUser']).'</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
                    
                    <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <a href=".?page=listeOffresNonPostulees"><span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span></a>
                                <div class="info-box-content">
                                    <span class="info-box-text">Offres non postulées</span>
                                    <span class="info-box-number">'.$offreDAO->nbOffresNonPostulees($_SESSION['idUser']).'</span>
                                </div><!-- /.info-box-content -->
                            </div><!-- /.info-box -->
                        </div><!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
            </div><!-- /.row -->';/*
        
            <div class="row">
                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href=".?page=listeUtilisateurs"><span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span></a>
                        <div class="info-box-content">
                            <span class="info-box-text">Utilisateurs</span>
                            <span class="info-box-number">'. nbUsers().'</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>
                <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <a href=".?page=montantDirection"><span class="info-box-icon bg-red"><i class="fa fa-eur"></i></span></a>
                        <div class="info-box-content">
                            <span class="info-box-text">Montant validation Direction</span>
                            <span class="info-box-number">'. montantValidationDirection().'</span>
                        </div><!-- /.info-box-content -->
                    </div><!-- /.info-box -->
                </div><!-- /.col -->
                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

            </div><!-- /.row -->';*/
            } elseif ($_SESSION['userType'] == 2) {
                $offreDAO = new offreDAO();
                echo '<div class="row"><div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <a href=".?page=listeOffresProposees"><span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span></a>
                            <div class="info-box-content">
                                <span class="info-box-text">Offres proposées</span>
                                <span class="info-box-number">'.$offreDAO->nbOffresEntreprise($_SESSION['idUser']).'</span>
                            </div><!-- /.info-box-content -->
                        </div><!-- /.info-box -->
                      </div><!-- /.col -->
                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>
            </div><!-- /.row -->';
            }
            ?>

    </section>
</div><!-- /.content-wrapper -->

<?php
include('../pages/templates/footer.php');
