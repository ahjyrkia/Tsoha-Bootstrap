<?php

class RaceracerController extends BaseController {

    public static function index() {
        $races = Race::all();


        View::make('races/race_list.html', array('races' => $races));
    }

    public static function show($id) {
        $racers = Raceracer::findByRace($id);
        $notinrace = Raceracer::findRacersNotInRace($id);
        $race = Race::find($id);
        
        View::make('races/race_show.html', array('racers' => $racers, 'race' => $race, 'notinrace' => $notinrace));
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

    public static function storekopy() {
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

    public static function store($id) {

        $params = $_POST;
        $attributes = array(
            'race' => $id,
            'racer' => $params['racer'],
            'time' => 'N/A',
        );

        $raceracer = new Raceracer($attributes);
        $raceracer->save();

        Redirect::to('/race/' . $id);
    }

    public static function storeTime($id) {
        $params = $_POST;
        $attributes = array(
            'race' => $id,
            'racer' => $params['racer'],
            'time' => $params['time'],
        );
        $raceracer = new Raceracer($attributes);

        $raceracer->update();
//        Redirect::to('/race/' . $id . '/tulokset');
    }

    public static function destroy($id) {
        $raceracer = new Raceracer(array('id' => $id));
        $raceracer->destroy();
    }

}
