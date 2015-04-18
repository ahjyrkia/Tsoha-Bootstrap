-- Kirjaajat
INSERT INTO Client (name, password) VALUES ('anton', 'Anton123');
INSERT INTO Client (name, password) VALUES ('anton2', 'Anton123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
-- Kisat ja kisaajat
INSERT INTO Racer (name, country) VALUES ('Sixten Jernberg', 'SWE');
INSERT INTO Racer (name, country) VALUES ('Stefania Belmondo', 'ITA');
INSERT INTO Racer (name, country) VALUES ('Marja-Liisa Kirvesniemi', 'FIN');

INSERT INTO Race (name, description, raceday, added) VALUES ('Rajamäki-hiihto', 'hiihetää', '2015-03-21', NOW());
INSERT INTO Race (name, description, raceday, added) VALUES ('Pahkan hiihdot', 'Pahkalla hiihetää', '2015-02-11', NOW());
-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Raceracer (race, racer) VALUES (2, 1);
INSERT INTO Raceracer (race, racer) VALUES (2, 2);
INSERT INTO Raceracer (race, racer) VALUES (1, 3);

