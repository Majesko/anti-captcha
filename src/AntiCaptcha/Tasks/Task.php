<?php

namespace AntiCaptcha\Tasks;

use AntiCaptcha\Traits\HelpersTrait;

abstract class Task
{
    use HelpersTrait;
    
    const IMAGE_TO_TEXT_TASK = 'ImageToTextTask';
    const NO_CAPTCHA_TASK = 'NoCaptchaTask';
    const NO_CAPTCHA_TASK_PROXYLESS = 'NoCaptchaTaskProxyless';
    
    protected $type;

    public function getType(): string 
    {
        return $this->type;
    }
    
    abstract public function getPropsAsArray(): array;
}