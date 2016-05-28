<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>JCUE</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- CSS pour l'infobulle -->
        <link rel="stylesheet" href="css/style.css">

            <!-- daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            
            <header class="main-header">
                <div class="navbar-header">
                    <a href="." class="logo">
                        <span class="logo-mini"><!-- LOGO -->
                            JCUE
                        </span>
                        <span class="logo-lg"><!-- LOGO -->
                            JCUE
                        </span>
                    </a>
                </div>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <a class="sidebar-toggle" href="#" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                    </a>
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['login'].' '; ?><span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <p>
                                            <?php
                                            $userDAO = new UserDAO();
                                            $user = $userDAO->userDetails($_SESSION['idUser']);
                                            $userType = $user->getType();
                                            /*if ($userType == 'Particulier'){
                                                $particulierDAO = new particulierDAO();
                                                $particulier = $particulierDAO->particulierDetails($_SESSION['idUser']);
                                                echo $particulier->getNom().' '.$particulier->getPrenom().' - '.$user->getType();
                                            }*/
                                            ?>
                                        </p>
                                    </li>
                                    <?php 
                                    echo '<li class="user-footer">'
                                            . '<div class="pull-left">'
                                                . '<a href="" class="btn btn-default btn-flat">Profil</a>'
                                            . '</div>'
                                            . '<div class="pull-right">'
                                                . '<a href=".?page=deconnexion" class="btn btn-default btn-flat">Déconnexion</a>'
                                            . '</div>'
                                        . '</li>'; 
                                    ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            