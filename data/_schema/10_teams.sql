##
## [SQL TABLE] Teams
##
##############

CREATE TABLE teams
(
	id INT NOT NULL,
	Name_EN VARCHAR(255) NOT NULL,
	Name_PT VARCHAR(255) NOT NULL,
	Initials VARCHAR(3),
	PRIMARY KEY (id)
);

##
## SAMPLE DATA (Euro 2016)
##
##############

INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (1,"Albania","Albania","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (2,"Austria","Austria","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (3,"Belgium","Bélgica","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (4,"Croatia","Croácia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (5,"Czech Republic","República Checa","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (6,"England","Inglaterra","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (7,"France","França","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (8,"Germany","Alemanha","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (9,"Hungary","Hungria","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (10,"Iceland","Islândia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (11,"Italy","Itália","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (12,"Northern Ireland","Irlanda Norte","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (13,"Poland","Polónia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (14,"Portugal","Portugal","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (15,"Rep. Ireland","Rep. Irlanda","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (16,"Romania","Roménia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (17,"Russia","Rússia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (18,"Slovakia","Eslováquia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (19,"Spain","Espanha","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (20,"Sweden","Suécia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (21,"Switzerland","Suíça","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (22,"Turkey","Turquia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (23,"Ukraine","Ucrânia","XXX");
INSERT INTO teams (id, Name_EN, Name_PT, Initials) VALUES (24,"Wales","País de Gales","XXX");