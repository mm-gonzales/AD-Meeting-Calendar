<?php
declare(strict_types=1);

// 1. Bootstrap, Autoload, Auth
require_once BASE_PATH . 'bootstrap.php';
require_once BASE_PATH . 'vendor/autoload.php';
require_once UTILS_PATH . 'auth.util.php';
Auth::init();

// 2. Load templates
require_once COMPONENTS_PATH . 'componentGroup/navbar.component.php';

// 3. Determine current user
$user = Auth::user();

/**
 * Main page layout renderer
 * 
 * @param callable $content       Function that echoes the page's main HTML content
 * @param string   $title         Title for <head> and navbar
 * @param array    $customJsCss   Optional ['css' => [], 'js' => []]
 * @return void
 */
function renderMainLayout(callable $content, string $title, array $customJsCss = []): void
{
    global $headNavList, $user;

    // Top section
    head($title, $customJsCss['css'] ?? []);
    navHeader($headNavList, $user);

    // Main content
    echo '<main class="container py-4">';
    $content();
    echo '</main>';

    // Footer
    footer($customJsCss['js'] ?? []);
}