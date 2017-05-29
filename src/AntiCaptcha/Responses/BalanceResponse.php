<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;

/**
 * Class BalanceResponse
 * @package AntiCaptcha\Responses
 */
class BalanceResponse extends Response
{
    /**
     * Account balance value
     * @var float
     */
    protected $balance;

    /**
     * BalanceResponse constructor.
     * @param ResponseInterface $response
     */
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