<?php

require_once VENDOR_PATH . 'autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
$dotenv->load();


// Determine PostgreSQL host based on environment
$pgHost = getenv('IS_DOCKER') === 'true' ? 'host.docker.internal' : 'localhost';


$typeConfig = [
    // MongoDB configuration
    'mongoUri' => $_ENV['MONGO_URI'],
    'mongoDb'  => $_ENV['MONGO_DB'],

    // PostgreSQL configuration
    'pgHost' => $_ENV['PG_HOST'],
    'pgPort' => $_ENV['PG_PORT'],
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