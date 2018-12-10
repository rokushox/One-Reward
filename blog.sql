CREATE DATABASE blog
    DEFAULT CHARACTER SET utf8;

USE blog;

CREATE TABLE usuarios (
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    nombre VARCHAR(25) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fecha_registro DATETIME NOT NULL,
    activo TINYINT NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE recuperacion_clave (
    id INT NOT NULL UNIQUE AUTO_INCREMENT,
    usuario_id INT NOT NULL,
    url_secreta VARCHAR(255) NOT NULL,
    fecha DATETIME NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(usuario_id)
        REFERENCES usuarios(id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
);



