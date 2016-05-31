<?php

function formulaireUser($user) {

    $html = '<form action=".?page=validationFormulaireUser" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Adresse', 'adresse')
            . champTexte('Code Postal','codePostal')
            . champTexte('Ville','ville')
            . champTexte('Mail','mail')
            . champTexte('Téléphone','telephone')
            . champTexte('Login','login')
            . champTexte('Mot de passe', 'password',"",'password')
            . champTexte('Type','type')
            . btnSubmit()
            . '</form>';
    return $html;
}

function lienParticulier($particulierId) {
    $html = '<a href=".?page=particuliere&particulierId=' . $particulierId . '"><i class="fa fa-eye"></i></a>';
    return $html;
}

function saltHash($password){
    $prefixe ='Gz55ZEf6F';
    $suffixe ='ZERqg48D77d';
    $passwordHash = openssl_digest($prefixe.$password.$suffixe, 'sha256');
    
    return $passwordHash;
}


function lienSupprimerUser($userId){
    return '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modalSupprUser'.$userId.'"><i class="fa fa-trash-o" style="color:red"></i></a>';
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
                <a href=".?page=supprimerUser&userId='.$userId.'"><button type="button" class="btn btn-outline">Supprimer</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>';
    
    return $html;
}
