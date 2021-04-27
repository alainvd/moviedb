<?php

if (!function_exists('amount'))
{
    function amount($amount) {
        $amount = str_replace('.', '', $amount);
        if ($amount !== '' && is_numeric($amount)) {
            return number_format($amount, 0, '', '.');
        } else {
            return '';
        }
    }
}

if (!function_exists('euro'))
{
    function euro($amount) {
        return amount($amount) . ' €';
    }
}
