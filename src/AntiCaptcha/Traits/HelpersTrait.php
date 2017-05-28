<?php

namespace AntiCaptcha\Traits;

use GuzzleHttp;

/**
 * Trait HelpersTrait
 * @package AntiCaptcha\Traits
 */
trait HelpersTrait
{
    /**
     * Gets element from array if exists
     *
     * @param array $array
     * @param string $option
     * @return mixed|null
     */
    public function array_get(array $array, string $option)
    {
        return array_key_exists($option, $array) ? $array[$option] : null;
    }

    /**
     * Converts image to base64 from url
     *
     * @param string $url
     * @return string
     */
    public function image_url_to_base64(string $url): string
    {
        $client = new GuzzleHttp\Client();
        $response = $client->get($url);
        
        return base64_encode($response->getBody());
    }
}