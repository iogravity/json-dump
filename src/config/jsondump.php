<?php

return [
    'api_version' => 'v1.0.0',
    'api_endpoint' => 'https://api.jsondump.io/v1/api',
    'secret_type' => [
        'read' => 1,
        'write' => 2,
    ],
    'validations' => [
        'register' => ['firstName', 'lastName', 'email', 'password'],
    ],
];
