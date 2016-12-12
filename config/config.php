<?php

/**
 * Give you access to general configs
 * @param $key
 */

function env($key)
{
    $ini = parse_ini_file('env.ini');

    return $ini[$key];
}
