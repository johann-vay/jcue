<?php

function mailAutoValidation($destinataire, $infoFiches){
    $subject = 'Validation formulaire fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' est en attente de votre validation.</b><br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailAutoRefus($infoFiches, $acteurRefus, $commentaires=''){
    $reqEmetteur = 'SELECT mail from utilisateur where id ='.$infoFiches[8];
    $resultEmetteur = Connexion::query($reqEmetteur);
    $destinataire = $resultEmetteur[0][0];
    
    $subject = 'Refus - fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' a été refusée par '.$acteurRefus.'.</b><br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>';
    if ($commentaires != ''){
        $body .= 'Commentaires du refus : '.$commentaires.'<br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    }
    $body .= 'Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailAutoFinCircuit($infoFiches){
    $reqEmetteur = 'SELECT mail from utilisateur where id ='.$infoFiches[8];
    $resultEmetteur = Connexion::query($reqEmetteur);
    $destinataire = $resultEmetteur[0][0];
    
    $subject = 'Fin de circuit - fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' a été validée par tous les acteurs.</b><br>'
            . 'Veuillez vous rendre sur la SEP avant d\'activer le "Bon pour Action"<br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailAutoActionBE($destinataire, $infoFiches){
    $subject = 'Bon pour Action - fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' a été validée par l\'ensemble des acteurs.</b><br>'
            . 'Vous devez remplir votre formulaire concernant le circuit de validation pour l\'envoi à la logistique.<br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailAutoActionLog($destinataire, $infoFiches){
    $subject = 'Bon pour Action - fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' a été validée par l\'ensemble des acteurs.</b><br>'
            . 'Vous devez remplir votre formulaire concernant le circuit de validation..<br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailAutoFinCircuitProd($infoFiches){
    $reqEmetteur = 'SELECT mail from utilisateur where idTypeUtilisateur = 9';
    $resultEmetteur = Connexion::query($reqEmetteur);
    $destinataire = $resultEmetteur[0][0];
    
    $subject = 'Fin de circuit - fiche n° '.$infoFiches[7];
    $body = '<b>La fiche n° '.$infoFiches[7].' a été validée par tous les acteurs.</b><br>'
            . 'Vous pouvez dès à présent imprimer la fiche SEP avoir l\'avoir exporté depuis le bouton "Export Excel"<br>'
            . 'Voici les informations de la fiche n° '.$infoFiches[7].' :<br>'
            . '<ul>'
                . '<li>Date de création : '.dateus2fr($infoFiches[0]).'</li><br>'
                . '<li>Marque du bateau : '.infoMarque($infoFiches[1]).'</li><br>'
                . '<li>Modèle du bateau : '.infoModele($infoFiches[2]).' n° '.$infoFiches[3].'</li><br>'
                . '<li>Type du bateau : '.infoType($infoFiches[4]).'</li><br>';
                if ($infoFiches[5] != ''){
                    $body .= '<li>Motif de la demande : '.$infoFiches[5].'</li><br>';
                }
                if ($infoFiches[6] != ''){
                    $body .= '<li>Résumé : '.$infoFiches[6].'</li><br>';
                }
    $body .= '</ul><br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}

function mailReinitPassword($userId, $newPassword){
    $reqUser = 'SELECT mail from utilisateur where id ='.$userId;
    $resultUser = Connexion::query($reqUser);
    $destinataire = $resultUser[0][0];
    
    $subject = 'Réinitialisation du mot de passe';
    $body = '<b>Votre mot de passe a été réinitialisé !</b><br>'
            . 'Vous pouvez dès à présent vous connecter avec le mot de passe suivant : '.$newPassword.'<br>'
            . 'Vous pourrez le modifier lors de votre prochaine connexion.<br>'
            . '<br>Rendez-vous <a href="192.168.30.163/sep">ici</a>';
    mail($destinataire, $subject, $body, 'Content-type: text/html');
}