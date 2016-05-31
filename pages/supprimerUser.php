<?php

$userId = $_GET['userId'];

$userDAO = new UserDAO();

$user = $userDAO->userDetails($userId);

$userDAO->deleteUser($user);

header('Location:.?page=listeUtilisateurs');

