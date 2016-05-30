<?php

$login =  htmlspecialchars($_POST['login']);
$password = saltHash(htmlspecialchars($_POST['password']));

if (!empty($login) && !empty($password)){
    $userDAO = new UserDAO();
    $user = $userDAO->userByLogin($login);

    if($user != null){
            if($password == $user->getPassword()){                
                    $_SESSION['login'] = $user->getLogin();
                    $_SESSION['userType'] = $user->getType();
                    $_SESSION['idUser'] = $user->getId();

                    if ($user->getType() == 1 || $user->getType() ==3){
                        $_SESSION['nom'] = $user->getNom();
                        $_SESSION['prenom'] = $user->getPrenom();

                    } elseif ($user->getType() == 2){
                        $_SESSION['raisonSociale'] = $user->getRaisonSociale();
                    }

                    header('Location:.');
            }else{
                    header('Location:.?page=login');
            }
    }else{
            header('Location:.?page=login');
    }
} else {
    header('Location:.?page=login');
}

