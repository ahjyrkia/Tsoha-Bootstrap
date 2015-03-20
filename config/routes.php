<?php


  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/', function() {
    HelloWorldController::frontpage();
  });

  $routes->get('/race', function() {
    HelloWorldController::race_list();
  });

  $routes->get('/race/1', function() {
    HelloWorldController::race_show();
  });

  $routes->get('/race/1/edit', function() {
    HelloWorldController::race_edit();
  });
  $routes->get('/login', function() {
    HelloWorldController::login();
  });

