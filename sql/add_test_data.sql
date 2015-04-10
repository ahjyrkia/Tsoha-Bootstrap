-- Player-taulun testidata
INSERT INTO Client (name, password) VALUES ('anton', 'Anton123');
INSERT INTO Client (name, password) VALUES ('anton2', 'Anton123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
-- Game taulun testidata
INSERT INTO Racer (name, description) VALUES ('hiihtaja', 'asdasdas');
INSERT INTO Race (name, description, raceday, added) VALUES ('Rajamäki-hiihto', 'hiihetää', '2015-03-21', NOW());
INSERT INTO Race (name, description, raceday, added) VALUES ('Pahkan hiihdot', 'Pahkalla hiihetää', '2015-02-11', NOW());
-- Lisää INSERT INTO lauseet tähän tiedostoon
