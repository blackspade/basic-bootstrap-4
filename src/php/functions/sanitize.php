<?php
function escape($string){
    return htmlentities($string,ENT_QUOTES, 'UTF-8');
}

function email_escape($string){
    return filter_var($string, FILTER_VALIDATE_EMAIL);
}

function num_escape($num){
    return filter_var($num, FILTER_VALIDATE_INT);
}

function hyper_escape($str){
   return strip_tags(htmlentities(str_replace("'", "",strip_tags(str_replace('"', "", $str))), ENT_QUOTES, 'UTF-8'));
}

function cash_format($e){
    return " $".number_format($e,2);
}

function is_ajax_request(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}