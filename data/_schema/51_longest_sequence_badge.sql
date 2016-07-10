##
## [SQL PROCEDURE] ATTRIBUTE BADGES
##
##############

DELIMITER //
CREATE PROCEDURE ATTRIBUTE_BADGES()
BEGIN 

	#
	# 1. Longest winning streak
	#

	SET @winning_streak = 0;
	SET @previous_points = 0;

	DELETE FROM badges WHERE badge = 'longest_winning_streak';

	INSERT INTO badges (user_id, badge, no)
	SELECT d.user_id, 'longest_winning_streak', max_winning_streak
	FROM (
		SELECT c.user_id, MAX(c.winning_streaks) max_winning_streak
		FROM (	
			SELECT b.user_id, COUNT(*) winning_streaks
			FROM (

				SELECT a.user_id, a.match_id, a.points,
				CASE 
					WHEN (a.points >= 3 AND @previous_points = a.points) THEN @winning_streak 
					WHEN (a.points >= 3 AND @previous_points <> a.points) THEN @winning_streak := @winning_streak + 1
					WHEN (a.points < 3) THEN 0
				END
				winning_streak,
				@previous_points := a.points
				FROM (
				    SELECT points, user_id, match_id
				    FROM match_bets a
					INNER JOIN matches b ON a.match_id = b.id AND b.status = 'settled'
					ORDER BY a.user_id ASC, a.match_id ASC
				) a
			) b
			WHERE b.winning_streak <> 0
			GROUP BY b.user_id, b.winning_streak
		) c
		GROUP BY c.user_id
	) d
	WHERE d.max_winning_streak >= 3;
	
	
	#
	# 2. Highest Bullseye bet
	#
	
	DELETE FROM badges WHERE badge = 'highest_bullseye_bets';
	
	INSERT INTO badges (user_id, badge,no)
	SELECT user_id, 'highest_bullseye_bets',bullseye_bets
	FROM (
		SELECT user_id, COUNT(*) bullseye_bets
		FROM match_bets
		WHERE points = 5
		GROUP BY user_id
		ORDER BY bullseye_bets DESC		
	) match_bets
	LIMIT 1;


	#
	# 3. Most contrarian bets
	#



	
END//