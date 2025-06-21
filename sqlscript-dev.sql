-- use ctleacesso;

create table pessoas(
   id int auto_increment primary key,   
   firtname varchar(100) not null,
   lastname varchar(100),
   email varchar(100),
   idade int,
   rg varchar(20),
   cpf varchar(20)
);

create table aluno_status(
       id int auto_increment primary key,
       status_do_aluno varchar(100) not null
);

create table alunos (
   id int auto_increment primary key,
   pessoa_id int not null unique,
   ra int not null,
   aluno_status_id int not null,
   foreign key (aluno_status_id) references aluno_status(id),
   foreign key (pessoa_id) references pessoas(id)
);


create table carteirinha(
   id int auto_increment primary key,
   carteirinha_id varchar(100) not null unique,
   id_aluno int not null,
   data_emissao  datetime not null,
   data_validade datetime not null,
   ativa boolean not null default false,
   observacao text,
   foreign key (id_aluno) references alunos(id)
);

create table catraca(
   id int auto_increment primary key,
   nome_catraca varchar(100) not null,
   observacao text
);

create table acessosalunos(
   id int auto_increment primary key,
   id_aluno int not null,
   timestampdapassagem datetime,
   timestampdoupdatepranuvem datetime,
   timestampdoupdatepranuvemAtUploading datetime,
   foreign key (id_aluno) references alunos(id)
);
