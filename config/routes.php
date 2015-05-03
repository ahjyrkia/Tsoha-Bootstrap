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
$routes->get('/racer/new', function() {
    RacerController::create();
});
$routes->post('/racers', function() {
    RacerController::store();
});
$routes->post('/race', function() {
    RaceController::store();
});
$routes->get('/race/new', function() {
    RaceController::create();
});

$routes->get('/race/:id', function($id) {
    RaceController::show($id);
});
$routes->post('/race/:id', function($id) {
//    RaceracerController::destroy($id);
    RaceracerController::store($id);
});

$routes->get('/race/:id/edit', function($id) {
    RaceController::edit($id);
});
$routes->get('/race/:id/tulokset', function($id) {
    RaceracerController::show($id);
});

$routes->post('/race/:id/tulokset', function($id) {
    RaceracerController::storeTime($id);
});
$routes->post('/race/:id/edit', function($id) {
    RaceController::update($id);
});
$routes->post('/race/:id/destroy', function($id) {
    RaceController::destroy($id);
    RaceracerController::destroyByRace($id);
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


