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
                Stay on Track. Collaborate. Conquer Your Tasks.
            </h2>
            <p class="lead text-secondary mt-3">
                AD-TaskManager brings designers, QAs, coders, and leaders together in a seamless workflow.
                From concept to completion, every step is transparent, accountable, and under your control.
            </p>
        </section>

        <!-- Feature Section -->
        <section class="container my-5">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            
            <!-- Feature 1 -->
            <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="/assets/images/feature1.png" class="card-img-top" alt="Feature 1" style="aspect-ratio: 1;">
                <div class="card-body">
                <h5 class="card-title fw-bold">Task Management</h5>
                <p class="card-text text-secondary">Easily assign and track progress across your team.</p>
                </div>
            </div>
            </div>

            <!-- Feature 2 -->
            <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="/assets/images/feature2.png" class="card-img-top" alt="Feature 2" style="aspect-ratio: 1;">
                <div class="card-body">
                <h5 class="card-title fw-bold">Calendar View</h5>
                <p class="card-text text-secondary">View meetings and tasks on a clean calendar layout.</p>
                </div>
            </div>
            </div>

            <!-- Feature 3 -->
            <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="/assets/images/feature3.png" class="card-img-top" alt="Feature 3" style="aspect-ratio: 1;">
                <div class="card-body">
                <h5 class="card-title fw-bold">Dockerized Workflow</h5>
                <p class="card-text text-secondary">
                    Containerized PostgreSQL and MongoDB setup.
                    <br><?= $mongoCheckerResult ?>
                    <br><?= $postgresqlCheckerResult ?>
                </p>
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
