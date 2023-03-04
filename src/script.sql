create table tab_autores
(
    autor_id   bigint unsigned auto_increment
        primary key,
    autor_name varchar(50) not null,
    constraint autor_id
        unique (autor_id)
);

create table tab_categorias
(
    categoria_id   bigint unsigned auto_increment
        primary key,
    categoria_name varchar(50) not null,
    constraint categoria_id
        unique (categoria_id)
);

create table tab_editoras
(
    editora_id   bigint unsigned auto_increment
        primary key,
    editora_name varchar(50) not null,
    constraint editora_id
        unique (editora_id)
);

create table tab_livros
(
    livro_id          bigint unsigned auto_increment
        primary key,
    livro_title       varchar(50) not null,
    livro_description text        not null,
    livro_ano         int         null,
    livro_paginas     int         null,
    livro_image       text        null,
    constraint livro_id
        unique (livro_id)
);

create table tab_livros_autores
(
    livro_autor_id bigint unsigned auto_increment,
    fk_livro_id    bigint unsigned null,
    fk_autor_id    bigint unsigned null,
    constraint livro_autor_id
        unique (livro_autor_id),
    constraint tab_livros_autores_ibfk_1
        foreign key (fk_livro_id) references tab_livros (livro_id)
            on delete cascade,
    constraint tab_livros_autores_ibfk_2
        foreign key (fk_autor_id) references tab_autores (autor_id)
            on delete cascade
);

create table tab_livros_categorias
(
    livro_categoria_id bigint unsigned auto_increment
        primary key,
    fk_livro_id        bigint unsigned null,
    fk_categoria_id    bigint unsigned null,
    constraint livro_categoria_id
        unique (livro_categoria_id),
    constraint tab_livros_categorias_ibfk_1
        foreign key (fk_livro_id) references tab_livros (livro_id)
            on delete cascade,
    constraint tab_livros_categorias_ibfk_2
        foreign key (fk_categoria_id) references tab_categorias (categoria_id)
            on delete cascade
);

create table tab_livros_editoras
(
    livro_autor_id bigint unsigned auto_increment,
    fk_livro_id    bigint unsigned null,
    fk_editora_id  bigint unsigned null,
    constraint livro_autor_id
        unique (livro_autor_id),
    constraint tab_livros_editoras_ibfk_1
        foreign key (fk_livro_id) references tab_livros (livro_id)
            on delete cascade,
    constraint tab_livros_editoras_ibfk_2
        foreign key (fk_editora_id) references tab_editoras (editora_id)
            on delete cascade
);

create table tab_usuarios
(
    user_id          bigint unsigned auto_increment
        primary key,
    user_name        varchar(255)  not null,
    user_password    text          null,
    user_joined_at   date          not null,
    user_email       varchar(255)  null,
    user_permissions int default 1 not null,
    constraint user_id
        unique (user_id)
);

create table tab_livros_usuarios
(
    livro_user_id bigint unsigned auto_increment,
    fk_livro_id   bigint unsigned null,
    fk_user_id    bigint unsigned null,
    constraint livro_user_id
        unique (livro_user_id),
    constraint tab_livros_usuarios_ibfk_1
        foreign key (fk_livro_id) references tab_livros (livro_id)
            on delete cascade,
    constraint tab_livros_usuarios_ibfk_2
        foreign key (fk_user_id) references tab_usuarios (user_id)
            on delete cascade
);