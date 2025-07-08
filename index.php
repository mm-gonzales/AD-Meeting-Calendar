<?php
declare(strict_types=1);

require_once LAYOUTS_PATH . "main.layout.php";

$mongoCheckerResult = require_once HANDLERS_PATH . "mongodbChecker.handler.php";
$postgresqlCheckerResult = require_once HANDLERS_PATH . "postgreChecker.handler.php";

$title = "Landing Page";

renderMainLayout(
    function () use ($mongoCheckerResult, $postgresqlCheckerResult) {

        ?>
        <!-- Hero Section -->
        <section class="container py-5 text-center">
            <h2 class="display-4 fw-bold">
                Organize. Collaborate. Achieve More Together.
            </h2>
            <p class="lead text-secondary mt-3">
                With TaskManager, unite your team—designers, testers, developers, and project leads—in one powerful platform. Transform ideas into results with clear communication, shared goals, and total project visibility.
            </p>
        </section>

        <!-- Feature Section -->
        <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <!-- Feature 1 -->
            <div class="col">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                <h5 class="card-title fw-bold">Task Management</h5>
                <p class="card-text text-secondary">Easily assign and track progress across your team.</p>
                </div>
            </div>
            </div>

        </div>
        </section>


        <!-- Call to Action -->
        <section class="container text-center my-5 py-4 border-top">
            <h3 class="fw-bold display-6 mb-2">Get Started – Explore Demo</h3>
            <p class="text-muted fs-5">See How It Works</p>
        </section>
        <?php
    },
    $title
);
