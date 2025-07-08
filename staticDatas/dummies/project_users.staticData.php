<?php

return [
    ['project_id' => 1, 'user_id' => 1, 'role' => 'facilitator'],
    ['project_id' => 1, 'user_id' => 2, 'role' => 'note-taker'], // OK, different user_id
    ['project_id' => 2, 'user_id' => 1, 'role' => 'observer'],  
];