<?php

$ficheId = $_GET['ficheId'];
$infosFiche = infoFiches($ficheId);

updateBonPourAction($ficheId);

$reqEmailBE = 'SELECT mail '
            . 'FROM utilisateur '
            . 'WHERE idTypeUtilisateur = 2';
$resultEmailBE = Connexion::query($reqEmailBE);
$emailBE = $resultEmailBE[0][0];

mailAutoActionBE($emailBE, $infosFiche);

header('Location:.?page=fiche&ficheId='.$ficheId);