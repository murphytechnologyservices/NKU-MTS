drop table ptt_users;

create table ptt_users 
as select customerid as userid, name, address, city, username, password from customers
where username = 'RM';

insert into ptt_users (name, address, city, username, password)
values ('Jesse Hockenbury','123 Blah Street','Highland Heights','hockenburj1','password1');

select * from ptt_users;

select * from books