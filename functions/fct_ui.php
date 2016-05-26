<?php
/**
 * Crée un bouton simple en HTML
 * 
 * @param string $url  URL du lien du bouton
 * @param string $text  Texte à afficher sur le bouton 
 * @return string Bouton en HTML
 */
function bouton($url, $text) {
    return '<a href="' . $url . '" class="btn btn-default">' . $text . '</a>';
}

/**
 * Crée un champ texte en HTML
 * 
 * @param string $label  Label du champ de saisie
 * @param string $inputName  Attribut name du champ
 * @param string $value  Attribut value du champ
 * @param string $type  Type du champ (text, date...)
 * @param string $texteInfoBulleAide  Texte de l'infobulle si voulu
 * @return string Champ de saisie HTML
 */
function champTexte($label, $inputName, $value = '', $type = 'text', $texteInfoBulleAide = '') {
    $html = '<div class="form-group">
                <label for="' . $inputName . '" class="col-sm-5 col-md-5 col-lg-4  left-control-label">'
                    . $label .'</label>';
                    if ($texteInfoBulleAide != ''){
                        $html .= infobulleAide($texteInfoBulleAide);
                    }
      $html .= '<div class="col-sm-7 col-md-5 col-lg-8">
                    <input class="form-control"  type="' . $type . '" name="' . $inputName . '" value="' . $value . '">';
      $html .= '</div>
           </div>';
    return $html;
}

/**
 * Crée une textarea HTML
 * 
 * @param string $label  Label de la textarea
 * @param string $name  Attribut name de la textarea
 * @param string $value  Attribut value de la textarea
 * @return string  Textarea en HTML
 */
function textArea($label, $name, $value =''){
    $html = '<div class="form-group">
                <label for="'.$name.'" class="col-sm-5 col-md-5 col-lg-4 left-control-label">'.$label.'</label>';
                if($value != ''){
                    $html .= '<div class="col-sm-7 col-md-5 col-lg-8"><textarea class="form-control"  name="'.$name.'" placeholder="Saisir le texte..">'.$value.'</textarea></div>';
                }else{
                    $html .= '<div class="col-sm-7 col-md-5 col-lg-12"><textarea class="form-control" name="'.$name.'" placeholder="Saisir le texte.."></textarea></div>';
                }
                
    $html.='</div>';
    return $html;
                
}

/**
 * Crée un champ de saisie de type date en HTML (à partir de la fonction champTexte)
 * 
 * @param string $label  Label du champ date
 * @param string $inputName  Attribut name du champ date
 * @param date $value  Attribut value du champ date
 * @return string  Champ date en HTML
 */
function champDate($label, $inputName, $value='') {
    if($value==''){
        $html=champTexte($label, $inputName, '', 'date');        
    }else{
        $html=champTexte($label, $inputName, dateus2fr($value), 'date');
    }
    return $html;
}

/**
 * Crée un champ de type file pour l'upload de ficher
 * 
 * @param string $label  Label du champ
 * @param string $inputName  Attribut name du champ
 * @return string  Champ file en HTML
 */
function champUpload($label, $inputName, $texteInfoBulleAide = '') {
    $html = '<div class="form-group">
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000000">
                <label for="'.$inputName.'" class="col-sm-4 col-md-4 col-lg-4 left-control-label">'.$label.'</label>';
                    if ($texteInfoBulleAide != ''){
                        $html .= infobulleAide($texteInfoBulleAide);
                    }
                $html.= '<div class="col-sm-6 col-md-5 col-lg-7">
                    <input name="'.$inputName.'" type="file"></input>
                </div>
            </div>';
    return $html;
}

/**
 * Crée une liste déroulante en HTML
 * 
 * @param string $label  Label de la liste
 * @param string $name  Attribut name de la liste
 * @param array $liste  Tableau contenant les valeurs de la liste (issues d'une requête)
 * @param int $value  Attribut value de la liste
 * @return string  Liste déroulante en HTML
 */
