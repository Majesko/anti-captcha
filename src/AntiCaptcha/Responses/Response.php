<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;
use AntiCaptcha\Traits\HelpersTrait;

/**
 * Class Response
 * @package AntiCaptcha\Responses
 * 
 * @property integer $error_id
 * @property string $error_code
 * @property string $error_description
 * @property array $response_body
 */
abstract class Response
{
    use HelpersTrait;
    
    protected $error_id;
    protected $error_code;
    protected $error_description;
    protected $response_body;
    
    public function __construct(ResponseInterface $response)
    {
        $this->response_body = \GuzzleHttp\json_decode($response->getBody(), true);
        $this->error_id = (integer) $this->array_get($this->response_body, 'errorId');
        $this->error_code = $this->array_get($this->response_body, 'errorCode');
        $this->error_description = $this->array_get($this->response_body, 'errorDescription');
    }
    
    public function getErrorId(): int 
    {
        return $this->error_id;
    }
    
    public function getErrorCode(): string
    {
        return $this->error_code;
    }
    
    public function getErrorDescription(): string
    {
        return $this->error_description;
    }
}