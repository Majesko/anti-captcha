<?php

namespace AntiCaptcha\Traits;

use GuzzleHttp;

trait HelpersTrait
{
    public function array_get(array $array, string $option)
    {
        return array_key_exists($option, $array) ? $array[$option] : null;
    }
    
    public function image_url_to_base64(string $url)
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get($url);
        
        return base64_encode($response->getBody());
    }
}