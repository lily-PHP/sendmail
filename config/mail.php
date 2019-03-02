<?php

$uri = explode('/', $_SERVER['REQUEST_URI'])[1];

$uri_conf = [
    'srilanka',
    'taiwan',
];

if(!in_array($uri, $uri_conf)){
    $uri = 'default';
}

$conf = [
    'srilanka' => [
        'driver' => 'smtp',
        'host' => 'smtp.163.com',
        'port' => 25,
        'from' => [
            'address' => 'lilyphpteam@163.com',
            'name' => 'Mall Team',
        ],
        'encryption' => 'tls',
        'username' => 'lilyphpteam@163.com',
        'password' => 'Alice2020',
        'sendmail' => '/usr/sbin/sendmail -bs',
        'markdown' => [
            'theme' => 'default',
            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ],

//        'driver' => 'smtp',
//        'host' => 'smtp.exmail.qq.com',
//        'port' => 465,
//        'from' => [
//            'address' => 'cocogmz@uccdo.com',
//            'name' => 'Elinkmall',
//        ],
//        'encryption' => 'ssl',
//        'username' => 'cocogmz@uccdo.com',
//        'password' => '1128YYqx',
//        'sendmail' => '/usr/sbin/sendmail -bs',
//        'markdown' => [
//            'theme' => 'default',
//            'paths' => [
//                resource_path('views/vendor/mail'),
//            ],
//        ],
//        'canUseDomain' => [
//            'otest02.com',
//            'otest08.com',
//        ],
    ],
    'taiwan' => [
        'driver' => 'smtp',
        'host' => 'smtp.exmail.qq.com',
        'port' => 465,
        'from' => [
            'address' => 'cocogmz@uccdo.com',
            'name' => 'ohyevr',
        ],
        'encryption' => 'ssl',
        'username' => 'cocogmz@uccdo.com',
        'password' => '1128YYqx',
        'sendmail' => '/usr/sbin/sendmail -bs',
        'markdown' => [
            'theme' => 'default',
            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ],
        'canUseDomain' => [
            'otest02.com',
            'otest08.com',
        ],
    ],


    'default'=>[
        'driver' => env('MAIL_DRIVER', 'smtp'),
        'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
        'port' => env('MAIL_PORT', 587),
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
            'name' => env('MAIL_FROM_NAME', 'Example'),
        ],
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'sendmail' => '/usr/sbin/sendmail -bs',
        'markdown' => [
            'theme' => 'default',
            'paths' => [
                resource_path('views/vendor/mail'),
            ],
        ]
    ],
];
return $conf[$uri];

