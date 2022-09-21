create table aluno
(
    id         serial primary key,
    nome       text     not null,
    telefone   char(11) not null,
    email      char(50) not null unique,
    created_at timestamp,
    updated_at timestamp
);

create table prova
(
    id          serial primary key,
    tema_prova  text    not null,
    aluno_id    integer not null,
    tema_id     integer not null,
    questaos_id integer not null,
    foreign key (aluno_id) references aluno (id),
    created_at  timestamp,
    updated_at  timestamp
);

create table tema
(
    id         serial primary key,
    nome_tema  text null,
    created_at timestamp,
    updated_at timestamp
);

create table questoes
(
    id         serial primary key,
    tema_id    integer not null,
    foreign key (tema_id) references tema (id),
    created_at timestamp,
    updated_at timestamp
);


create table respostas
(
    id         serial primary key,
    questao_id integer not null,
    foreign key (questao_id) references questoes (id),
    created_at timestamp,
    updated_at timestamp
);

create table questoes_prova
(
    id         serial primary key,
    text       text    not null,
    prova_id   integer not null,
    foreign key (prova_id) references prova (id),
    created_at timestamp
);

create table resposta_prova
(
    id         serial primary key,
    text       text not null,
    correta    bool not null,
    escolhida  bool not null,
    questao_id integer not null,
    foreign key (questao_id) references questoes_prova (id),
    created_at timestamp,

);