<?php


function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}




function make_excerpt ( $value , $length = 200)
{

    $value = trim(preg_replace('/\r\n|\r|\n+/','',$value));
    return str_limit($value,$length);

}