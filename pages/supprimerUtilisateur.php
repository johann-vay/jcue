<?php

$userId = $_GET['userId'];

supprimerUser($userId);
header('Location:.?page=listeUtilisateurs');

