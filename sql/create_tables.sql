
CREATE TABLE Racer(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  description varchar(400)
);

CREATE TABLE Client(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE Race(
  id SERIAL PRIMARY KEY,
  racer_id INTEGER REFERENCES Racer(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  raceday DATE,
  raced boolean DEFAULT FALSE,
  description varchar(400),
  added DATE
);-- Lisää CREATE TABLE lauseet tähän tiedostoon
