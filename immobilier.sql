CREATE TABLE proprietaire (
    id INT NOT NULL AUTO_INCREMENT,
    numProprietaire INT NOT NULL,
    nomProprietaire VARCHAR(50) NOT NULL,
    prenomProprietaire VARCHAR(100) NOT NULL,
    adresse1Proprietaire VARCHAR(100) NOT NULL,
    adresse2Proprietaire VARCHAR(100) NOT NULL,
    codePostalProprietaire VARCHAR(30) NOT NULL,
    villeProprietaire VARCHAR(50) NOT NULL,
    numTel1Proprietaire VARCHAR(20) NOT NULL,
    numTel2Proprietaire VARCHAR(20) NOT NULL,
    CAcumule INT NOT NULL,
    email VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE tarif (
    id INT NOT NULL AUTO_INCREMENT,
    codeTarif VARCHAR(20) NOT NULL,
    prixSemHS INT NOT NULL,
    prixSemBS INT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE appartement (
    id INT NOT NULL AUTO_INCREMENT,
    idProprietaire INT NOT NULL,
    idTarif INT NOT NULL,
    numLocation INT NOT NULL,
    categorie VARCHAR(50) NOT NULL,
    typeAppartement VARCHAR(50) NOT NULL,
    nbPersonnes INT NOT NULL,
    adresseLocation VARCHAR(200) NOT NULL,
    photo VARCHAR(100) NOT NULL,
    equipements VARCHAR(500) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (idProprietaire) REFERENCES proprietaire (id),
    FOREIGN KEY (idTarif) REFERENCES tarif (id)
);

CREATE TABLE locataire (
    id INT NOT NULL AUTO_INCREMENT,
    numLocataire INT NOT NULL,
    nomLocataire VARCHAR(50) NOT NULL,
    prenomLocataire VARCHAR(100) NOT NULL,
    adresse1Locataire VARCHAR(100) NOT NULL,
    adresse2Locataire VARCHAR(100) NOT NULL,
    codePostalLocataire VARCHAR(30) NOT NULL,
    villeLocataire VARCHAR(50) NOT NULL,
    numTel1Locataire VARCHAR(20) NOT NULL,
    numTel2Locataire VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    PRIMARY KEY (id)
);

CREATE TABLE contrat (
    id INT NOT NULL AUTO_INCREMENT,
    idLocataire INT NOT NULL,
    idAppartement INT NOT NULL,
    numContrat INT NOT NULL,
    etat VARCHAR(50) NOT NULL,
    dateCreation DATE NOT NULL,
    dateDebut DATE NOT NULL,
    dateFIn DATE NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (idLocataire) REFERENCES locataire (id),
    FOREIGN KEY (idAppartement) REFERENCES appartement (id) 
);