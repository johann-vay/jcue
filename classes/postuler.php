<?php

class Postuler {
     
    private $id;
    private $id_offre;
    
    function __construct($id_offre, $id = null) {
        $this->id = $id;
        $this->id_offre = $id_offre;
    }

    function getId() {
        return $this->id;
    }

    function getId_offre() {
        return $this->id_offre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setId_offre($id_offre) {
        $this->id_offre = $id_offre;
    }

}