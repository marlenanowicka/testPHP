create database contacts;
use contacts;

CREATE TABLE IF NOT EXISTS `tbl_contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `phone_number` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `is_friend` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

INSERT INTO `tbl_contacts` (`id`, `name`, `surname`, `phone_number`, `email`, `address`, `zip`, `city`, `is_friend`) VALUES
(13, 'Rafael ',  'Nadal', '7777888855', 'nadal@live.in', 'Warszawska 15/20', '02-200', 'Warszawa', 0 ),
(14, 'Shahrukh ', 'Khan', '4477853652', 'khan@khan.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(15, 'Shivaji', 'Rao', '00000000010', 'rajnikanth@live.in','Warszawska 15/20', '02-200', 'Warszawa', 0),
(11, 'Andrés', 'Iniesta', '7418529630', 'andres@gmail.com','Warszawska 15/20', '02-200', 'Warszawa', 0),
(12, 'Mesut', 'Özil', '885566332200', 'ozil@arsenal.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(16, 'Ana', 'Ivanovic', '8526547530', 'ana@yahoo.in', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(17, 'Anushka', 'Sharma', '7744556699', 'anushaka@gmail.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(18, 'Gareth', 'Frank', '7893691204', 'bale@madridfc.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(19, 'Cristiano', 'Ronaldo', '8855223366', 'ronaldo@madridfc.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(20, 'David', 'Robert Joseph', '7755336699', 'beckham@america.com','Warszawska 15/20', '02-200', 'Warszawa', 0 ),
(21, 'Roger', 'Federer', '4455669988', 'roger@federer.com','Warszawska 15/20', '02-200', 'Warszawa', 0 ),
(22, 'Eldrick Tont', 'tetdasd'' /dasdasd asdaskdj as', '7733115522', 'tiger@woods.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0),
(23, 'Rahul', 'Dravid', '5588446699', 'rahul@india.com', 'Warszawska 15/20', '02-200', 'Warszawa', 0);