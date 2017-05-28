<?php

namespace AntiCaptcha\Tasks;

use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class ImageToTextTask
 * @package AntiCaptcha\Tasks
 * 
 * Solve usual image captcha
 *
 */
class ImageToTextTask extends Task
{
    use HelpersTrait;

    protected $body;
    protected $phrase;
    protected $case;
    protected $numeric;
    protected $math;
    protected $minLength;
    protected $maxLength;

    /**
     * ImageToTextTask constructor.
     * @param string $body base64 encoded image with captcha
     * @param array $options 
     */
    public function __construct(string $body, array $options = [])
    {
        $this->type = self::IMAGE_TO_TEXT_TASK;
        $this->body = $body;
        $this->phrase = (bool) $this->array_get($options, 'phrase');
        $this->case = (bool) $this->array_get($options, 'case');
        $this->numeric = (bool) $this->array_get($options, 'numeric');
        $this->math = (bool) $this->array_get($options, 'math');
        $this->minLength = $this->array_get($options, 'minLength') ?: 0;
        $this->maxLength = $this->array_get($options, 'maxLength') ?: 0;
    }
}