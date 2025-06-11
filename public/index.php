<?php

use controllers\SiteController;

require_once __DIR__ . '/../core/Application.php';
require_once __DIR__ . '/../controllers/SiteController.php';
require_once __DIR__ . '/../models/User.php'; // بعداً کامل می‌کنیم

$config = [
    'db' => [
        'dsn' => 'mysql:host=localhost;dbname=punctual_db',
        'user' => 'root',
        'password' => ''
    ]
];

$app = new Application(dirname(__DIR__), $config);

// تعریف route برای login (GET و POST)
$app->router->get('/login', [SiteController::class, 'login']);
$app->router->post('/login', [SiteController::class, 'login']);

$app->run();

?>