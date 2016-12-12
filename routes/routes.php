<?php

require_once 'app/core/route.php';

$route = Route::getInstance();

//Main page
$route->GET("/", "MainController@index");

//Logout
$route->GET("/logout", "AuthController@logout");

//Auth views
$route->GET("/register", "AuthController@registerView");
$route->GET("/login", "AuthController@loginView");

//Auth
$route->POST("/register", "AuthController@register");
$route->POST("/login", "AuthController@login");

//Feedback's routes
$route->GET("/feedback/accept", "FeedbacksController@accept");
$route->GET("/feedback/reject", "FeedbacksController@reject");

$route->POST("/feedback/create", "FeedbacksController@create");
$route->POST("/feedback/edit", "FeedbacksController@edit");
