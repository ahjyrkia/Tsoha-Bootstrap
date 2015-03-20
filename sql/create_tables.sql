
CREATE TABLE Hiihtaja(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  description varchar(400)
);

CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE Kisa(
  id SERIAL PRIMARY KEY,
  hiihtaja_id INTEGER REFERENCES Hiihtaja(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  raceday DATE,
  raced boolean DEFAULT FALSE,
  description varchar(400),
  added DATE
);-- Lisää CREATE TABLE lauseet tähän tiedostoon
