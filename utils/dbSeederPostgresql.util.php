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

// 5) Dummy definitions: key = table, value = file
$seedMap = [
    'users' => 'users.staticData.php',
    'meetings' => 'meetings.staticData.php',
    'project_users' => 'project_users.staticData.php',
    'tasks' => 'tasks.staticData.php',
];

// 6) Seeding
foreach ($seedMap as $table => $file) {
    echo "🌱 Seeding {$table}…\n";

    $data = require_once DUMMIES_PATH . $file;

    switch ($table) {
        case 'users':
            $stmt = $pdo->prepare("
                INSERT INTO users (name, email, password, role)
                VALUES (:name, :email, :password, :role)
            ");
            foreach ($data as $u) {
                $stmt->execute([
                    ':name' => $u['name'],
                    ':email' => $u['email'],
                    ':password' => password_hash($u['password'], PASSWORD_DEFAULT),
                    ':role' => $u['role'],
                ]);
            }
            break;

        case 'meetings':
            $stmt = $pdo->prepare("
                INSERT INTO meetings (title, description, scheduled_at, created_by)
                VALUES (:title, :description, :scheduled_at, :created_by)
            ");
            foreach ($data as $m) {
                $stmt->execute([
                    ':title' => $m['title'],
                    ':description' => $m['description'],
                    ':scheduled_at' => $m['scheduled_at'],
                    ':created_by' => $m['created_by'],
                ]);
            }
            break;

        case 'project_users':
            $stmt = $pdo->prepare("
                INSERT INTO project_users (project_id, user_id, role)
                VALUES (:project_id, :user_id, :role)
            ");
            foreach ($data as $pu) {
                $stmt->execute([
                    ':project_id' => $pu['project_id'],
                    ':user_id' => $pu['user_id'],
                    ':role' => $pu['role'],
                ]);
            }
            break;

        case 'tasks':
            $stmt = $pdo->prepare("
                INSERT INTO tasks (meeting_id, assigned_to, description, due_date, status)
                VALUES (:meeting_id, :assigned_to, :description, :due_date, :status)
            ");
            foreach ($data as $t) {
                $stmt->execute([
                    ':meeting_id' => $t['meeting_id'],
                    ':assigned_to' => $t['assigned_to'],
                    ':description' => $t['description'],
                    ':due_date' => $t['due_date'],
                    ':status' => $t['status'],
                ]);
            }
            break;

        default:
            echo "⚠️ Skipping unknown table: {$table}\n";
    }

    echo "✅ Done seeding {$table}\n";
}

echo "🎉 PostgreSQL seeding complete!\n";
