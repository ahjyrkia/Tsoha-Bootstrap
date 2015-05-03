<?php

class Racer extends BaseModel {

// Attribuutit
    public $id, $name, $country, $time;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Racer');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $racers = array();
        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $racers[] = new Racer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['country'],

            ));
        }
        return $racers;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Racer WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $racer = new Racer(array(
                'id' => $row['id'],
                'name' => $row['name'],
                'country' => $row['country']
            ));

            return $racer;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Racer (name, country) VALUES (:name, :country) RETURNING id');
        $query->execute(array('name' => $this->name, 'country' => $this->country));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

}
