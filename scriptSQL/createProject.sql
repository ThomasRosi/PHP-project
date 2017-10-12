/*Initialisation de la BDD*/
CREATE DATABASE IF NOT EXISTS project;

/*Initialisation des tables*/
USE project;
CREATE TABLE users (
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    level INT NOT NULL DEFAULT 2,
    CONSTRAINT pk_users PRIMARY KEY(email)
);

CREATE TABLE tracks(
    title VARCHAR(255) NOT NULL,
    album VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    track_id INT NOT NULL AUTO_INCREMENT,
    CONSTRAINT pk_tracks PRIMARY KEY(track_id)
);

CREATE TABLE playlists(
    name VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    playlist_id INT NOT NULL AUTO_INCREMENT,
    CONSTRAINT pk_playlists PRIMARY KEY(playlist_id)
);

CREATE TABLE links(
    playlist_id INT NOT NULL,
    track_id INT NOT NULL
);