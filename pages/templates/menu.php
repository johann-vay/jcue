<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <?php
            if ($_SESSION['userType'] == 2){
                echo '<li>
                        <a href="./?page=listeOffresProposees">
                            <i class="fa fa-list"></i>
                            <span>Offres proposées</span>
                        </a>
                    </li>';
                
                echo '<li>
                        <a href="./?page=formulaireAjoutOffre">
                            <i class="fa fa-plus"></i>
                            <span>Ajouter une offre</span>
                        </a>
                    </li>';
            } elseif ($_SESSION['userType'] == 1){
                echo '<li>
                        <a href="./?page=listeOffresPostulees">
                            <i class="fa fa-list"></i>
                            <span>Offres postulées</span>
                        </a>
                    </li>';
                
                echo '<li>
                        <a href="./?page=listeOffresNonPostulees">
                            <i class="fa fa-list"></i>
                            <span>Offres non postulées</span>
                        </a>
                    </li>';
                
            } elseif ($_SESSION['userType'] == 3) {
                echo '<li>
                        <a href="./?page=listeOffres">
                            <i class="fa fa-list"></i>
                            <span>Offres</span>
                        </a>
                    </li>';
                
                echo '<li>
                        <a href="./?page=listeUtilisateurs">
                            <i class="fa fa-users"></i>
                            <span>Utilisateurs</span>
                        </a>
                    </li>';
            }
            
            ?>
        </ul><!-- /.sidebar-menu -->

    </div><!-- /.sidebar -->
</div><!-- /.main-sidebar -->