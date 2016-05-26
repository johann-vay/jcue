<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajouter un modèle		
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
                                        champTexte('Libellé', 'libelleModele').
                                        champSelectMarqueBateau().
                                        btnSubmit('validModele').
                                    '</form>';
                                
                                if (isset($_POST['validModele']) && $_POST['libelleModele'] != '' && $_POST['libelleModele'] != ' ' ){
    
                                    ajoutModele(htmlspecialchars($_POST['libelleModele']), htmlspecialchars($_POST['idMarqueBateau']));

                                    echo '<b><p style="color: green;">Le modèle a été ajouté !</p></b>';
                                }elseif (isset($_POST['validModele']) && $_POST['libelleModele'] == '' || isset($_POST['validModele']) && $_POST['libelleModele'] == ' ') {
                                    echo '<b><p style="color: red;">Le libellé du modèle ne peut pas être nul !</p></b>';
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