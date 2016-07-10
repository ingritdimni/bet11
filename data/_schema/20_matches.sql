##
## [SQL TABLE] Matches
##
##############

CREATE TABLE matches
(
	id INT NOT NULL,
	match_date_time DATETIME NOT NULL,
	closing_bets_date_time DATETIME NOT NULL,
	tournament_group VARCHAR(25) NOT NULL,	
	home_team INT NOT NULL ,
	away_team INT NOT NULL,
	status VARCHAR(255) DEFAULT 'open_bets',
	home_team_score INT,
	away_team_score INT,
	PRIMARY KEY (id),
	FOREIGN KEY (home_team) REFERENCES teams(id) ON DELETE CASCADE,
	FOREIGN KEY (away_team) REFERENCES teams(id) ON DELETE CASCADE
);

##
## TRIGGERS
##
##############
CREATE TRIGGER on_update_matches
AFTER UPDATE
ON matches FOR EACH ROW
BEGIN
BEGIN
IF NEW.home_team_score <> OLD.home_team_score OR NEW.away_team_score <> OLD.away_team_score OR OLD.home_team_score IS NULL OR OLD.away_team_score IS NULL
THEN

	CALL CALCULATE_POINTS_FOR_MATCH_BET(NEW.id);
	CALL CALCULATE_ACCUMULATED_POINTS();
    
END IF;
END