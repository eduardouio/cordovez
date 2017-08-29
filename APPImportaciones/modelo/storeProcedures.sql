create table equipos(
	id_equipo int not null auto_increment primary key,
	nombreEquipo varchar(90) not null,
	direccion varchar(90) not null,
	director varchar(90) not null,
	secretario varchar(90) not null,
	colorUniforme varchar(90) not null,
	marca varchar(90) not null
) engine = innodb; 