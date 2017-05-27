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
    
    
    protected $proxy_type;
    protected $proxy_address;
    protected $proxy_port;
    protected $proxy_login;
    protected $proxy_password;
    protected $user_agent;
    protected $cookies;
    
    public function __construct(array $options)
    {
        parent::__construct($options);
        $this->type = self::NO_CAPTCHA_TASK;
        $this->proxy_type = $this->array_get($options, 'proxyType');
        $this->proxy_address = $this->array_get($options, 'proxyAddress');
        $this->proxy_port = (integer) $this->array_get($options, 'proxyPort');
        $this->proxy_login = $this->array_get($options, 'proxyLogin');
        $this->proxy_password = $this->array_get($options, 'proxyPassword');
        $this->user_agent = $this->array_get($options, 'userAgent');
        $this->cookies = $this->array_get($options, 'cookies');
    }

    public function getPropsAsArray(): array
    {
        return [
            'type' => $this->type,
            'websiteURL' => $this->website_url,
            'websiteKey' => $this->website_key,
            'websiteSToken' => $this->website_s_token,
            'proxyType' => $this->proxy_type,
            'proxyAddress' => $this->proxy_address,
            'proxyPort' => $this->proxy_port,
            'proxyLogin' => $this->proxy_login,
            'proxyPassword' => $this->proxy_password,
            'userAgent' => $this->user_agent,
            'cookies' => $this->cookies
        ];
    }
}