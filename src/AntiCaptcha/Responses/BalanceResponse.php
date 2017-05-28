<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;

/**
 * Class BalanceResponse
 * @package AntiCaptcha\Responses
 * 
 * @property string $balance
 */
class BalanceResponse extends Response
{
    protected $balance;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->balance = (float) $this->array_get($this->response_body, 'balance');
    }

    /**
     * Account balance value
     * 
     * @return float
     */
    public function getBalance(): float 
    {
        return $this->balance;
    }
}