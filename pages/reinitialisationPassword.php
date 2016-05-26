<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

$userId = $_GET['userId'];

$newPassword = reinitPassword($userId);

?>

!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Réinitialisation réussie !			
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
	<div class="row">
            <div class="col-xs-12 col-sm-8 col-md-5 col-lg-4">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <p style="color: green"><b>Le mot de passe a été réinitialisé avec succès !</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div>
<?php
include('../pages/templates/footer.php');