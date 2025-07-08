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
function renderMainLayout(callable $content, string $title): void
{
    global $user;

    // Render navbar (pass empty array if no dynamic nav items)
    navHeader([], $user);

    // Render main content inside Bootstrap container
    echo '<main class="container py-4">';
    $content();
    echo '</main>';
}