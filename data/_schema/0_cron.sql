##
## [SQL TABLE] cron - scheduled jobs
##
###############

CREATE TABLE cron
(
	time_frame_group VARCHAR(25) NOT NULL,
	ran_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	script_name VARCHAR(255) NOT NULL,
	output VARCHAR(1024),
	error_log VARCHAR(1024),
	PRIMARY KEY (time_frame_group, script_name)
);


##
##  SAMPLE DATA
##
#########################

