##
## 13. [SQL STORED PROCEDURE] CALCULATE_ACCUMULATED_POINTS()
##
##############

CREATE PROCEDURE CALCULATE_ACCUMULATED_POINTS ()
BEGIN

	#0: Clear all
	DELETE FROM accumulated_points;

	#1: 
	INSERT INTO accumulated_points (user_id, points)
	SELECT
			user_id,
			SUM(points)
	FROM match_bets
	GROUP BY user_id
	UNION ALL
	SELECT
			user_id,
			SUM(points)
	FROM podium_bets
	GROUP BY user_id;

	#2:
	UPDATE accumulated_points a
	INNER JOIN (SELECT user_id, COUNT(points) bulls_eye_bets FROM match_bets WHERE points = 5 GROUP BY user_id ) AS b ON a.user_id = b.user_id
	SET a.bulls_eye_bets = b.bulls_eye_bets;

END