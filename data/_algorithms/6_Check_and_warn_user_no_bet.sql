##
## 7. [SQL FUNC] CHECK_AND_WARN_USERS_NO_BET()
##
##############

CREATE PROCEDURE CHECK_AND_WARN_USERS_NO_BET()
BEGIN

	INSERT INTO email_pipeline (template,user_id)
		SELECT 'warn-no-bet-before-close',a.user_id
		FROM match_bets a
		INNER JOIN matches b ON a.match_id = b.id
		WHERE a.datetime_bet IS NULL
		AND (b.closing_bets_date_time - INTERVAL 1 HOUR) < NOW()
		AND b.status = 'bets_open'
		## FILTER OUT users who have been notified within the last hour
		AND a.user_id NOT IN (SELECT user_id FROM email_pipeline WHERE date_time_created BETWEEN (NOW() - INTERVAL 1 HOUR) AND NOW()  )
		GROUP BY a.user_id;

END