<?php

namespace AntiCaptcha\Solutions;

use AntiCaptcha\Traits\HelpersTrait;

class ImageToTextSolution extends Solution
{
    use HelpersTrait;
    
    protected $text;
    protected $url;
    
    function __construct(array $response)
    {
        $this->text = $this->array_get($response, 'text');
        $this->url = $this->array_get($response, 'url');
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
}