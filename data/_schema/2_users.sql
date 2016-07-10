##
## [SQL TABLE] Users
##
##############

CREATE TABLE users
(
	id INT NOT NULL,
	Group_id INT NOT NULL,
	Developer INT NOT NULL DEFAULT 0,
	Name VARCHAR(255),
	E_Mail VARCHAR(255),
	Send_Welcome_Email INT DEFAULT 0,
	Sent_Welcome_Emails INT DEFAULT 0,
	last_logged_in TIMESTAMP,
	PRIMARY KEY (id),
	FOREIGN KEY (Group_id) REFERENCES betting_group (id)
);


##
##  SAMPLE DATA
##
#########################

