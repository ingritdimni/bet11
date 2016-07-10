##
## [SQL TABLE] Ranking Log
##
##############

CREATE VIEW ranking_log AS
	SELECT a.id match_id, a.match_date_time, b.user_id, SUM(b.points) accumulated_points, d.Name_EN home_team, e.Name_EN away_team
	FROM matches a
	CROSS JOIN match_bets b
	INNER JOIN matches c ON b.match_id = c.id AND c.match_date_time <= a.match_date_time
	INNER JOIN teams d ON d.id = a.home_team
	INNER JOIN teams e ON e.id = a.away_team
	WHERE a.status = 'settled'
	GROUP BY b.user_id, a.match_date_time
	ORDER BY b.user_id ASC, a.match_date_time ASC
	
	