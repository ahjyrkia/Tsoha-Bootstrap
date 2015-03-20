-- Player-taulun testidata
INSERT INTO Kayttaja (name, password) VALUES ('anton', 'Anton123');
INSERT INTO Kayttaja (name, password) VALUES ('anton2', 'Anton123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
-- Game taulun testidata
INSERT INTO Hiihtaja (name, description) VALUES ('hiihtaja', 'asdasdas');
INSERT INTO Kisa (name, description, raceday, added) VALUES ('Rajamäki-hiihto', 'hiihetää', '2015-03-21', NOW());-- Lisää INSERT INTO lauseet tähän tiedostoon