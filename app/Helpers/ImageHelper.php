<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ImageHelper
{
    public static function isValidImageUrl($url)
    {
        if (empty($url)) return false;

        try {
            $response = Http::timeout(3)->head($url);
            return $response->successful() && str_starts_with($response->header('Content-Type'), 'image');
        } catch (\Exception $e) {
            return false;
        }
    }
}
