<?php

namespace AntiCaptcha\Tasks;

use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class Task
 * @package AntiCaptcha\Tasks
 *
 */
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
    
    public function getPropsAsArray(): array {
        $props = [];
        foreach (get_object_vars($this) as $key => $var) {
            $props[$key] = $var;
        }
        
        return $props;
    }
}