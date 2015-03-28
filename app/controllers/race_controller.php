<?php

class RaceController extends BaseController {

    public static function index() {
// Haetaan kaikki pelit tietokannasta
        $races = Race::all();


// Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('races/race_list.html', array('races' => $races));
    }

    public static function show($id) {
        $race = Race::find($id);
        View::make('races/race_show.html', array('race' => $race));
    }

    public static function create() {
        View::make('races/new.html');
    }

    public static function store() {
// POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa

        $params = $_POST;
// Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $race = new Race(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'raceday' => $params['raceday']
        ));
        Kint::dump($params);
// Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $race->save();

// Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/race' . $race->id, array('message' => 'Kisa lisätty!'));
    }

}
