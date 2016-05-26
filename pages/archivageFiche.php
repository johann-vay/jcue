<?php


$ficheId = $_GET['ficheId'];

$archive = updateArchive($ficheId);

header('Location:.?page=listeFiches');