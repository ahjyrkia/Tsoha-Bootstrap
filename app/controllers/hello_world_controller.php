<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      View::make('helloworld.html');
    }
    public static function frontpage() {
      View::make('suunnitelmat/frontpage.html');
    }
    public static function race_list(){
      View::make('suunnitelmat/race_list.html');
    }
    public static function race_edit(){
      View::make('suunnitelmat/race_edit.html');
    }
    public static function race_show(){
        View::make('suunnitelmat/race_show.html');
    }
    public static function login(){
      View::make('suunnitelmat/login.html');
    }
}
  
