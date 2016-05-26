<?php

$ficheId = $_GET['ficheId'];

supprimerFiche($ficheId);
header('Location:.?page=listeFiches');

