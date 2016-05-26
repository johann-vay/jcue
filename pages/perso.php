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
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-3">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?php

                                    echo 'Nom : ',$user[1],'<br />';
                                    echo 'Prénom : ',$user[2],'<br />';
                                    echo 'Login : ',$user[3],'<br />';
                                    echo 'Mail : ',$user[4],'<br />';
                                    echo 'Type d\'utilisateur : ',$user[5],'<br /><br />';

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-6">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <?php echo formulairePassword($userId); 
                                
                                if (isset($_POST['validerNewPassword'])){
                                    $oldPassword = saltHash($_POST['oldPassword']);
                                    $passUser = passwordUser($userId);    
                                    if ($_POST['oldPassword'] != '' && $_POST['newPassword'] != '' && $_POST['confirmNewPassword'] != ''){
                                        if ($_POST['newPassword'] != $_POST['confirmNewPassword']){

                                            echo '<b><p style="color: red">Les nouveaux mot de passe saisis ne sont pas identiques !</p></b><br/> ';
                                        }elseif ($oldPassword == passwordUser($userId)){
                                                $newPasswordHash = saltHash($_POST['newPassword']);
                                                changePassword($newPasswordHash, $userId);
                                                echo '<b><p style="color: green">Le mot de passe a été modifié avec succès !</p></b><br/>';
                                            }else{
                                                echo '<b><p style="color: red">Le mot de passe actuel saisi est incorrect !</p></b><br/>';
                                            }
                                    }else{
                                        echo '<b><p style="color: red">Remplissez tous les champs !</p></b>';    
                                    }
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

