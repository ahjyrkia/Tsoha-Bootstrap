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

    public static function edit($id) {
        $race = Race::find($id);
        View::make('races/race_edit.html', array('race' => $race));
    }

    public static function create() {
        View::make('races/new.html');
    }

    public static function store() {
// POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa

        $params = $_POST;
// Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = new Race(array(
            'name' => $params['name'],
            'description' => $params['description'],
            'raceday' => $params['raceday']
        ));
        $race = new Race($attributes);
        $errors = $race->errors();
        if (count($errors) == 0) {
            $race->save();

            Redirect::to('/race/' . $race->id, array('message' => 'Kisa lisätty!'));
        } else {
            View::make('races/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

// Pelin muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;
        if ($params['raced']) {
            $params['raced'] = true;
        } else {
            $params['raced'] = false;
        }
        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'raced' => $params['raced'],
            'raceday' => $params['raceday'],
            'description' => $params['description']
        );
        Kint::dump($attributes);
// Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
        $race = new Race($attributes);
        $errors = $race->errors();

//        if (count($errors) > 0) {
//            View::make('races/race_edit.html', array('errors' => $errors, 'attributes' => $attributes));
//        } else {
// Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
        $race->update();

        Redirect::to('/race/' . $race->id, array('message' => 'Kisaa on muokattu onnistuneesti!'));
//        }
    }

// Pelin poistaminen
    public static function destroy($id) {
// Alustetaan Game-olio annetulla id:llä
        $race = new Race(array('id' => $id));
// Kutsutaan Game-malliluokan metodia destroy, joka poistaa pelin sen id:llä
        $race->destroy();

// Ohjataan käyttäjä pelien listaussivulle ilmoituksen kera
        Redirect::to('/race', array('message' => 'Kisa on poistettu onnistuneesti!'));
    }

}
