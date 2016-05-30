<?php
/**
 * Crée un tableau qui liste les utilisateurs de la base de données
 * 
 * @param array $users  Tableau qui contient le résultat de la requête qui selectionne tous les utilisateurs de la base de données
 * @return string  Tableau en HTMl
 */
function afficherTableauUsers($users) {
    $html = '<table class="table table-bordered table-hover dataTable">'
            . '<thead>'
                . '<tr>'
                    . '<th>Utilisateur</th><th>Nom</th><th>Prénom</th><th>Login</th><th>Type Utilisateur</th>'
                    . '<th></th><th></th>'
                . '</tr>'
            . '</thead>'
            . '<tbody>';
                foreach ($users as $user) {
                    $html.= '<tr>';
                        $html.='<td>' . lienUser($user[0]) . '</td>';
                        $html.='<td>' . $user[1] . '</td>';
                        $html.='<td>' . $user[2] . '</td>';
                        $html.='<td>' . $user[3] . '</td>';
                        $html.='<td>' . $user[4] . '</td>';
                        if ($_SESSION['idTypeUser'] == 1 && $_SESSION['idUser'] != $user[0]){
                            $html.='<td>' . lienFormulaireModificationUser($user[0]) . '</td>';
                            $html.='<td>' . lienSuppressionUser($user[0]) . '</td>'.modalSuppressionUser($user[0]);
                            }else {
                                $html.='<td>' . lienFormulaireModificationUser($user[0]) . '</td>';
                                $html .= '<td></td>';
                        }
                    $html.='</tr>';
                }
    $html.= '</tbody>'
        . '</table>';
    return $html;
}

/**
 * Crée un formulaire pour l'ajout d'un utilisateur
 * 
 * @return formulaireUser  Formulaire vide pour l'ajout d'un utilisateur
 */
function formulaireAjoutUtilisateur() {
    $utilisateur = ['', '', '', '', '', '', ''];
    return formulaireUser($utilisateur);
}

/**
 * Crée un formulaire pour utilisateur
 * 
 * @param array $user  Tableau contenant les données d'un utilisateur
 * @return string  Formulaire en HTML
 */
function formulaireUser($user){
    $html = '<form action=".?page=validationFormulaireUtilisateur" method="POST" class="form-horizontal">
                <input type="hidden" name="id" value="'.$user[0].'">'
                . champTexte('Nom', 'nom', $user[1])
                . champTexte('Prénom', 'prenom', $user[2])
                . champTexte('Email', 'email', $user[4])
                . champSelectTypeUser($user[6])
                . btnSubmit('validerUser')
            . '</form>';
    return $html;
}

function formulaireModificationUtilisateur($userId){
    $user = infoUsers($userId);
    return formulaireUser($user);
}

function lienFormulaireModificationUser($userId) {
    return '<a class="btn btn-default" href=".?page=formulaireModificationUtilisateur&userId=' . $userId . '"><i class="fa fa-edit"></i></a>';
}
/**
 * Crée un liste déroulante des types utilisateur de la base de données
 * 
 * @param int $typeUserId  Id du type utilisateur (falcultatif selon ajout ou modification
 * @return champSelectQuery  Liste déroulante en HTML
 */
function champSelectTypeUser($typeUserId='') {
    return champSelectQuery('Type Utilisateur', 'idTypeUser', 'SELECT id, libelle FROM typeutilisateur ORDER BY id', $typeUserId);
}

/**
 * Ajoute un nouvel utilisateur dans la base de données 
 * 
 * @param string $nom  Nom du nouvel utilisateur
 * @param string $prenom  Prénom du nouvel utilisateur
 * @param string $login  Login du nouvel utilisateur
 * @param string $password  Mot de passe du nouvel utilisateur
 * @param int $typeUtilisateur  Id du type utilisateur du nouvel utilisateur
 * @return boolean  True si l'ajout a fonctionné sinon False
 */
function ajouterUser($nom, $prenom, $login, $password, $email, $typeUtilisateur) {
    $query = 'INSERT INTO utilisateur SET nom="' . $nom . '", prenom="' . $prenom. '", login="' . $login . '", password="' . $password . '", mail="'.$email.'", idTypeUtilisateur=' . $typeUtilisateur ;
    return Connexion::exec($query);
}


/**
 * Renvoie un tableau contenant les données d'un utilisateur (Utile pour la fiche utilisateur)
 * 
 * @param int $userId  Id de l'utilisateur dont on souhaite les infos
 * @return boolean  True si la requête a fonctionné sinon False
 */
function infoUsers($userId) {
    $requete = 'SELECT utilisateur.id, utilisateur.nom, utilisateur.prenom, utilisateur.login, utilisateur.mail, typeutilisateur.libelle, utilisateur.idTypeUtilisateur '
             . 'FROM utilisateur, typeutilisateur '
             . 'WHERE idTypeUtilisateur=typeutilisateur.id '
             . 'AND utilisateur.id='.$userId;
    $result = Connexion::query($requete);
    return $result[0];
}

/**
 * Crée un bouton qui permet la réinitialisation du mot de passe d'un utilisateur
 * 
 * @param int $userId  Id de l'utilisateur qui souhaite voir son mot de passe réinitialisé
 * @return string  Bouton HTMl
 */
function lienReinitPassword($userId) {
    return '<a class="btn btn-default" href=".?page=reinitialisationPassword&userId=' . $userId . '">Réinitialiser le mot de passe</a>';
}

