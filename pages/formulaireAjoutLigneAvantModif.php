<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');
$ficheId = $_GET['ficheId'];
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajouter une ligne d'avant modification
            <?php echo bouton('.?page=fiche&ficheId='.$ficheId,'<i class="fa fa-list"></i>'); ?>
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
                                    echo formulaireAjoutLigneAvModif();
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
