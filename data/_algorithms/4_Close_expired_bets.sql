##
## 15. [SQL STORED PROCEDURE] CLOSE_EXPIRED_BETS()
##
##############


CREATE PROCEDURE CLOSE_EXPIRED_BETS()
BEGIN
	UPDATE matches
	SET `status` = "bets_closed"
	WHERE `status` = "bets_open" AND NOW() > closing_bets_date_time;

	UPDATE podium_bets a 
	INNER JOIN betting_group b ON a.group_id = b.id
	SET a.status = "closed"
	WHERE NOW() > b.date_time_podium_closing_bets;
	
END

CREATE EVENT every_min_close_expire_bets ON SCHEDULE EVERY 1 MINUTE DO CALL CLOSE_EXPIRED_BETS();