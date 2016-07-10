##
## [SQL TABLE] Resultados Anteriores (em Mundiais e Europeus ENVMA)
##
##############

CREATE TABLE previous_editions
(
	id INT NOT NULL,
	euro_2004 varchar(15),
	mundial_2006 varchar(15),
	euro_2012 varchar(15),
	mundial_2014 varchar(15),
	FOREIGN KEY (id) REFERENCES users (id) ON DELETE CASCADE
	
);

##
## SAMPLE DATA
##
###################

INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (78,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (77,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (71,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (70,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (63,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (64,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (56,"13 Lugar","4 Lugar","12 Lugar","1 Lugar");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (65,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (73,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (1,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (76,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (75,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (59,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (67,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (68,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (72,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (74,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (80,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (60,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (62,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (69,"NA","NA","NA","NA");
INSERT INTO previous_editions (user_id, euro_2004, mundial_2006, euro_2012, mundial_2014) VALUES (66,"NA","NA","NA","NA");