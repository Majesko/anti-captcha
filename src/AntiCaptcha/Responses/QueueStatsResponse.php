<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;

class QueueStatsResponse extends Response
{   
    protected $waiting;
    protected $load;
    protected $bid;
    protected $speed;
    protected $total;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->waiting = (float) $this->array_get($this->response_body, 'waiting');
        $this->load = $this->array_get($this->response_body, 'load');
        $this->bid = $this->array_get($this->response_body, 'bid');
        $this->speed = $this->array_get($this->response_body, 'speed');
        $this->total = $this->array_get($this->response_body, 'total');
    }
    
    public function getWaiting()
    {
        return $this->waiting;
    }
    
    public function getLoad()
    {
        return $this->load;
    }
    
    public function getBid()
    {
        return $this->bid;
    }
    
    public function getSpeed()
    {
        return $this->speed;
    }
    
    public function getTotal()
    {
        return $this->total;
    }
}