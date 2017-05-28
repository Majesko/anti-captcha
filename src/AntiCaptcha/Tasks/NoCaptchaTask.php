<?php
/**
 * Created by PhpStorm.
 * User: majesko
 * Date: 28.05.17
 * Time: 0:09
 */

namespace AntiCaptcha\Tasks;


use AntiCaptcha\Traits\TaskTypesTrait;

class NoCaptchaTask extends NoCaptchaTaskProxyless
{
    use TaskTypesTrait;
    
    
    protected $proxyType;
    protected $proxyAddress;
    protected $proxyPort;
    protected $proxyLogin;
    protected $proxyPassword;
    protected $userAgent;
    protected $cookies;
    
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

    public function getPropsAsArray(): array
    {
        return [
            'type' => $this->type,
            'websiteURL' => $this->websiteUrl,
            'websiteKey' => $this->websiteKey,
            'websiteSToken' => $this->website_s_token,
            'proxyType' => $this->proxyType,
            'proxyAddress' => $this->proxyAddress,
            'proxyPort' => $this->proxyPort,
            'proxyLogin' => $this->proxy_login,
            'proxyPassword' => $this->proxy_password,
            'userAgent' => $this->user_agent,
            'cookies' => $this->cookies
        ];
    }
}