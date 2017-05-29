<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;
use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class Response
 * @package AntiCaptcha\Responses
 */
abstract class Response
{
    use HelpersTrait;

    /**
     * Error identificator
     * @var int
     */
    protected $error_id;
    
    /**
     * Error code
     * @var string|null
     */
    protected $error_code;
    
    /**
     * Short information describing error
     * @var string|null
     */
    protected $error_description;

    /**
     * Api response array
     * @var array
     */
    protected $response_body;

    /**
     * Response constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response_body = \GuzzleHttp\json_decode($response->getBody(), true);
        $this->error_id = (integer) $this->array_get($this->response_body, 'errorId');
        $this->error_code = $this->array_get($this->response_body, 'errorCode');
        $this->error_description = $this->array_get($this->response_body, 'errorDescription');
    }

    /**
     * Returns error identificator.
     * 
     * 0 - no errors, the task has been successfully created, task ID located in taskId property
     * >1 - error identificator. Error code and short information transferred in errorCode and errorDescription properties
     * 
     * @return int
     */
    public function getErrorId(): int 
    {
        return $this->error_id;
    }

    /**
     * Returns error code
     * 
     * Refer to: https://anticaptcha.atlassian.net/wiki/display/API/Errors for more details
     * 
     * @return string
     */
    public function getErrorCode(): string
    {
        return $this->error_code;
    }

    /**
     * Returns error description
     * 
     * @return string
     */
    public function getErrorDescription(): string
    {
        return $this->error_description;
    }
}