<?php

include('../pages/templates/header.php');
include('../pages/templates/menu.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste des offres
            
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
                                    $offreDAO = new offreDAO();
                                    $listeOffres = $offreDAO->offreList();
                                    
                                    echo '<table class="table table-bordered table-hover dataTable">'
                                            . '<thead>'
                                                . '<tr>'
                                                    . '<th>Offre</th><th>Libelle</th><th>Duree</th><th>Description mission</th><th>Type Utilisateur</th>'
                                                        . '<th></th><th></th>'
                . '</tr>'
            . '</thead>'
            . '<tbody>';
                foreach ($users as $user) {
                    $html.= '<tr>';
                        $html.='<td>' . lienUser($user[0]) . '</td>';
                        $html.='<td>' . $user[1] . '</td>';
                        $html.='<td>' . $user[2] . '</td>';
                        $html.='<td>' . $user[3] . '</td>';
                        $html.='<td>' . $user[4] . '</td>';
                        if ($_SESSION['idTypeUser'] == 1 && $_SESSION['idUser'] != $user[0]){
                            $html.='<td>' . lienFormulaireModificationUser($user[0]) . '</td>';
                            $html.='<td>' . lienSuppressionUser($user[0]) . '</td>'.modalSuppressionUser($user[0]);
                            }else {
                                $html.='<td>' . lienFormulaireModificationUser($user[0]) . '</td>';
                                $html .= '<td></td>';
                        }
                    $html.='</tr>';
                }
    $html.= '</tbody>'
        . '</table>';
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
