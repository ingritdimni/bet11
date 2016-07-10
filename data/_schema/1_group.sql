##
## [SQL TABLE] betting_group
##
##############

CREATE TABLE betting_group
(
	id INT NOT NULL,
	name VARCHAR(255) NOT NULL,
	date_time_podium_closing_bets DATETIME NOT NULL,
	points_for_match_winning_team INT NOT NULL,
	points_for_match_correct_score INT NOT NULL,
	points_for_team_in_podium INT NOT NULL,
	points_for_correct_place_team_in_podium INT NOT NULL,
	points_for_podium_best_player INT NOT NULL,
	language CHAR(2) NOT NULL,
	group_url VARCHAR(255) NOT NULL,
	PRIMARY KEY (id)
);


##
##  SAMPLE DATA
##
#########################

INSERT INTO betting_group (id,
	name,
	date_time_podium_closing_bets,
	points_for_match_winning_team,
	points_for_match_correct_score,
	points_for_team_in_podium,
	points_for_correct_place_team_in_podium,
	points_for_podium_best_player,
	language,
	group_url) 
	VALUES (1, "ENVMA","2012-12-12 21:15:00",3,1,10,10,40,"PT","envma.dtdns.net");
	
INSERT INTO betting_group (id,
	name,
	date_time_podium_closing_bets,
	points_for_match_winning_team,
	points_for_match_correct_score,
	points_for_team_in_podium,
	points_for_correct_place_team_in_podium,
	points_for_podium_best_player,
	language,
	group_url) 
	VALUES (2, "Mustasilta & Friend's Betting Competition","2012-12-12 21:15:00",3,1,10,10,40,"EN","mfec.dtdns.net");