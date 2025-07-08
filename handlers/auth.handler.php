<?php
declare(strict_types=1);
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . 'auth.util.php';
require_once UTILS_PATH . 'envSetter.util.php';

$databases = getEnvConfig();

Auth::init();

$host = 'host.docker.internal'; // Or 'localhost' if outside Docker
$dsn = "pgsql:host={$host};port={$databases['pgPort']};dbname={$databases['pgDB']}";
$pdo = new PDO($dsn, $databases['pgUser'], $databases['pgPassword'], [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$action = $_REQUEST['action'] ?? null;

// --- LOGIN ---
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (Auth::login($pdo, $username, $password)) {
        $user = Auth::user();
        header('Location: ' . ($user['role'] === 'admin' ? '/pages/admin/' : '/index.php'));
        exit;
    } else {
        header('Location: /pages/login/index.php?error=InvalidCredentials');
        exit;
    }
}

// --- LOGOUT ---
if ($action === 'logout') {
    Auth::logout();
    header('Location: /pages/login/index.php');
    exit;
}

// Redirect if no action matched
header('Location: /pages/login/index.php');
exit;
