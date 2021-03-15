<?php



 DB::getInstance()->Execute('
 CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'ps_1767_testimonial` (
 `id` int(10) unsigned NOT NULL auto_increment,
 `image` varchar(255) NOT NULL,
 `author` varchar(20) NOT NULL,
  `content` varchar(255) NOT NULL,
   `status` varchar(255) NOT NULL,
 `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`))
 ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8 ;');
 



 