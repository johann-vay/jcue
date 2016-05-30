<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajouter une offre
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    	<div class="row">      
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-4">
		<div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <?php
                                    echo formulaireAjoutOffre();
                                    if (isset($_POST['validerOffre'])){
                                        if(!empty($_POST['libelle']) && !empty($_POST['duree']) && !empty($_POST['descriptionMission']) && !empty($_POST['dateDebut']) && !empty($_POST['idTypeContrat'])){
                                            $offre = new Offre($_POST['libelle'], $_POST['duree'], $_POST['descriptionMission'], $_POST['dateDebut'], $_SESSION['idUser'], $_POST['idTypeContrat']);
                                            $offreDAO = new offreDAO();
                                            if($offreDAO->addOffre($offre)){
                                                echo '<div style="color : green;">L\'offre a été ajouté</div>';
                                            } else {
                                                echo '<div style="color : red;">Erreur : L\'offre n\'a pas été ajouté..</div>';
                                            }
                                        } else {
                                            
                                            echo '<div style="color : red;">Attention : veuillez renseigner tous les champs !</div>';
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
</div><!-- /.content-wrapper -->
<?php






include('../pages/templates/footer.php');
