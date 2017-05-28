<?php
/**
 * Created by PhpStorm.
 * User: majesko
 * Date: 28.05.17
 * Time: 0:09
 */

namespace AntiCaptcha\Tasks;

class NoCaptchaTask extends NoCaptchaTaskProxyless
{
    protected $proxyType;
    protected $proxyAddress;
    protected $proxyPort;
    protected $proxyLogin;
    protected $proxyPassword;
    protected $userAgent;
    protected $cookies;

    /**
     * NoCaptchaTask constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->type = self::NO_CAPTCHA_TASK;
        $this->proxyType = $this->array_get($options, 'proxyType');
        $this->proxyAddress = $this->array_get($options, 'proxyAddress');
        $this->proxyPort = (integer) $this->array_get($options, 'proxyPort');
        $this->proxyLogin = $this->array_get($options, 'proxyLogin');
        $this->proxyPassword = $this->array_get($options, 'proxyPassword');
        $this->userAgent = $this->array_get($options, 'userAgent');
        $this->cookies = $this->array_get($options, 'cookies');
    }
}