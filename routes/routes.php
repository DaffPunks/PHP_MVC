<?php

require_once '../app/Core/route.php';

$route = Route::getInstance();

//Main page
$route->GET("/", "MainController@index");

//Login
$route->POST("/login", "AuthController@login");

//Logout
$route->GET("/logout", "AuthController@logout");

//Signup page
$route->GET("/register", "AuthController@registerView");
$route->GET("/login", "AuthController@loginView");

//Signup
$route->POST("/register", "AuthController@register");
$route->POST("/login", "AuthController@login");

//Create feedbacks
$route->GET("/feedback/accept", "FeedbacksController@accept");
$route->GET("/feedback/reject", "FeedbacksController@reject");

$route->POST("/feedback/create", "FeedbacksController@create");
