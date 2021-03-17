<?php

if (!function_exists('amount'))
{
    function amount($amount) {
        return number_format($amount, 0, '', '.');
    }
}

if (!function_exists('euro'))
{
    function euro($amount) {
        return amount($amount) . ' €';
    }
}
