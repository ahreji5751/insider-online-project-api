<?php

if (!function_exists('nrand'))
{
    function nrand($mean, $sd)
    {
        $x = mt_rand()/mt_getrandmax();
        $y = mt_rand()/mt_getrandmax();
        return intval(sqrt(-2*log($x))*cos(2*pi()*$y)*$sd + $mean);
    }
}
