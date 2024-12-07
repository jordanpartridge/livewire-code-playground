<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Code Execution Settings
    |--------------------------------------------------------------------------
    |
    | Configure the security and execution settings for the code playground.
    |
    */

    'execution' => [
        'timeout' => 5, // Maximum execution time in seconds
        'memory_limit' => '128M', // Maximum memory allocation
        'allowed_languages' => ['php', 'javascript', 'html'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Editor Settings
    |--------------------------------------------------------------------------
    |
    | Configure the code editor appearance and behavior.
    |
    */

    'editor' => [
        'theme' => 'monokai',
        'font_size' => 14,
        'tab_size' => 4,
        'line_numbers' => true,
        'line_wrapping' => true,
        'auto_close_brackets' => true,
        'match_brackets' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Security Settings
    |--------------------------------------------------------------------------
    |
    | Configure security-related settings for code execution.
    |
    */

    'security' => [
        'allowed_functions' => [
            // List of allowed PHP functions for execution
            'array_map',
            'array_filter',
            'array_reduce',
            // Add more as needed
        ],
        'forbidden_functions' => [
            // Dangerous functions that should never be allowed
            'exec',
            'shell_exec',
            'system',
            'passthru',
            'eval',
            // Add more as needed
        ],
    ],
];