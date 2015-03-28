<?php

class Race extends BaseModel {

// Attribuutit
    public $id, $racer_id, $name, $raceday, $raced, $description, $added;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Race');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $races = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
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

    // Huomaathan, että save-metodi ei ole staattinen!
    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Race (name, raceday, description) VALUES (:name, :raceday, :description) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('name' => $this->name, 'raceday' => $this->raceday, 'description' => $this->description));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $row['id'];
    }

}
