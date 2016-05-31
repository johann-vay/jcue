<?php

function formulaireAjoutOffre(){
    $offre = new Offre(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireOffre($offre);
}

function formulaireModificationOffre($idOffre){
    $offreDAO = new offreDAO();
    $offre = $offreDAO->offreDetails($idOffre);
    return formulaireOffre($offre);
}
    
function formulaireOffre($offre) {
    $typeContratDAO = new typeContratDAO();
    $listeTypesContrat = $typeContratDAO->typeContratList();

    $html = '<form action="" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$offre->getId().'">'
            . champTexte('Libellé', 'libelle', $offre->getLibelle())
            . champTexte('Durée','duree', $offre->getDuree())
            . champTexte('Decription mission','descriptionMission', $offre->getDescriptionMission())
            . champDate('Date début','dateDebut', $offre->getDateDebut())
            . champSelect('Type contrat', 'idTypeContrat', $listeTypesContrat, $offre->getId_typeContrat())
            . btnSubmit('validerOffre')
            . '</form>';
    return $html;
}


function lienSupprimerOffre($offreId){
    return '<a class="btn btn-default" href="#" data-toggle="modal" data-target="#modalSupprOffre'.$offreId.'"><i class="fa fa-trash-o" style="color:red"></i></a>';
}

function modalSuppressionOffre($offreId){
    $html = '<div class="modal modal-danger" id="modalSupprOffre'.$offreId.'">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Supprimer l\'utilisateur</h4>
              </div>
              <div class="modal-body">
                <p>Attention ! Vous allez supprimer une offre. Cette action est irrévocable.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Annuler</button>
                <a href=".?page=supprimerOffre&offreId='.$offreId.'"><button type="button" class="btn btn-outline">Supprimer</button></a>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>';
    
    return $html;
}