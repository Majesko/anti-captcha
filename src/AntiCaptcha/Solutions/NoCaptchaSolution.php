<?php

namespace AntiCaptcha\Solutions;

use AntiCaptcha\Traits\HelpersTrait;

class NoCaptchaSolution extends Solution
{
    use HelpersTrait;
    
    protected $g_recaptcha_response;
    protected $g_recaptcha_response_MD5;
    
    public function __construct(array $response)
    {
        $this->g_recaptcha_response = $this->array_get($response, 'gRecaptchaResponse');
        $this->g_recaptcha_response_MD5 = $this->array_get($response, 'gRecaptchaResponseMD5');
    }
    
    public function getGRecaptchaResponse()
    {
        return $this->g_recaptcha_response;   
    }

    public function gRecaptchaResponseMD5()
    {
        return $this->g_recaptcha_response_MD5;
    }
}