<?php

class Racer extends BaseModel {

// Attribuutit
    public $id, $name, $country;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
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
                'country' => $row['country']
            ));
        }
        Kint::dump($racers);
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

}
