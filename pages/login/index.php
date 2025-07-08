<?php
declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . 'auth.util.php';
Auth::init();

if (Auth::check()) {
    header('Location: /index.php');
    exit;
}

require_once LAYOUTS_PATH . "main.layout.php";

// Get messages from URL
$error = str_replace("%", " ", trim((string) ($_GET['error'] ?? '')));
$message = str_replace("%", " ", trim((string) ($_GET['message'] ?? '')));
$title = "Login";

// Render layout with login form
renderMainLayout(
    function () use ($error, $message) {
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="card shadow p-4" style="min-width: 350px;">
                <form action="/handlers/auth.handler.php" method="POST">
                    <h2 class="text-center mb-4">Sign In</h2>

                    <?php if (!empty($message)): ?>
                        <div class="alert alert-success"><?= htmlspecialchars($message) ?></div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" name="username" type="text" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" name="password" type="password" class="form-control" required>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>

                    <input type="hidden" name="action" value="login">
                    <button type="submit" class="btn btn-primary w-100">Log In</button>
                </form>
            </div>
        </div>
        <?php
    },
    $title,
    [
        "css" => ["/assets/css/login.css"], // Optional
    ]
);