<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of messageDAO
 *
 * @author Quentin
 */
class messageDAO {
    function __construct() {
    }
    
    public function messageList(){
        $query = 'SELECT  id, contenu, id_expediteur, id_destinataire'
                . 'FROM message';
        $arrayMessages = Connection::query($query);
        foreach ($arrayMessages as $message) {
            $messages[] = new Message($message[0], $message[1], $message[2], $message[3]);
        }
        return $messages;
    }
    
    public function messageDetails($message){
        $query = 'SELECT  id, contenu, id_expediteur, id_destinataire'
                . 'FROM message '
                . 'WHERE id = '.$message;
        $arrayDetails = Connection::query($query);
        foreach ($arrayDetails as $message) {
            $message[] = new Message($message[0], $message[1], $message[2], $message[3]);
        }
    }
}
