<?php

class RacerController extends BaseController {

    public static function index() {
        $racers = Racer::all();
        View::make('racers/racer_list.html', array('racers' => $racers));
    }

    public static function create() {
        $user = self::get_user_logged_in();
        if ($user) {
            View::make('racers/racer_new.html');
        } else {
            Redirect::to('/racers', array('message' => 'Lisätäksesi hiihtäjiä sinun on kirjauduttava sisään.'));
        }
    }

    public static function store() {

        $params = $_POST;
        $attributes = new Racer(array(
            'name' => $params['name'],
            'country' => $params['country'],
        ));
        $racer = new Racer($attributes);
        $errors = $racer->errors();
        if (count($errors) == 0) {
            $racer->save();
            Redirect::to('/racers' , array('message' => 'Hiihtäjä lisätty!'));
        } else {
            View::make('racers/racer_new.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

}
