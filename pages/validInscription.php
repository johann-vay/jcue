<?php

if (isset($_POST['validInscription'])){
    if ($_POST['idTypeUser'] == 1){
       if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['adresse']) && !empty($_POST['codePostal']) && !empty($_POST['ville']) && !empty($_POST['mail']) && !empty($_POST['telephone']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['password'] == $_POST['confirmPassword']){
            $login = strtolower($_POST['prenom']).'.'.strtolower($_POST['nom']);
            $password = saltHash($_POST['password']);
            $user = new User($_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['mail'], $_POST['telephone'], $login, $password, $_POST['idTypeUser'], $_POST['nom'], $_POST['prenom']);
            var_dump($user);
            $userDAO = new UserDAO();
            if ($userDAO->addParticulier($user)){
                header('Location:.');
            }else {
                echo 'L\'utilisateur n\'a pas été ajouté !';
            }

        }   
    }elseif ($_POST['idTypeUser'] == 2) {
        if(!empty($_POST['raisonSociale']) && !empty($_POST['numeroSiret']) && !empty($_POST['adresse']) && !empty($_POST['codePostal']) && !empty($_POST['ville']) && !empty($_POST['mail']) && !empty($_POST['telephone']) && !empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['password'] == $_POST['confirmPassword']){
            $raisonSoc = explode(' ', $_POST['raisonSociale']);
            $login = '';
            for ($i=0;$i<count($raisonSoc);$i++){
                if ($i != count($raisonSoc) -1){
                    $login .= strtolower($raisonSoc[$i]).'.';
                } else {
                    $login .= strtolower($raisonSoc[$i]);
                }
                
            }
            $password = saltHash($_POST['password']);
            $user = new User($_POST['adresse'], $_POST['codePostal'], $_POST['ville'], $_POST['mail'], $_POST['telephone'], $login, $password, $_POST['idTypeUser'], NULL, NULL, $_POST['raisonSociale'], $_POST['numeroSiret']);
            var_dump($user);
            $userDAO = new UserDAO();
            if ($userDAO->addEntreprise($user)){
                header('Location:.');
            }else {
                echo 'L\'utilisateur n\'a pas été ajouté !';
            }

        }
    }
    
}
