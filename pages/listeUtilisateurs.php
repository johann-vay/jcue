<?php

include('../pages/templates/header.php');
include('../pages/templates/menu.php');


$requete = 'select utilisateur.id,utilisateur.nom, utilisateur.prenom,utilisateur.login, typeutilisateur.libelle '
        . 'from utilisateur, typeutilisateur '
        . 'where utilisateur.idTypeUtilisateur = typeutilisateur.id '
        . 'order by utilisateur.id';
$users = Connexion::query($requete);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste des Utilisateurs
            <?php 
                if ($_SESSION['idTypeUser'] == 1) {
                    echo bouton('.?page=formulaireAjoutUtilisateur','<i class="fa fa-plus"></i>');
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
                                    echo afficherTableauUsers($users);
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
