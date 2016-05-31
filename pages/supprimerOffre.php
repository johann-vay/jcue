<?php


$offreID = $_GET['offreId'];

$offreDAO = new offreDAO();

$offre = $offreDAO->offreDetails($offreId);

$offreDAO->deleteOffre($offre);

header('Location:.?page=listeOffres');