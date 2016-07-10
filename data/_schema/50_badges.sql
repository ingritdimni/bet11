##
## [SQL TABLE] Badges
##
##############

CREATE TABLE badges (
	user_id INT NOT NULL,
	badge VARCHAR(255) NOT NULL,
	no INT,
	FOREIGN KEY user_id REFERENCES users (id)
)

