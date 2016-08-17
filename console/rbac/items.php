<?php
return [
    'Authors' => [
        'type' => 2,
        'description' => 'View/Add/Delete Authors',
    ],
    'Books' => [
        'type' => 2,
        'description' => 'View/Add/Delete Books',
    ],
    'Categories' => [
        'type' => 2,
        'description' => 'View/Add/Delete Categories',
    ],
    'Publishers' => [
        'type' => 2,
        'description' => 'View/Add/Delete Publishers',
    ],
    'assistant_librarian' => [
        'type' => 1,
        'children' => [
            'Authors',
            'Books',
            'Categories',
            'Publishers',
            'Requests',
            'Issues',
        ],
    ],
    'Members' => [
        'type' => 2,
        'description' => 'View/Add/Delete Members in the System',
    ],
    'Roles' => [
        'type' => 2,
        'description' => 'View/Add/Delete Roles in the System',
    ],
    'AdminUsers' => [
        'type' => 2,
        'description' => 'View/Add/Delete Admin Users in the System',
    ],
    'Requests' => [
        'type' => 2,
        'description' => 'View/Delete requests and issue books',
    ],
    'Issues' => [
        'type' => 2,
        'description' => 'View issues and return books',
    ],
    'librarian' => [
        'type' => 1,
        'children' => [
            'Members',
            'Roles',
            'AdminUsers',
            'assistant_librarian',
        ],
    ],
];
