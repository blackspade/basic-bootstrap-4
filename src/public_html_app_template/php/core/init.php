<?php
//session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '',
        'user' => '',
        'pass' => '',
        'db' => ''
     ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'session' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    )
);
