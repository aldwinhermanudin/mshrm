<?php

return [

    'driver' => env('MAIL_DRIVER', 'mailgun'),
    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),
    'from' => ['address' => 'laraveldevel@gmail.com', 'name' => 'Laravel Development'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'port' => env('MAIL_PORT', 25),
    'pretend' => env('MAIL_PRETEND', false),

];
