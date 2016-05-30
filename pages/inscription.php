<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inscription</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">   
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
          <b>Inscription</b>
      </div><!-- /.login-logo -->
      <div class="login-box-body">



<?php
require_once '../required.php';


if (isset($_POST['validerChoixType'])){
    $idTypeUtilisateur = $_POST['idTypeUtilisateur'];
    if($idTypeUtilisateur == 1){
        echo '<form action=".?page=validInscription" method="post">
                <input type="hidden" name="idTypeUser" value="'.$idTypeUtilisateur.'">
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="NOM" name="nom">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Prénom" name="prenom">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Adresse" name="adresse">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Code postal" name="codePostal">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Ville" name="ville">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Mail" name="mail">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Téléphone" name="telephone">
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Confirmer mot de passe" name="confirmPassword">
                </div>
                <div class="row">
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="validInscription">Valider</button>
                  </div><!-- /.col -->
                </div>
              </form>';
    } elseif ($idTypeUtilisateur == 2) {
        echo '<form action=".?page=validInscription" method="post">
                <input type="hidden" name="idTypeUser" value="'.$idTypeUtilisateur.'">
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Raison Sociale" name="raisonSociale">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Numéro SIRET" name="numeroSiret">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Adresse" name="adresse">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Code postal" name="codePostal">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Ville" name="ville">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Mail" name="mail">
                </div>
                <div class="form-group has-feedback">
                  <input type="text" class="form-control" placeholder="Téléphone" name="telephone">
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Mot de passe" name="password">
                </div>
                <div class="form-group has-feedback">
                  <input type="password" class="form-control" placeholder="Confirmer mot de passe" name="confirmPassword">
                </div>
                <div class="row">
                  <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" name="validInscription">Valider</button>
                  </div><!-- /.col -->
                </div>
              </form>';
    }
}
?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>

    <!-- jQuery pour modifier la couleur des bords des champ de saisie -->
    <script>
        $(document).ready(function() {
            $('input').focus(function() {
                var inputVal = $(this).val();
                console.log(inputVal);

                if (inputVal === ''){
                    $(this).attr('style', 'border-color: red;');
                } else {
                    $(this).attr('style', 'border-color: green;');
                }
            });
            $('input').keyup(function() {
                var inputVal = $(this).val();
                console.log(inputVal);

                if (inputVal === ''){
                    $(this).attr('style', 'border-color: red;');
                } else {
                    $(this).attr('style', 'border-color: green;');
                }
            });
        });
    </script>
  </body>
</html>
