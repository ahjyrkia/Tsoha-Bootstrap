<?php

class Race extends BaseModel {

// Attribuutit
    public $id, $racer_id, $name, $raceday, $raced, $description, $added;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name', 'validate_date', 'validate_description');
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Race');
        $query->execute();
        $rows = $query->fetchAll();
        $races = array();
        foreach ($rows as $row) {
            $races[] = new Race(array(
                'id' => $row['id'],
                'racer_id' => $row['racer_id'],
                'name' => $row['name'],
                'raceday' => $row['raceday'],
                'raced' => $row['raced'],
                'description' => $row['description'],
                'added' => $row['added'],
            ));
        }
        return $races;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Race WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $race = new Race(array(
                'id' => $row['id'],
                'racer_id' => $row['racer_id'],
                'name' => $row['name'],
                'raceday' => $row['raceday'],
                'raced' => $row['raced'],
                'description' => $row['description'],
                'added' => $row['added'],
            ));

            return $race;
        }
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
        $query->execute(array('name' => $this->name, 'raceday' => $this->raceday, 'description' => $this->description, 'raced' => $this->raced ));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
