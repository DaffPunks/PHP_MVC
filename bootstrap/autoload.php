<?php

require_once '../app/core/model.php';
require_once '../app/core/view.php';
require_once '../app/core/controller.php';

require_once '../app/core/orm.php';

require_once 'app.php';
/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once '../app/core/route.php';
require_once '../routes/routes.php';

$routes = Route::getInstance();
$routes->start();
