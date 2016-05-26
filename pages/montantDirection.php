<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Montant de validation Direction			
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-3">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?php
                                echo'<form action="" method="POST" class="form-horizontal">'.
                                        champTexte('Montant validation', 'montantValidation').
                                        btnSubmit('validMontantDirection').
                                    '</form>';
                                
                                if (isset($_POST['validMontantDirection']) && $_POST['montantValidation'] != '' && $_POST['montantValidation'] != 0 ){
    
                                    $rq = 'UPDATE typeutilisateur '
                                            . 'SET montantValidation ='.htmlspecialchars($_POST['montantValidation']).' '
                                            . 'WHERE id = 6';

                                    Connexion::exec($rq);

                                    echo '<b><p style="color: green;">Le montant a été modifié !</p></b>';
                                }elseif (isset($_POST['validMontantDirection']) && $_POST['montantValidation'] == '' || isset($_POST['validMontantDirection']) && $_POST['montantValidation'] == 0) {
                                    echo '<b><p style="color: red;">Le montant ne peut pas être nul !</p></b>';
                                }
                                ?>
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