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
        $user = self::get_user_logged_in();
        if ($user) {
           View::make('races/new.html'); 
        } else {
            Redirect::to('/race', array('message' => 'Lisätäksesi kilpailuja sinun on kirjauduttava sisään.'));
        }
        
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

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
//            'raced' => $params['raced'],
            'raceday' => $params['raceday'],
            'description' => $params['description']
        );

// Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
        $race = new Race($attributes);
        $errors = $race->errors();

        if (count($errors) > 0) {
            View::make('races/race_edit.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
        $race->update();

        Redirect::to('/race');
        }
    }

    public static function destroy($id) {
        $race = new Race(array('id' => $id));
        $race->destroy();

        Redirect::to('/race', array('message' => 'Kisa on poistettu onnistuneesti!'));
    }

}
