<?php

function formulaireAjoutMessage(){
    $message = new Message(NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
    return formulaireMessage($message);
}

function formulaireModificationMessage($idMessage){
    $messageDAO = new messageDAO();
    $message = $messageDAO->messageDetails($idMessage);
    return formulaireMessage($message);
}

function formulaireMessage($message) {

    $html = '<form action=".?page=validationFormulaireMessage" method="POST" class="form-horizontal">
            <input type="hidden" name="id" value="'.$message->getId().'">'
            . champTexte('Contenu', 'contenu', $message->getContenu())
            . btnSubmit('validerMessage')
            . '</form>';
    return $html;
}

