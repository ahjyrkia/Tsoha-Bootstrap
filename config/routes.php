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
    HelloWorldController::race_show($id);
});

$routes->get('/race/:id/edit', function($id) {
    HelloWorldController::race_edit($id);
});
$routes->get('/login', function() {
    HelloWorldController::login();
});


