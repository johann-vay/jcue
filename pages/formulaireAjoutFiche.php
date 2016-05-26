<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajouter une fiche
            <?php echo bouton('.?page=listeFiches','<i class="fa fa-list"></i>'); ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row"> 
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-6">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <?php
                                    echo formulaireAjoutFiche();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-12 -->
        </div> <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    function updateModele(){
        var $modele = $('select[name=idModeleBateau]');		
	var marque_id = $('select[name=idMarqueBateau]').val();
	console.log(marque_id);
		
	$modele.find('option').hide().removeAttr('selected');
	$modele.find('option[data-marque=' + marque_id + ']').show().removeAttr('selected');
	$modele.find('option:visible:first').attr('selected','selected');
    }
    document.addEventListener('DOMContentLoaded', function(){
	updateModele();
	$('select[name=idMarqueBateau]').change(function(){
            updateModele();
	});
    }, false );
</script>
<?php
include('../pages/templates/footer.php');