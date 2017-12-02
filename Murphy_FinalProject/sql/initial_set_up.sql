drop table ptt_users;

CREATE TABLE `ptt_users` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `address` char(100) NOT NULL,
  `city` char(30) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into ptt_users (name, address, city, username, password)
values ('Randy Murphy','123 Blah Street','Morning View','RM','pw');

insert into ptt_users (name, address, city, username, password)
values ('Jesse Hockenbury','123 Blah Street','Highland Heights','hockenburj1','pw');

/*select * from ptt_users;*/

drop table ptt_services;

CREATE TABLE ptt_services (
  service_name char(50) NOT NULL,
  service_desc char(200) DEFAULT NULL,
  service_price float(6,2) DEFAULT NULL,
  PRIMARY KEY (service_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into ptt_services (service_name, service_desc, service_price) values ('Data Warehousing','Building of customer data warehouses',133.00);
insert into ptt_services (service_name, service_desc, service_price) values ('Business Intelligence Reporting','Reporting of data for Analytics',113.00);
insert into ptt_services (service_name, service_desc, service_price) values ('Master Data Management','Mastering of data such as the Customer Domain',123.00);

DROP TABLE ptt_user_services;

CREATE TABLE ptt_user_services (
  userid INT(10) unsigned NOT NULL ,
  service_name CHAR(50) NOT NULL,
  PRIMARY KEY (userid, service_name),
  INDEX FK_Users_idx (userid ASC),
	CONSTRAINT FK_User
    FOREIGN KEY (userid) REFERENCES ptt_users (userid)
	ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT FK_Service_Name
    FOREIGN KEY (service_name)
    REFERENCES ptt_services (service_name)
	ON DELETE CASCADE
    ON UPDATE CASCADE    
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


    
