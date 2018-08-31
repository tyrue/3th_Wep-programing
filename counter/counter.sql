create table counter(
	num int not null auto_increment,
	date varchar(20) not null,
	count int not null default 0,
	primary key(num)
)