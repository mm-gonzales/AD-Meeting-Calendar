<?php

require_once UTILS_PATH . 'envSetter.util.php';

try {
    // Use Mongo URI and DB name from the env
    $mongo = new MongoDB\Driver\Manager($typeConfig['mongoUri']);

    // MongoDB "ping" command to check if it's alive
    $command = new MongoDB\Driver\Command(["ping" => 1]);
    $mongo->executeCommand($typeConfig['mongoDb'], $command);

    echo "✅ Connected to MongoDB successfully.<br>";
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "❌ MongoDB connection failed: " . $e->getMessage() . "<br>";
}