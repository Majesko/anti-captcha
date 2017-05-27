<?php

namespace AntiCaptcha\Tasks;


class NoCaptchaTaskProxyless extends Task
{
    protected $website_url;
    protected $website_key;
    protected $website_s_token;
    
    public function __construct(array $options)
    {
        $this->type = self::NO_CAPTCHA_TASK_PROXYLESS; 
        $this->website_url = $this->array_get($options, 'websiteURL');
        $this->website_key = $this->array_get($options, 'websiteKey');
        $this->website_s_token = $this->array_get($options, 'websiteSToken');
    }

    public function getPropsAsArray(): array
    {
        return [
            'type' => $this->type,
            'websiteURL' => $this->website_url,
            'websiteKey' => $this->website_key,
            'websiteSToken' => $this->website_s_token
        ];
    }
}