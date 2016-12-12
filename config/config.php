<?php

function env($key)
{
    $ini = parse_ini_file('env.ini');
    return $ini[$key];
}
