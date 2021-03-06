<?php
// Include du Singleton
require_once '../classes/singleton/connection.php';

// Include des classes
require_once '../classes/user.php';
require_once '../classes/cv.php';
require_once '../classes/experiencePro.php';
require_once '../classes/formation.php';
require_once '../classes/message.php';
require_once '../classes/offre.php';
require_once '../classes/postuler.php';
require_once '../classes/typeContrat.php';
require_once '../classes/typeUtilisateur.php';


// Include des classes DAO
require_once '../classes_DAO/cvDAO.php';
require_once '../classes_DAO/experienceProDAO.php';
require_once '../classes_DAO/formationDAO.php';
require_once '../classes_DAO/messageDAO.php';
require_once '../classes_DAO/offreDAO.php';
require_once '../classes_DAO/postulerDAO.php';
require_once '../classes_DAO/typeContratDAO.php';
require_once '../classes_DAO/typeUtilisateurDAO.php';
require_once '../classes_DAO/userDAO.php';

// Include des fonctions utiles
require_once '../functions/fct_date.php';
require_once '../functions/fct_formCv.php';
require_once '../functions/fct_formEntreprise.php';
require_once '../functions/fct_formExperiencePro.php';
require_once '../functions/fct_formFormation.php';
require_once '../functions/fct_formMessage.php';
require_once '../functions/fct_formOffre.php';
require_once '../functions/fct_formParticulier.php';
require_once '../functions/fct_formPersonnel.php';
require_once '../functions/fct_formPostuler.php';
require_once '../functions/fct_formTypeContrat.php';
require_once '../functions/fct_formUtilisateur.php';
require_once '../functions/fct_ui.php';
require_once '../functions/fct_postuler.php';
require_once '../functions/fct_offre.php';
