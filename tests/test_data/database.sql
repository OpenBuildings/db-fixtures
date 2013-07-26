DROP TABLE IF EXISTS `table1`;
CREATE TABLE `table1` (`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, `name` varchar(32) NOT NULL, `description` varchar(255) NOT NULL, `price` decimal(10, 2) NOT NULL, PRIMARY KEY (`id`), UNIQUE KEY `uniq_name` (`name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `table2`;
CREATE TABLE `table2` (`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, `name` varchar(32) NOT NULL, `description` varchar(255) NOT NULL, `price` decimal(10, 2) NOT NULL, PRIMARY KEY  (`id`), UNIQUE KEY `uniq_name` (`name`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;