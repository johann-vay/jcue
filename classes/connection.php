<?php

/*
 * Deux fonctions sont crées pour lancer une requéte SQL. Un exmple d'appel de ces fonctions dans du code :
 *  - $tableauDeResultats = Connexion::query("SELECT * FROM nom_table");
 *    Le résultat de la requète est enregistré dans la variable $tableauDeResultats 
 *  - $succes = Connexion::exec("INSERT..."); marche aussi pour UPDATE et DELETE
 *    Le résultat de la requete est placé dans la variable $succes : si 0 alors la requète n'a pas
 *    fonctionnée, sinon $succes contiendra le nombre d'enregistrement affectés
 */

class Connection {

    private static $_pdo = null;

    
    
    
    private static $connection = null;
    private $pdo = null;
    private $host = "localhost";
    private $login = "root";
    private $pass = "pwroot";
    private $db = "jcue";
     
    private function __construct(){
        $pdo = new PDO("mysql:host=".$this->host.";dbname=".$this->db, $this->login, $this->pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
     
    public static function getInstance(){
        if (is_null(self::$connection)){
            self::$connection = new self();
        } else {
             return self::$connection;
        }
    }
    

    public function query($query) {
        if (is_null(self::$connection)) {
            self::getInstance();
        }
        
        $result = self::$connection->query($query);
        if(!$result){
            throw new Exception('Erreur de requête : '.$query);
        }
        return $result->fetchAll(PDO::FETCH_NUM);
    }

    public static function exec($query) {
        if (is_null(self::$connection)) {
            self::getInstance();
        }
        return self::$connection->exec($query);
    }

}
