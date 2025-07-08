<?php

return [
    [
        'meeting_id' => 1,
        'assigned_to' => 1, // valid user
        'description' => 'Prepare agenda',
        'due_date' => '2025-07-15',
        'status' => 'pending'
    ],
    [
        'meeting_id' => 1,
        'assigned_to' => 2, // also valid
        'description' => 'Take meeting notes',
        'due_date' => '2025-07-15',
        'status' => 'completed'
    ],
];