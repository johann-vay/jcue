<?php
include('../pages/templates/header.php');
include('../pages/templates/menu.php');

$userId = htmlspecialchars($_POST['id']);
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$login = strtolower($nom).'.'.  strtolower($prenom);

$password = saltHash('password');
$email = htmlspecialchars($_POST['email']);
$typeUtilisateur = $_POST['idTypeUser'];

$rq = 'SELECT COUNT(id) '
    . 'FROM utilisateur '
    . 'WHERE idTypeUtilisateur = '.$typeUtilisateur.' '
        . 'AND idTypeUtilisateur !=10';
$result = Connexion::query($rq);
$nb = $result[0][0];

$rq2 = 'SELECT libelle '
    . 'FROM typeutilisateur '
    . 'WHERE id = '.$typeUtilisateur;
$result2 = Connexion::query($rq2);
$libelle = $result2[0][0];


if ($userId == ''){
    if (empty($nom) || empty($prenom) || empty($email)){
        $message = '<b><p style="color : red">Veuillez renseigner tous les champs pour ajouter un utilisateur !</p></b>';
    } elseif ($nb == 1){
        $message = '<b><p style="color : red">Un utilisateur de type "'.$libelle.'" existe déjà !</p></b>';
    } else {
        $nbUser = ajouterUser($nom, $prenom, $login, $password, $email, $typeUtilisateur);
        $message = '<b><p style="color : green">L\'utilisateur a été ajouté avec succès !</p></b>';
        //header('Location:.?page=listeUtilisateurs');
    }
    
    // Affichage de la page
    echo '<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Ajouter un utilisateur '.
                    bouton('.?page=listeUtilisateurs','<i class="fa fa-users"></i>'). 
                '</h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">        
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">'.
                                            $message.
                                    '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->';
    
} else {
    $rq3 = 'SELECT idTypeUtilisateur '
            . 'FROM utilisateur '
            . 'WHERE id = '.$userId;
    $result3 = Connexion::query($rq3);
    $type = $result3[0][0];
    
    if (empty($nom) || empty($prenom) || empty($email)){
        $message = '<b><p style="color : red">Veuillez renseigner tous les champs pour modifier un utilisateur !</p></b>';
    } elseif ($type != $typeUtilisateur && $nb == 1) {
        $message = '<b><p style="color : red">Un utilisateur de type "'.$libelle.'" existe déjà !</p></b>';
    } else {
        $nbUser = updateUser($userId, $nom, $prenom, $login, $email, $typeUtilisateur);
        header('Location:.?page=utilisateur&userId='.$userId);
    }
    
    // Affichage de la page
    echo '<!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Modifier un utilisateur '.
                    bouton('.?page=listeUtilisateurs','<i class="fa fa-users"></i>'). 
                '</h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">        
                    <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8">'.
                                            $message.
                                    '</div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->';
    
}


include('../pages/templates/footer.php');