function champSelect($label, $name, $liste, $value) {
    $html ='<div class="form-group">
                <label for="' . $name . '" class="col-sm-5 col-md-5 col-lg-4 left-control-label">' . $label . '</label>
                <div class="col-sm-7 col-md-5 col-lg-8">
                    <select name="' . $name . '" class="form-control">';
                        foreach ($liste as $l) {
                            $id = $l[0];
                            unset($l[0]);
                            $label = implode(' ', $l);
                            if ($id == $value) {
                                $html.='<option value="' . $id . '" selected>' . $label . '</option>';
                            } else {
                                $html.='<option value="' . $id . '">' . $label . '</option>';
                            }
                        }
            $html.='</select>
                </div>
            </div>';
    return $html;
}

/**
 * Crée la liste déroulante en fonction de la requête (issu de la fonction précédente)
 * 
 * @param type $label
 * @param type $name
 * @param type $query
 * @param type $value
 * @return type
 */
function champSelectQuery($label, $name, $query, $value = null) {
    $liste = Connexion::query($query);
    return champSelect($label, $name, $liste, $value);
}

/**
 * Crée un bouton submit pour valider les formulaires
 * 
 * @param string $name Attribut name du bouton
 * @return string  Bouton submit en HTML
 */
function btnSubmit($name) {
    $html ='<div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" name="'.$name.'" class="btn btn-primary pull-right">Valider</button>
		</div>
            </div>';
    return $html;
}

function messages(){
    if (isset($_SESSION['messages'])){
        $allMessages = $_SESSION['messages'];
        $html = '<div class="col-xs-12">';
                    foreach ($allMessages as $type => $messages){
                        foreach ($messages as $m){
                            $html.='<div class="alert-'.$type.' alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">×</span></button>
                                        '.$m.'
                                    </div>';
                        }
                        $html.='</div>';
                    }
        unset($_SESSION['messages']);
        return $html;
    }
}


/**
 * Crée une liste déroulante contenant les valeurs Oui et Non
 * 
 * @param string $label  Label de la liste
 * @param string $name Attribut name de la liste
 * @param int $value  Attribut value de la liste
 * @return string  Liste déroulante HTML
 */
function champSelectOuiNon($label, $name, $value=''){
    $html ='<div class="form-group">
                <label for="'.$name.'" class="col-sm-5 col-md-5 col-lg-4 left-control-label">'.$label.'</label>
                <div class="col-sm-7 col-md-5 col-lg-5">
                    <select name="'.$name.'" class="form-control">';
                        if ($value == ''){
                            $html .= '<option value="1">Oui</option>';
                            $html .= '<option value="0">Non</option>';
                        } elseif ($value == 1){
                            $html .= '<option value="1" selected>Oui</option>';
                            $html .= '<option value="0">Non</option>';
                        } elseif ($value == 0){
                            $html .= '<option value="1">Oui</option>';
                            $html .= '<option value="0" selected>Non</option>';
                        }
            $html.='</select>
                </div>
            </div>';
    return $html;
}

/**
 * Crée une infobulle
 * 
 * @param string $texte  Texte de l'infobulle
 * @return string Infobulle en HTML
 */
function infobulleAide($texte){
    $html = '<a class="info" href="#"><i class="col-lg-1 col-md-1 col-sm-1 fa fa-question-circle"></i><span>'.$texte.'</span></a>';
    return $html;
}


/**
 * Crée une liste déroulante contenant les valeurs Oui et Non
 * 
 * @param string $label  Label de la liste
 * @param string $name Attribut name de la liste
 * @param int $value  Attribut value de la liste
 * @return string  Liste déroulante HTML
 */
function champSelectOuiNA($label, $name, $value=''){
    $html ='<div class="form-group">
                <label for="'.$name.'" class="col-sm-5 col-md-5 col-lg-4 left-control-label">'.$label.'</label>
                <div class="col-sm-7 col-md-5 col-lg-5">
                    <select name="'.$name.'" class="form-control">';
                        if ($value == ''){
                            $html .= '<option value="1">Oui</option>';
                            $html .= '<option value="0">N/A</option>';
                        } elseif ($value == 1){
                            $html .= '<option value="1" selected>Oui</option>';
                            $html .= '<option value="0">N/A</option>';
                        } elseif ($value == 0){
                            $html .= '<option value="1">Oui</option>';
                            $html .= '<option value="0" selected>N/A</option>';
                        }
            $html.='</select>
                </div>
            </div>';
    return $html;
}