/**
 * Crée un bouton qui redirige vers la page d'infos d'un utilisateur
 * 
 * @param int $userId  Id de l'utilisateur dont on souhaite voir sa fiche
 * @return string  Bouton HTML
 */
function lienUser($userId) {
    $html = '<a href=".?page=utilisateur&userId=' . $userId . '"><i class="fa fa-eye"></i></a>';
    return $html;
}

/**
 * Modifie le mot de passe d'un utilisateur 
 * 
 * @param string $newPassword  Nouveau mot de passe de l'utilisateur
 * @param int $userId  Id de l'utilisateur qui souhaite modifier son mot de passe
 * @return booelan  True si la modification a fonctionné sinon False
 */
function changePassword($newPassword, $userId){
    $requete = 'UPDATE utilisateur SET password="'.$newPassword.'" WHERE id='.$userId;
    return Connexion::exec($requete);
}

/**
 * Modification de l'email d'un utilisateur
 * 
 * @param string $newMail  Nouvelle adresse mail de l'utilisateur
 * @param int $userId  Id de l'utilisateur qui souhaite modifier son adresse mail
 */
function updateUser($userId, $nom, $prenom, $login, $email, $typeUser){
    $requete = 'UPDATE utilisateur SET nom="'.$nom.'", prenom="'.$prenom.'",  login="'.$login.'", mail="'.$email.'", idTypeUtilisateur="'.$typeUser.'" WHERE id='.$userId;
    Connexion::exec($requete);
}

/**
 * Réinitialise le mot de passe d'un utilisateur
 * 
 * @param int $userId  Id de l'utilisateur dont on souhaite réinitialiser le mot de passe
 * @return string  Nouveau mot de passe (dans un fenêtre modale // envoi par mail à l'utilisateur concerné
 */
function reinitPassword($userId){
    $chaine = chaineAleatoire();
    $newPassHash = saltHash($chaine);
    $requete = 'UPDATE utilisateur SET utilisateur.password="'.$newPassHash.'" WHERE utilisateur.id ='.$userId;
    Connexion::exec($requete);
    mailReinitPassword($userId, $chaine);
}


/**
 * Crée un formulaire pour la modification du mot de passe
 * 
 * @param int $userId  Id de l'utilisateur qui souhaite modififer son mot de passe
 * @return string  Formulaire HTML pour la modification
 */
function formulairePassword($userId) {
    $html = '<form action=".?page=perso&userId='.$userId.'" method="POST" class="form-horizontal pull-left col-sm-6">'
            . champTexte('Mot de passe actuel', 'oldPassword',"",'password')
            . champTexte('Nouveau mot de passe', 'newPassword', "", 'password')
            . champTexte('Confirmer le nouveau mot de passe', 'confirmNewPassword', "", 'password')
            . btnSubmit('validerNewPassword')
            . '</form>';
    return $html;
}

/**
 * Renvoie le mot de passe d'un utilisateur
 * 
 * @param int $userId  Id de l'utilisateur dont on souhaite le mot de passe
 * @return array  Mot de passe de l'utilisateur
 */
function passwordUser($userId){
    $requete = 'SELECT password '
             . 'FROM utilisateur '
             . 'WHERE id ='.$userId;
    $result = Connexion::query($requete);
    return $result[0][0];
}

/**
 * Suppression d'un utilisateur de la base de données
 * 
 * @param int $userId  Id de l'utilisateur à supprimer
 * @return boolean  True si la suppresion a fonctionné sinon False
 */
function supprimerUser($userId){
    $requete1 = 'DELETE '
              . 'FROM utilisateur '
              . 'WHERE id='.$userId;
    return Connexion::exec($requete1);
}

/**
 * Crée un bouton permettant la suppression d'un utilisateur
 * 
 * @param int $userId  Id de l'utilisateur à supprimer
 * @return string  Bouton html
 */
function lienSuppressionUser($userId) {
    return '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modalSupprUser'.$userId.'"><i class="fa fa-trash-o" style="color:red"></i></a>';
}


/**
 * Génère une chaîne de 10 caractères aléatoires (majuscules, minuscules, chiffres)
 * 
 * @return string  Chaîne de 10 caractères aléatoires
 */
function chaineAleatoire(){
    $chaine = 'AZERTYUIOPQSDFGHJKLMWXCVBN0123456789azertyuiopqsdfghjklmwxcvbn';
    $nbChars = strlen($chaine) - 1;
    $newChaine = '';
    for($i=0; $i < 10; $i++){
        $pos = mt_rand(0, $nbChars);
        $char = $chaine[$pos];
        $newChaine .= $char;
    }
    return $newChaine;
}


function nbUsers(){
    $nbUsers = Connexion::query('SELECT COUNT(id) from utilisateur');
    return $nbUsers[0][0];
}

function montantValidationDirection(){
    $montant = Connexion::query('SELECT montantValidation FROM typeutilisateur WHERE id = 6');
    return $montant[0][0];
}

function modalSuppressionUser($userId){
    $html = '<div class="modal modal-danger" id="modalSupprUser'.$userId.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Supprimer l\'utilisateur</h4>
              </div>
              <div class="modal-body">
                <p>Attention ! Vous allez supprimer un utilisateur. Cette action est irrévocable.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                <a href=".?page=supprimerUtilisateur&userId='.$userId.'"><button type="button" class="btn btn-outline">Supprimer</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>';
    
    return $html;
}