##
## 14. [SQL STORED PROCEDURE] CALCULATE_POINTS_FOR_MATCH_BET(MATCH_CHANGED_ID)
##
##############

CREATE PROCEDURE CALCULATE_POINTS_FOR_MATCH_BET (MATCH_CHANGED_ID INT)
BEGIN

	#0: Clear previous points
	UPDATE match_bets
	SET points = 0
	WHERE match_id = MATCH_CHANGED_ID;

	#1: +1 point if you get the home team score right
	UPDATE match_bets a 
	INNER JOIN matches b ON a.match_id = b.id
	SET a.points = a.points + 1
	WHERE a.match_id = MATCH_CHANGED_ID
	AND a.home_team_score = b.home_team_score;

	#2: +1 point if you get the away team score right	
	UPDATE match_bets a 
	INNER JOIN matches b ON a.match_id = b.id
	SET a.points = a.points + 1
	WHERE a.match_id = MATCH_CHANGED_ID
	AND a.away_team_score = b.away_team_score;

	#3: +3 point if you get the team who won right
	UPDATE match_bets a 
	INNER JOIN matches b ON a.match_id = b.id
	SET a.points = a.points + 3
	WHERE a.match_id = MATCH_CHANGED_ID
	AND ((a.home_team_score > a.away_team_score
		 AND b.home_team_score > b.away_team_score)
		OR
		(a.home_team_score < a.away_team_score
		AND b.home_team_score < b.away_team_score)
		OR
		(a.home_team_score = a.away_team_score
		AND b.home_team_score = b.away_team_score)
	);

END