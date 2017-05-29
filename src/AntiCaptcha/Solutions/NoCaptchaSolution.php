<?php

namespace AntiCaptcha\Solutions;

use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class NoCaptchaSolution
 * @package AntiCaptcha\Solutions
 */
class NoCaptchaSolution extends Solution
{
    use HelpersTrait;

    /**
     * Hash string which is required for interacting with submit form on target website
     * @var string|null
     */
    protected $g_recaptcha_response;

    /**
     * Control sum of gRecaptchaResponse value in MD5
     * @var string|null
     */
    protected $g_recaptcha_response_MD5;
    
    public function __construct(array $response)
    {
        $this->g_recaptcha_response = $this->array_get($response, 'gRecaptchaResponse');
        $this->g_recaptcha_response_MD5 = $this->array_get($response, 'gRecaptchaResponseMD5');
    }

    /**
     * Hash string which is required for interacting with submit form on target website. It looks like this:
     * <textarea id="g-recaptcha-response" ..></textarea>
     * 
     * @return string
     */
    public function getGRecaptchaResponse(): string 
    {
        return $this->g_recaptcha_response;   
    }

    /**
     * Control sum of gRecaptchaResponse value in MD5. It may present in API output only while sending isExtended proprety with true value in getTaskResult method.
     * This property is made for specially for debugging, just to make sure your application receives exact google hash
     * 
     * @return string
     */
    public function gRecaptchaResponseMD5(): string 
    {
        return $this->g_recaptcha_response_MD5;
    }
}