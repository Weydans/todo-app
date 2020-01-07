create table tarefa(
	id 			int not null unique auto_increment primary key,
    description text not null,
    createdAt	timestamp not null,
    done		enum('S', 'N') default 'N'
);