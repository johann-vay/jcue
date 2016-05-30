<?php

$postuler = new Postuler($_GET['offreId'], $_SESSION['idUser']);

$postulerDAO = new postulerDAO();

$postulerDAO->addPostuler($postuler);

header('Location:.?page=offre&offreId='.$_GET['offreId']);