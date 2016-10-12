<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "mail", "sendmail", "mailgun", "mandrill", "ses", "log"
    |
    */

    'driver' => 'smtp',
    'host' => 'smtp.163.com',
    'port' => 25,
    'from' => array('address' => '13683462564@163.com', 'name' => 'nex'),
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => '13683462564@163.com',
    'password' => 'sfjwutns89',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => false,

];


