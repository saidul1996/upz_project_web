<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admin' => 'c,r,u,d',
            'user' => 'c,r,u,d',
            'language' => 'c,r,u,d',
            'languageKey' => 'c,r,u,d',
            'siteSetting' => 'c,r,u,d',
            'banner' => 'c,r,u,d',
            'dcAdmin' => 'c,r,u,d',
            'unoAdmin' => 'c,r,u,d',
            'unionAdmin' => 'c,r,u,d',
            'chairmanAdmin' => 'c,r,u,d',
            'udcAdmin' => 'c,r,u,d',
        ],
        'admin' => [
            'user' => 'c,r,u,d',
            'language' => 'c,r,u,d',
            'languageKey' => 'c,r,u,d',
            'siteSetting' => 'c,r,u,d',
        ],
        'DC' => [
            'user' => 'r',
            'unoAdmin' => 'r',
            'unionAdmin' => 'r',
            'chairmanAdmin' => 'r',
            'udcAdmin' => 'r',
        ],
        'UNO' => [
            'user' => 'r',
            'unionAdmin' => 'r',
            'chairmanAdmin' => 'r',
            'udcAdmin' => 'r',
        ],
        'Union' => [
            'user' => 'r',
        ],
        'Chairman' => [
            'user' => 'r',
        ],
        'UDC' => [
            'user' => 'r',
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
