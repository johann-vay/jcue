<?php

function formulaireFormation($formation) {

    $html = '<form action=".?page=validationFormulaireFormation" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="">'
            . champTexte('Intitulé', 'intitule')
            . champDate('Année début','anneeDebut')
            . champDate('Année fin','anneeFin')
            . champTexte('Nom établissement','nomEtablissement')
            . champTexte('Ville établissement','villeEtablissement')
            . champTexte('Diplôme visé','diplomeVise')
            . champTexte('Diplôme obtenu','diplomeObtenu')
            . champSelectQuery('id_cv', 'id_cv', 'SELECT `id` FROM cv',$valeur=null)
            . btnSubmit()
            . '</form>';
    return $html;
}

