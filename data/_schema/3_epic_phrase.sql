##
## [SQL TABLE] Epich_Phrase
##
##############

CREATE TABLE epic_phrase
(
	user_id INT NOT NULL,
	phrase VARCHAR(255) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
	
);