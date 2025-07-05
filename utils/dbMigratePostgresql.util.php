<?php

declare(strict_types=1);

// 1) Autoload
require 'vendor/autoload.php';

// 2) Bootstrap
require 'bootstrap.php';

// 3) Load environment
require_once UTILS_PATH . 'envSetter.util.php';

// 4) Extract config
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

// 5) Drop old tables
echo "🗑️ Dropping old tables…\n";
$tables = ['project_users', 'tasks', 'meetings', 'users']; // ordered by dependencies (children first)

foreach ($tables as $table) {
    try {
        $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
        echo "🗑️ Dropped: $table\n";
    } catch (PDOException $e) {
        echo "⚠️ Failed to drop $table: " . $e->getMessage() . "\n";
    }
}

// 6) Apply schema files
echo "📥 Applying schemas from model files...\n";
$models = [
    'database/user.model.sql',
    'database/meetings.model.sql',
    'database/tasks.model.sql',
    'database/project_users.model.sql'
];

foreach ($models as $model) {
    echo "⏳ Loading $model...\n";
    $sql = file_get_contents($model);
    if ($sql === false) {
        echo "❌ Could not read $model\n";
        exit(1);
    }

    try {
        $pdo->exec($sql);
        echo "✅ Applied: $model\n";
    } catch (PDOException $e) {
        echo "❌ Failed to apply $model: " . $e->getMessage() . "\n";
        exit(1);
    }
}

echo "✅ PostgreSQL migration complete!\n";
