##
## [SQL TABLE] Match_Bets
##
##############

CREATE TABLE match_bets
(
	user_id INT NOT NULL ,
	match_id INT NOT NULL ,
	home_team_score INT DEFAULT 0,
	away_team_score INT DEFAULT 0,
	datetime_bet TIMESTAMP DEFAULT NULL,
	points INT DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (match_id) REFERENCES matches(id) ON DELETE CASCADE
);