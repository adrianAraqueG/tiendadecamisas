CREATE DATABASE tienda_master;
USE tienda_master;

/* Creando la tabla USUARIOS*/
CREATE TABLE usuarios(
    id                  int(255) auto_increment NOT NULL,
    nombre              varchar(100) NOT NULL,
    apellidos           varchar(255) NOT NULL,
    email               varchar(255) NOT NULL,
    password            varchar(255) NOT NULL,
    fecha               date NOT NULL,
    imagen              varchar(255) NOT NULL,
    rol                 varchar(255) NOT NULL,

    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE (email)
)ENGINE=InnoDB;
INSERT INTO usuarios VALUES(NULL, 'Admin', 'Admin', 'admin@admin', 'password', CURDATE(), 'local/img.jpg', 'Administrador');


/* Creando la tabla USUARIOS*/
CREATE TABLE categorias(
    id                  int(255) auto_increment NOT NULL,
    nombre              varchar(255) NOT NULL,

    CONSTRAINT pk_categorias PRIMARY KEY (id)
)ENGINE:InnoDB;
INSERT INTO categorias VALUES(NULL, 'Manga Corta');


/* Creando la tabla PRODUCTOS*/
CREATE TABLE productos(
    id                  int(255) auto_increment NOT NULL,
    categoria_id        int(255) NOT NULL,
    nombre              varchar(255) NOT NULL,
    descripcion         MEDIUMTEXT,
    precio              int(255) NOT NULL,
    stock               int(255) NOT NULL,
    oferta              varchar(255),
    fecha               date NOT NULL,
    imagen              varchar(255) NOT NULL,

    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_categoria_id FOREIGN KEY (categoria_id) REFERENCES categorias(id)
)ENGINE:InnoDB;
INSERT INTO productos VALUES(NULL, 1, 'Camisa Negra', 'Camisa negra manga corta estampada', 22, 10, NULL, CURDATE(), 'local/camisa.jpg');


/* Creando la tabla PEDIDOS*/
CREATE TABLE pedidos(
    id                  int(255) auto_increment NOT NULL,
    usuario_id          int(255) NOT NULL,
    provincia           varchar(255) NOT NULL,
    localidad           varchar(255) NOT NULL,
    direccion           varchar(255) NOT NULL,
    valor               int(255) NOT NULL,
    estado              varchar(255) NOT NULL,
    fecha               date NOT NULL,

    CONSTRAINT fk_pedidos_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT pk_pedidos PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO pedidos VALUES(NULL, 1, 'Casanare', 'Yopal', 'CRA 20 #28-28', 22, 'Enviado', CURDATE());

/* Creando la tabla LINEA_PEDIDO*/

CREATE TABLE linea_pedido(
    id                  int(255) auto_increment NOT NULL,
    usuario_id          int(255) NOT NULL,
    pedido_id           int(255) NOT NULL,
    unidades            int(255) NOT NULL,

    CONSTRAINT pk_linea_pedido PRIMARY KEY (id),
    CONSTRAINT fk_linea_usuario FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    CONSTRAINT fk_linea_pedidos FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
)ENGINE=InnoDB;

INSERT INTO linea_pedido VALUES(NULL, 1, 1, 2);