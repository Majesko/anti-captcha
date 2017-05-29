<?php

namespace AntiCaptcha\Tasks;

use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class ImageToTextTask
 * @package AntiCaptcha\Tasks
 * 
 * Solve usual image captcha
 */
class ImageToTextTask extends Task
{
    use HelpersTrait;

    /**
     * File body encoded in base64. Make sure to send it without line breaks.
     * @var string
     */
    protected $body;

    /**
     * If true - worker must enter an answer with at least one "space"
     * @var bool
     */
    protected $phrase;

    /**
     * If true - worker will see a special mark telling that answer must be entered with case sensitivity
     * @var bool
     */
    protected $case;

    /**
     * 0 - no requirements
     * 1 - only number are allowed
     * 2 - any letters are allowed except numbers
     * @var int
     */
    protected $numeric;

    /**
     * If true - worker will see a special mark telling that answer must be calculated
     * @var bool
     */
    protected $math;
    
    /**
     * Defines minimum length of the answer
     * @var int
     */
    protected $minLength;

    /**
     * Defines maximum length of the answer
     * @var int
     */
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
        $this->numeric = (integer) $this->array_get($options, 'numeric');
        $this->math = (bool) $this->array_get($options, 'math');
        $this->minLength = $this->array_get($options, 'minLength') ?: 0;
        $this->maxLength = $this->array_get($options, 'maxLength') ?: 0;
    }
}