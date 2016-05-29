#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: offre
#------------------------------------------------------------

CREATE TABLE offre(
        id                 int (11) Auto_increment  NOT NULL ,
        libelle            Varchar (100) NOT NULL ,
        duree              Varchar (100) NOT NULL ,
        descriptionMission Longtext NOT NULL ,
        dateDebut          Date NOT NULL ,
        id_utilisateur     Int NOT NULL ,
        id_typeContrat     Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: typeContrat
#------------------------------------------------------------

CREATE TABLE typeContrat(
        id      int (11) Auto_increment  NOT NULL ,
        libelle Varchar (25) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: utilisateur
#------------------------------------------------------------

CREATE TABLE utilisateur(
        id                 int (11) Auto_increment  NOT NULL ,
        nom                Varchar (50) ,
        prenom             Varchar (50) ,
        adresse            Varchar (50) NOT NULL ,
        codePostal         Char (5) NOT NULL ,
        ville              Varchar (50) NOT NULL ,
        mail               Varchar (50) NOT NULL ,
        telephone          Char (10) NOT NULL ,
        login              Varchar (50) NOT NULL ,
        password           Varchar (100) NOT NULL ,
        type               Varchar (25) NOT NULL ,
        raisonSociale      Varchar (50) ,
        numeroSIRET        Varchar (50) ,
        id_cv              Int NOT NULL ,
        id_typeutilisateur Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: message
#------------------------------------------------------------

CREATE TABLE message(
        id               int (11) Auto_increment  NOT NULL ,
        contenu          Longtext NOT NULL ,
        lu               Bool ,
        id_utilisateur   Int NOT NULL ,
        id_utilisateur_1 Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: experiencePro
#------------------------------------------------------------

CREATE TABLE experiencePro(
        id                 int (11) Auto_increment  NOT NULL ,
        lieu               Varchar (50) NOT NULL ,
        dateDebut          Date NOT NULL ,
        duree              Varchar (50) NOT NULL ,
        posteOccupe        Varchar (100) NOT NULL ,
        descriptionMission Longtext NOT NULL ,
        id_cv              Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cv
#------------------------------------------------------------

CREATE TABLE cv(
        id             int (11) Auto_increment  NOT NULL ,
        titre          Varchar (50) NOT NULL ,
        langueParlee   Varchar (25) NOT NULL ,
        langueEcrite   Varchar (25) NOT NULL ,
        centreInterets Varchar (100) NOT NULL ,
        competences    Varchar (100) NOT NULL ,
        urlVideo       Varchar (100) ,
        id_utilisateur Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: formation
#------------------------------------------------------------

CREATE TABLE formation(
        id                 int (11) Auto_increment  NOT NULL ,
        intitule           Varchar (100) NOT NULL ,
        anneeDebut         Year NOT NULL ,
        anneeFin           Year NOT NULL ,
        nomEtablissement   Varchar (100) NOT NULL ,
        villeEtablissement Varchar (50) NOT NULL ,
        diplomeVise        Varchar (100) NOT NULL ,
        diplomeObtenu      Bool NOT NULL ,
        id_cv              Int NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: typeutilisateur
#------------------------------------------------------------

CREATE TABLE typeutilisateur(
        id      int (11) Auto_increment  NOT NULL ,
        libelle Varchar (25) NOT NULL ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: postuler
#------------------------------------------------------------

CREATE TABLE postuler(
        id             Int NOT NULL ,
        id_utilisateur Int NOT NULL ,
        PRIMARY KEY (id ,id_utilisateur )
)ENGINE=InnoDB;

ALTER TABLE offre ADD CONSTRAINT FK_offre_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE offre ADD CONSTRAINT FK_offre_id_typeContrat FOREIGN KEY (id_typeContrat) REFERENCES typeContrat(id);
ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_id_cv FOREIGN KEY (id_cv) REFERENCES cv(id);
ALTER TABLE utilisateur ADD CONSTRAINT FK_utilisateur_id_typeutilisateur FOREIGN KEY (id_typeutilisateur) REFERENCES typeutilisateur(id);
ALTER TABLE message ADD CONSTRAINT FK_message_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE message ADD CONSTRAINT FK_message_id_utilisateur_1 FOREIGN KEY (id_utilisateur_1) REFERENCES utilisateur(id);
ALTER TABLE experiencePro ADD CONSTRAINT FK_experiencePro_id_cv FOREIGN KEY (id_cv) REFERENCES cv(id);
ALTER TABLE cv ADD CONSTRAINT FK_cv_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
ALTER TABLE formation ADD CONSTRAINT FK_formation_id_cv FOREIGN KEY (id_cv) REFERENCES cv(id);
ALTER TABLE postuler ADD CONSTRAINT FK_postuler_id FOREIGN KEY (id) REFERENCES offre(id);
ALTER TABLE postuler ADD CONSTRAINT FK_postuler_id_utilisateur FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id);
