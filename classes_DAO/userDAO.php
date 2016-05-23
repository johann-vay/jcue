<?php
require_once '../classes/connection.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userDAO
 *
 * @author Johann
 */
class userDAO {
    
    private $database;
    
    function __construct() {
        $this->database = Connection::getInstance();
    }
    
    public function query($query){
    return $this->PDOInstance->query($query);
  }
    
    public function usersList(){
        $query = 'SELECT * from user';
        $result = $this->database->query($query);
        return $result;
    }


}

$userDAO = new userDAO();
echo $userDAO->usersList();
