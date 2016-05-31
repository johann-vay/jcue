<?php
/*
 * Cette page permet d'inclure le code PHP d'une page écrite dans un autre fichier dont le nom est passé en paramètre dans l'url
 * de votre navigateur. Par exemple pour inclure le fichier nomDeFichier.php, il faut avoir écrit l'url suivant : 
 * http://url_du_site/index.php?page=nomDeFichier
 *  - le ? sépare le nom du fichier avec la liste des variables à envoyer qui sont à séparer par le symbole &
 *  - 'page' est un nom de variable, sa valeur est ici "nomDeFichier"
 *	- la valeur de cette variable 'page' est enregistrée automatiquement par PHP dans une autre variable globale (un tableau)
 *    au serveur web qui se nomme $_GET. 
 *  - pour accéder au contenu de la variable 'page' de l'url, il suffit d'écrire $_GET['page']
 */
 
header('Content-Type: text/html; charset=utf-8');
session_start();

// Liste des includes utiles
include('../required.php');

// Authentification
// Si la variable $_SESSION['login'] n'est pas initialisée et qu'une page est entrée dans l'url, on renvoie vers la page de login
if(!isset($_SESSION['login'])){
    if(isset($_GET['page']) && $_GET['page'] != 'validationFormLogin' && $_GET['page'] != 'choixType' && $_GET['page'] != 'inscription' && $_GET['page'] != 'validInscription' || !isset($_GET['page'])){
        $_GET['page'] = 'login';
    }
}

// On regarde si la variable 'page' a été placée dans l'url, si ce n'est pas le cas, on revient à index.php du répertoire pages/
if(!isset($_GET['page'])){
	$_GET['page'] = 'index';
} else {
    // Gestion des pages existantes
    // Si la variable 'page' a été placée dans l'url est qu'elle ne correspond à aucune page, on renvoie à la page 'notFound'
    if(file_exists('..\pages\\'.$_GET['page'].'.php')){
        $_GET['page'] = $_GET['page'];
    } else {
        // Si la variable 'userId' a été placée dans l'url est qu'elle ne correspond à aucun utilisateur, on renvoie à la page 'notFound'
        if (isset($_GET['userId'])){
            $rq = 'SELECT COUNT(id) '
                . 'FROM utilisateur '
                . 'WHERE id = '.$_GET['userId'];
            $result = Connection::query($rq);
            if ($result[0][0] == 0){
                header('Location:.?page=notFound');
            }
        }
        // Si la variable 'ficheId' a été placée dans l'url est qu'elle ne correspond à aucune fiche, on renvoie à la page 'notFound'      
        if (isset($_GET['offreId'])){
            $rq = 'SELECT COUNT(id) '
                . 'FROM offre '
                . 'WHERE id = '.$_GET['offreId'];
            $result = Connection::query($rq);
            if ($result[0][0] == 0){
                header('Location:.?page=notFound');
            }
        }
    }
}

// On prépare le fichier à appeler dans une nouvelle variable
$fichier = '../pages/'.$_GET['page'].'.php';

// On inclut le code de la page concernée
include ($fichier);
