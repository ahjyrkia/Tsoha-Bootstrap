<?php

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/', function() {
    HelloWorldController::frontpage();
});

$routes->get('/race', function() {
    RaceController::index();
});
$routes->get('/racers', function() {
    RacerController::index();
});
// Pelin lisääminen tietokantaan
$routes->post('/race', function() {
    Kint::trace();
    RaceController::store();
});
// Pelin lisäyslomakkeen näyttäminen
$routes->get('/race/new', function() {
    RaceController::create();
});
// Määritetään reitti game/:id vasta tässä, jottei se mene sekaisin reitin game/new kanssa
$routes->get('/race/:id', function($id) {
//    HelloWorldController::race_show($id);
    RaceController::show($id);
});

$routes->get('/race/:id/edit', function($id) {
    RaceController::edit($id);
});
$routes->get('/race/:id/show', function($id) {
    RaceracerController::show($id);
});
$routes->post('/race/:id/edit', function($id) {
    RaceController::update($id);
});
$routes->post('/race/:id/destroy', function($id) {
    RaceController::destroy($id);
});
$routes->get('/login', function() {
    HelloWorldController::login();
});
$routes->get('/login', function() {
    // Kirjautumislomakkeen esittäminen
    UserController::login();
});
$routes->post('/login', function() {
    // Kirjautumisen käsittely
    UserController::handle_login();
});
$routes->get('/logout', function() {
    UserController::logout();
});
$routes->get('/user', function() {
    // Kirjautumisen käsittely
    UserController::index();
});


