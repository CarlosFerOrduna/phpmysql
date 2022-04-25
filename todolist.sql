CREATE DATABASE todolist;

use todolist;

create table todotable
(
    id        int(11) auto_increment primary key,
    texto     varchar(100) not null,
    completo  boolean      not null,
    timestamp timestamp
);

# INSERT INTO todotable(texto, completo)
# values ('comprar', false);
#
# drop database todolist;
#
# delete
# from todotable
# where texto like 'c%';
#
# truncate todotable;
#
# UPDATE todotable
# SET completo = 0
# WHERE id = 1;
#
# select *
# from todotable;