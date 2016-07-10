##
## [SQL TABLE] email_pipeline
##
##############

CREATE TABLE email_pipeline (
	id INT NOT NULL AUTO_INCREMENT,
	date_time_created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	date_time_sent TIMESTAMP DEFAULT NULL,
	template VARCHAR(255) NOT NULL,
	user_id INT,
	data_1 VARCHAR(1024),
	data_2 VARCHAR(1024),
	data_3 VARCHAR(1024),
	PRIMARY KEY (id)
)

