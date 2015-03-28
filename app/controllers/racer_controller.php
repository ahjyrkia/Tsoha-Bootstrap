<?php

class RacerController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $racers = Racer::all();
        Kint::dump($racers);
    // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('racers/racer_list.html', array('racers' => $racers));
        
    }

}