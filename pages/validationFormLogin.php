<?php

$login=  htmlspecialchars($_POST['login']);
$password=htmlspecialchars($_POST['password']);

$userDAO = new UserDAO();
$user = $userDAO->userByLogin($login);

if($user != null){
	if($password == $user->getPassword()){                
		$_SESSION['login']=$user->getLogin();
                $_SESSION['userType']=$user->getType();;
                $_SESSION['idUser']=$user->getId();
		header('Location:.');
	}else{
		header('Location:.?page=login');
	}
}else{
	header('Location:.?page=login');
}
