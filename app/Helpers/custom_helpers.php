<?php

use Modules\Setting\App\Models\Setting;

if (! function_exists('format_price')) {
    function format_price($amount)
    {
        return '$' . number_format($amount, 2);
    }
}

if (! function_exists('sitesetting')) {
    function sitesetting()
    {
        $result = Setting::first();
        return $result;
    }
}

