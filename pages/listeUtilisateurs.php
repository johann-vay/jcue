<?php

include('../pages/templates/header.php');
include('../pages/templates/menu.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Liste des offres postulées
            
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
                                    $userDAO = new UserDAO();
                                    $typeUtilisateurDAO = new TypeUtilisateurDAO();
                                    
                                    $listeUsers = $userDAO->usersList();
                                    
                                    echo '<table class="table table-bordered table-hover dataTable">'
                                            . '<thead>'
                                                . '<tr>'
                                                    . '<th>Utilisateur</th><th>Nom</th><th>Prenom</th><th>Raison Sociale</th><th>Telephone</th><th>Mail</th><th>Type</th>'
                                                    . '<th></th>'
                                                . '</tr>'
                                            . '</thead>'
                                            . '<tbody>';
                                                if (isset($listeUsers)){
                                                   foreach ($listeUsers as $user) {
                                                        $idTypeUser = $user->getType();
                                                        $typeUser = $typeUtilisateurDAO->typeUtilisateurDetails($idTypeUser);

                                                        echo '<tr>'
                                                                .'<td>' . $user->getId() . '</td>'
                                                                .'<td>' . $user->getNom(). '</td>'
                                                                .'<td>' . $user->getPRenom() . '</td>'
                                                                .'<td>' . $user->getRaisonSociale() . '</td>'
                                                                .'<td>' . $user->getTelephone() . '</td>'
                                                                .'<td>' . $user->getMail() . '</td>'
                                                                .'<td>' . $typeUser->getLibelle() . '</td>'.  modalSuppressionUser($user->getId());
                                                                if ($_SESSION['userType'] == 3 && $_SESSION['idUser'] != $user->getId()){
                                                                    echo '<td>' . lienSupprimerUser($user->getId()) . '</td>';
                                                                }else {
                                                                    echo '<td></td>';
                                                                }
                                                            echo '</tr>';
                                                    } 
                                                }
                                                   
                                       echo '</tbody>'
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
