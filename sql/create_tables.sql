
CREATE TABLE Racer(
  id SERIAL PRIMARY KEY, 
  name varchar(50) NOT NULL, 
  country varchar(3)
);

  
CREATE TABLE Client(
  id SERIAL PRIMARY KEY, 
  name varchar(50) NOT NULL, 
  password varchar(50) NOT NULL
);

CREATE TABLE Race(
  id SERIAL PRIMARY KEY,
  racer_id INTEGER REFERENCES Racer(id), 
  name varchar(50) NOT NULL,
  raceday DATE,
  raced boolean DEFAULT FALSE,
  description varchar(400),
  added DATE
);

CREATE TABLE Raceracer(
  id SERIAL PRIMARY KEY,
  race INTEGER REFERENCES Race(id) ON DELETE CASCADE,
  racer INTEGER REFERENCES Racer(id) ON DELETE CASCADE,
  time varchar(8) NOT NULL
); 
