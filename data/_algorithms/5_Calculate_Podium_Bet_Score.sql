##
## 16. [SQL FUNC] CALCULATE_PODIUM_BET_SCORE()
##
##############

CREATE PROCEDURE CALCULATE_PODIUM_BET_SCORE()
BEGIN

#0: Clear points
	UPDATE podium_bets 
	SET points = 0;



#1: +8 points for getting the right team in the podium

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 8
	WHERE a.first_team IN (b.first_team, b.second_team, b.third_team, b.fourth_team);

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 8
	WHERE a.second_team IN (b.first_team, b.second_team, b.third_team, b.fourth_team);

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 8
	WHERE a.third_team IN (b.first_team, b.second_team, b.third_team, b.fourth_team);

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 8
	WHERE a.fourth_team IN (b.first_team, b.second_team, b.third_team, b.fourth_team);


#2: +4 points for getting the right team in the right place

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 4
	WHERE b.first_team = a.first_team;

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 4
	WHERE b.second_team = a.second_team;

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 4
	WHERE b.third_team = a.third_team;
	
	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 4
	WHERE b.fourth_team = a.fourth_team;

#3: +10 points for getting the correct best scorer

	UPDATE podium_bets a
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.points = a.points + 10
	WHERE a.best_player = b.best_scorer;

	
END