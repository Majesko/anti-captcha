<?php

namespace AntiCaptcha\Tasks;

use AntiCaptcha\Traits\HelpersTrait;

class ImageToTextTask extends Task
{
    use HelpersTrait;

    protected $body;
    protected $phrase;
    protected $case;
    protected $numeric;
    protected $math;
    protected $min_length;
    protected $max_length;
    
    public function __construct(string $body, array $options = [])
    {
        $this->type = self::IMAGE_TO_TEXT_TASK;
        $this->body = $body;
        $this->phrase = (bool) $this->array_get($options, 'phrase');
        $this->case = (bool) $this->array_get($options, 'case');
        $this->numeric = (bool) $this->array_get($options, 'numeric');
        $this->math = (bool) $this->array_get($options, 'math');
        $this->min_length = $this->array_get($options, 'minLength') ?: 0;
        $this->max_length = $this->array_get($options, 'maxLength') ?: 0;
    }
    
    

    public function getPropsAsArray(): array
    {
        return [
            'type' => $this->type,
            'body' => $this->body,
            'phrase' => $this->phrase,
            'case' => $this->case,
            'math' => $this->math,
            'minLength' => $this->min_length,
            'maxLength' => $this->max_length
        ];
    }
}