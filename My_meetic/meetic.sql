DROP DATABASE IF EXISTS meetic;
CREATE DATABASE meetic;

USE meetic;

DROP TABLE IF EXISTS user;

CREATE TABLE user (
    id                  INT             NOT NULL AUTO_INCREMENT,
    nom                 VARCHAR(255)    NOT NULL,
    prenom              VARCHAR(255)    NOT NULL,
    email               VARCHAR(255)    NOT NULL UNIQUE,
    mdp                 VARCHAR(255)    NOT NULL,
    date_de_naissance   DATE            NOT NULL,
    genre               VARCHAR(255)    NOT NULL,
    ville               VARCHAR(255)    NOT NULL,
    loisir              VARCHAR(255)    NOT NULL,

    PRIMARY KEY (id)
);

INSERT INTO user
            (nom, prenom, email, mdp, date_de_naissance, genre, ville, loisir)
    VALUES  ('tighdine', 'massi', 'massinissa.tighdine@epitech.eu', '12345','1997-04-05', 'homme', 'clamart', 'jeux-video')