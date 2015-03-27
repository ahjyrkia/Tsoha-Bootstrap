<?php

class Kisa extends BaseModel {

// Attribuutit
    public $id, $hiihtaja_id, $name, $raceday, $raced, $description, $added;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
        // Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Kisa');
        // Suoritetaan kysely
        $query->execute();
        // Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $kisat = array();

        // Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
            // Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $kisat[] = new Kisat(array(
                'id' => $row['id'],
                'hiihtaja_id' => $row['hiihtaja_id'],
                'name' => $row['name'],
                'raceday' => $row['raceday'],
                'raced' => $row['raced'],
                'description' => $row['description'],
                'added' => $row['added'],
            ));
        }

        return $kisat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kisa WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kisa = new Kisa(array(
                'id' => $row['id'],
                'hiihtaja_id' => $row['hiihtaja_id'],
                'name' => $row['name'],
                'raceday' => $row['raceday'],
                'raced' => $row['raced'],
                'description' => $row['description'],
                'added' => $row['added'],
            ));

            return $kisa;
        }
    }
    