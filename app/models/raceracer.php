<?php

class Raceracer extends BaseModel {

// Attribuutit
    public $id, $race, $racer, $time;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Raceracer');
        $query->execute();
        $rows = $query->fetchAll();
        $raceracers = array();

        foreach ($rows as $row) {
            $raceracers[] = new Raceracers(array(
                'id' => $row['id'],
                'race' => $row['race'],
                'racer' => $row['racer'],
                'time' => $row['time']
            ));
        }
        return $raceracers;
    }

    public static function findByRace($id) {
        $query = DB::connection()->prepare('SELECT Racer.id, Racer.name, Racer.country, Raceracer.time FROM Raceracer FULL OUTER JOIN Racer ON racer = Racer.id WHERE Raceracer.race = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        
        $racers = array();
        foreach ($rows as $row) {
            $racers[] = new Racer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['country'],
                'time' => $row['time']
            ));
        }
        return $racers;
    }

    public static function findRacersNotInRace($id) {
        $query = DB::connection()->prepare('SELECT Racer.id, Racer.name, Racer.country FROM Racer FULL OUTER JOIN Raceracer ON racer.id = raceracer.racer WHERE (Raceracer.race != :id OR Raceracer.racer IS NULL)');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        $racers = array();
        foreach ($rows as $row) {
            $racers[] = new Racer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['country'],
            ));
        }
        return $racers;
    }

    public static function destroyByRace($id) {
        
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Raceracer SET time = :time WHERE ID = :id');
        $query->execute(array('time' => $this->time));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Raceracer WHERE ID = :id');
        $query->execute(array('id' => $this->id));
    }

    // Huomaathan, että save-metodi ei ole staattinen!
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Raceracer (race, racer, time) VALUES (:race, :racer, :time) RETURNING id');
        $query->execute(array('race' => $this->race, 'racer' => $this->racer, 'time' => $this->time));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
