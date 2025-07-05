<?php

declare(strict_types=1);

// 1) Autoload
require 'vendor/autoload.php';

// 2) Bootstrap
require 'bootstrap.php';

// 3) Load environment
require_once UTILS_PATH . 'envSetter.util.php';

// 4) Connect to PostgreSQL
$pgConfig = [
    'host' => $typeConfig['pgHost'],
    'port' => $typeConfig['pgPort'],
    'db'   => $typeConfig['pgDb'],
    'user' => $typeConfig['pgUser'],
    'pass' => $typeConfig['pgPass'],
];

try {
    $dsn = "pgsql:host={$pgConfig['host']};port={$pgConfig['port']};dbname={$pgConfig['db']}";
    $pdo = new PDO($dsn, $pgConfig['user'], $pgConfig['pass'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ Connected to PostgreSQL successfully.\n";
} catch (PDOException $e) {
    echo "❌ Connection to PostgreSQL failed: " . $e->getMessage() . "\n";
    exit(1);
}

// 5) Load dummy data
$users = require_once DUMMIES_PATH . 'users.staticData.php';

// 6) Seeding Users Table
echo "🌱 Seeding users…\n";

$stmt = $pdo->prepare("
    INSERT INTO users (name, email, password, role)
    VALUES (:name, :email, :password, :role)
");

foreach ($users as $u) {
    $stmt->execute([
        ':name' => $u['name'],
        ':email' => $u['email'],
        ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
        ':role' => $u['role'],
    ]);
}

echo "✅ PostgreSQL seeding complete!\n";
