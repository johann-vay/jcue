<div class="main-sidebar">
    <!-- Inner sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!-- Optionally, you can add icons to the links -->
            <li>
                <a href=".?page=listeFiches">
                    <i class="fa fa-list"></i>
                    <span>Fiches SEP</span>
                </a>
            </li>
            <?php
            if ($_SESSION['idTypeUser'] == 1){
                echo '<li>
                        <a href=".?page=listeUtilisateurs">
                            <i class="fa fa-users"></i>
                            <span>Utilisateurs</span>
                        </a>
                    </li>';
                
                echo '<li>
                        <a href=".?page=listeArchives">
                            <i class="fa fa-archive"></i>
                            <span>Fiches archivées</span>
                        </a>
                    </li>';
                echo '<li>
                        <a href=".?page=montantDirection">
                            <i class="fa fa-check"></i>
                            <span>Montant direction</span>
                        </a>
                    </li>';
                echo '<li>
                        <a href=".?page=modele">
                            <i class="fa fa-plus"></i>
                            <span>Modèles</span>
                        </a>
                    </li>';
            }
            ?>

        </ul><!-- /.sidebar-menu -->

    </div><!-- /.sidebar -->
</div><!-- /.main-sidebar -->