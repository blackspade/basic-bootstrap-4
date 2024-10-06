<?php
session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '',
        'user' => '',
        'pass' => '',
        'db' => ''
     ),
    'settings' => array(
        'show_create_account_public'  => 1,  // 0 MEANS NO, 1 MEANS YES
        'password_strength_level_req' => 50, // VALUE 0 TO 100 WHERE 100 EQUAL VERY DIFFICULTY PASSWORD REQUIRED
        'password_reset_time_expiry'  => 24,  // VALUE 0 TO 24 HOURS - TIME PERIOD ALLOWED FOR A PASSWORD RESET 
        'default_password'            => 'Company123!',
        'default_password_encrypt'    => '$2y$10$x8hMqd2P6hywXgRqFJ6BWekzQscPjtCVzsD0VkIXq1JULa8ksBLra',
        'send_email_flag'             => 0, // 0 MEANS NO, 1 MEANS YES 
        'default_domain_email'        => 'info@stackbcr.com'
    ),
    'tables' => array(
        'table_name_for_users'  => 'company_users'
    ) 
);