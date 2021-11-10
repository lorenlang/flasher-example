<?php

if ( ! function_exists('l')) {

    function l($stuff)
    {
        if (is_development()) {
            $dev_log = '/var/log/dev.log';
            $stuff   = timestamp() . ":\n" . var_export($stuff, TRUE) . "\n" . str_repeat('-', 30) . "\n";
            error_log($stuff, 3, $dev_log);
        }
    }
}


if ( ! function_exists('is_development')) {

    function is_development()
    {
        return getenv('DevServer') ? TRUE : FALSE;
    }
}


if ( ! function_exists('timestamp')) {

    function timestamp()
    {
        return date('Y-m-d H:i:s');
    }
}
