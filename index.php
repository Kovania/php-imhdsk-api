<?php

header('Content-Type: application/json');

require __DIR__ . '/core/app.php';

$app = new App();

$app->autoload();

$app->start();

?>