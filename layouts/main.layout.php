<?php
declare(strict_types=1);

// Bootstrap, Autoload, Auth
require_once BASE_PATH . '/bootstrap.php';
require_once BASE_PATH . '/vendor/autoload.php';
require_once UTILS_PATH . 'auth.util.php';
Auth::init();

// Navbar component
require_once COMPONENTS_PATH . 'componentGroup/navbar.component.php';

// Get logged-in user
$user = Auth::user();

/**
 * Render main layout with only navbar and content
 *
 * @param callable $content       Main content renderer
 * @param string   $title         Page title (for navbar use only)
 * @return void
 */
function renderMainLayout(callable $content, string $title, array $customJsCss = []): void
{
    global $headNavList, $user;

    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{$title}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
    HTML;

    // Your custom navHeader renderer
    navHeader($headNavList ?? [], $user);

    echo '<main class="container py-5">';
    $content();
    echo '</main>';

    echo <<<HTML
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    HTML;
}