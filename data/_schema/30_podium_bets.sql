##
## [SQL TABLE] Podium_Bets
##
##############

CREATE TABLE podium_bets
(
	user_id INT NOT NULL ,
	group_id INT NOT NULL,
	first_team INT NOT NULL,
	second_team INT NOT NULL,
	third_team INT NOT NULL,
	fourth_team INT NOT NULL,
	best_player VARCHAR(50) NOT NULL,
	status VARCHAR(25) NOT NULL DEFAULT 'open',
	points INT DEFAULT 0,
	FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
	FOREIGN KEY (group_id) REFERENCES betting_group(id) ON DELETE CASCADE,
	FOREIGN KEY (first_team) REFERENCES teams(id) ON DELETE CASCADE,	
	FOREIGN KEY (second_team) REFERENCES teams(id) ON DELETE CASCADE,	
	FOREIGN KEY (third_team) REFERENCES teams(id) ON DELETE CASCADE,	
	FOREIGN KEY (fourth_team) REFERENCES teams(id) ON DELETE CASCADE	
	
	
);