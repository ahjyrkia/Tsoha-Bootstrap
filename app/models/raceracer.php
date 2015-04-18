<?php

class Raceracer extends BaseModel {

// Attribuutit
    public $id, $race, $racer;

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
            ));
        }
        return $raceracers;
    }

    public static function findByRace($id) {
        $query = DB::connection()->prepare('SELECT Racer.id, Racer.name, Racer.country FROM Raceracer FULL OUTER JOIN Racer ON racer = Racer.id WHERE Raceracer.race = :id');
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        Kint::dump($rows);
        $racers = array();
        foreach ($rows as $row) {
            $racers[] = new Racer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['country'],
            ));
           
        }
        Kint::dump($racers);            
        return $racers;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Race SET name = :name, raceday = :raceday,'
                . 'description = :description, raced = :raced WHERE ID = :id');

        $query->execute(array('id' => $this->id, 'name' => $this->name,
            'raceday' => $this->raceday, 'description' => $this->description, 'raced' => $this->raced));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Race WHERE ID = :id');
        $query->execute(array('id' => $this->id));
    }

    // Huomaathan, että save-metodi ei ole staattinen!
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Race (name, raceday, description, raced, added) VALUES (:name, :raceday, :description, :raced, NOW()) RETURNING id');
        $query->execute(array('name' => $this->name, 'raceday' => $this->raceday, 'description' => $this->description, 'raced' => $this->raced));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
