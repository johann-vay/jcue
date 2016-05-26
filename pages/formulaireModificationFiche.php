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
            Fiche n° <?php echo $ficheId; ?>
            <?php echo bouton('.?page=listeFiches', '<i class="fa fa-list"></i>'); ?>
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php echo messages(); ?>
            <div class="col-xs-12 col-sm-10 col-md-9 col-lg-6">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">
                                <?php
                                    echo formulaireModificationFiche($ficheId);
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
        
        $modele.find('option').hide();
        $modele.find('option[data-marque=' + marque_id + ']').show();
    }
    document.addEventListener('DOMContentLoaded', function(){
        updateModele();
        $('select[name=idMarqueBateau]').change(function(){
            updateModele();
        });
    }, false);
</script>
<?php
include('../pages/templates/footer.php');