<?php

require_once 'core/route.php';

$route = Route::getInstance();

$route->GET("/profile", "MainController@index");