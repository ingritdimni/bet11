##
## [SQL TABLE] Pontos Acumulados
##
##############

CREATE TABLE accumulated_points
(
	user_id INT NOT NULL,
	points INT DEFAULT 0,
	bulls_eye_bets INT DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE
	
);

##
## SAMPLE DATA
##
###################

