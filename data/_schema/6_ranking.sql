##
## [SQL TABLE] Ranking 
##
##############

CREATE VIEW ranking AS 
SELECT b.id user_id, b.Group_id, a.points, a.bulls_eye_bets
FROM accumulated_points a
INNER JOIN users b ON a.user_id = b.id
ORDER BY b.Group_id, b.id
