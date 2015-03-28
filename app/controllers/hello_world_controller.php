<?php
  class HelloWorldController extends BaseController{
    
    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
        $hiihtokisa = Race::find(1);
        $kisat = Race::all();
        Kint::dump($hiihtokisa);
        Kint::dump($kisat);
    }
    public static function frontpage() {
      View::make('/frontpage.html');
    }
    public static function race_list(){
      View::make('/races/race_list.html');
    }
    public static function race_edit(){
      View::make('/races/race_edit.html');
    }
    public static function race_show(){
      View::make('/races/race_show.html');
    }
    public static function login(){
      View::make('/login.html');
    }
}
  
