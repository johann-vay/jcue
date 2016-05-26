<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

$userId=$_GET['userId'];
$user=infoUsers($userId);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo 'Utilisateur : '.$user[1],' ',$user[2]; ?>			
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
                                <?php

                                    echo 'Nom : ',$user[1],'<br />';
                                    echo 'Prénom : ',$user[2],'<br />';
                                    echo 'Login : ',$user[3],'<br />';
                                    echo 'Mail : ',$user[4],'<br />';
                                    echo 'Type d\'utilisateur : ',$user[5],'<br />';


                                    if ($_SESSION['idTypeUser'] == 1 && $userId != $_SESSION['idUser']){
                                        echo '<br />'.lienReinitPassword($userId);
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

