<?php

require_once VENDOR_PATH . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();

// ✅ Automatically detect if running inside Docker
$isDocker = file_exists('/.dockerenv');

$pgHost = $isDocker ? 'postgresql' : 'localhost';
$pgPort = $isDocker ? '5432' : $_ENV['PG_PORT'];  // use internal port in Docker


$typeConfig = [
    // MongoDB configuration
    'mongoUri' => $_ENV['MONGO_URI'],
    'mongoDb'  => $_ENV['MONGO_DB'],

    // PostgreSQL configuration
    'pgHost' => $pgHost,
    'pgPort' => $pgPort,
    'pgDb'   => $_ENV['PG_DB'],
    'pgUser' => $_ENV['PG_USER'],
    'pgPass' => $_ENV['PG_PASS'],
];

// $typeConfig = [
//     'host' => $_ENV['PG_HOST'],
//     'port' => $_ENV['PG_PORT'],
//     'db'   => $_ENV['PG_DB'],
//     'user' => $_ENV['PG_USER'],
//     'pass' => $_ENV['PG_PASS'],
// ];

// $mongoConfig = [
//     'uri' => $_ENV['MONGO_URI'],
//     'db'  => $_ENV['MONGO_DB'],
// ];