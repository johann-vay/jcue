<?php
$login=  htmlspecialchars($_POST['login']);
$password=saltHash(htmlspecialchars($_POST['password']));

$query='select password, idTypeUtilisateur, id, nom, prenom from utilisateur where login="'.$login.'"';
$result=Connexion::query($query);
if(sizeof($result)==1){
	if($password == $result[0][0]){                
		$_SESSION['login']=$login;
                $_SESSION['idTypeUser']=$result[0][1];
                $_SESSION['idUser']=$result[0][2];
                $_SESSION['nom'] = $result[0][3];
                $_SESSION['prenom'] = $result[0][4];
		header('Location:.');
	}else{
		header('Location:.?page=login');
	}
}else{
	header('Location:.?page=login');
}
