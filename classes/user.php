<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author Johann
 */
class User {
    
    private $id;
    private $nom;
    private $prenom;
    private $adresse;
    private $codePostal;
    private $ville;
    private $mail;
    private $telephone;
    private $login;
    private $password;
    private $raisonSociale;
    private $numeroSiret;
    private $type;
    
     
    function __construct($adresse, $codePostal, $ville, $mail, $telephone, $login, $password, $type, $nom = null, $prenom = null, $raisonSociale = null, $numeroSiret = null, $id = null) {
        $this->id = $id;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->mail = $mail;
        $this->telephone = $telephone;
        $this->login = $login;
        $this->password = $password;
        $this->type = $type;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->raisonSociale = $raisonSociale;
        $this->numeroSiret = $numeroSiret;
    }
    
    function getId() {
        return $this->id;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCodePostal() {
        return $this->codePostal;
    }

    function getVille() {
        return $this->ville;
    }

    function getMail() {
        return $this->mail;
    }

    function getTelephone() {
        return $this->telephone;
    }

    function getLogin() {
        return $this->login;
    }

    function getPassword() {
        return $this->password;
    }

    function getType() {
        return $this->type;
    }
    function getNom() {
        return $this->nom;
    }

    function getPrenom() {
        return $this->prenom;
    }

    function getRaisonSociale() {
        return $this->raisonSociale;
    }

    function getNumeroSiret() {
        return $this->numeroSiret;
    }

    function setNom($nom) {
        $this->nom = $nom;
    }

    function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    function setRaisonSociale($raisonSociale) {
        $this->raisonSociale = $raisonSociale;
    }

    function setNumeroSiret($numeroSiret) {
        $this->numeroSiret = $numeroSiret;
    }

    
    function setId($id) {
        $this->id = $id;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
    }

    function setCodePostal($codePostal) {
        $this->codePostal = $codePostal;
    }

    function setVille($ville) {
        $this->ville = $ville;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

    function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setType($type) {
        $this->type = $type;
    }
}