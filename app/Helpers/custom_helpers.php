<?php

if (!function_exists('example_function')) {
    /**
     * An example custom helper function.
     *
     * @param string $param
     * @return string
     */
    function example_function($param)
    {
        return "This is an example function with param: " . $param;
    }
}

if (!function_exists('format_date')) {
    /**
     * Format a date string.
     *
     * @param string $date
     * @param string $format
     * @return string
     */
    function format_date($date, $format = 'd-m-Y')
    {
        return \Carbon\Carbon::parse($date)->format($format);
    }
}
