CREATE TABLE ft_table
(
	id INT NOT NULL AUTO_INCREMENT,
	login VARCHAR(8) NOT NULL, 
	groupe ENUM('staff', 'student', 'other') NOT NULL,
	date_de_creation DATE NOT NULL,
	PRIMARY KEY ( id )
);