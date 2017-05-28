<?php

namespace AntiCaptcha\Responses;

use Psr\Http\Message\ResponseInterface;

/**
 * Class QueueStatsResponse
 * @package AntiCaptcha\Responses
 */
class QueueStatsResponse extends Response
{   
    protected $waiting;
    protected $load;
    protected $bid;
    protected $speed;
    protected $total;

    /**
     * QueueStatsResponse constructor.
     * @param ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->waiting = (integer) $this->array_get($this->response_body, 'waiting');
        $this->load = (float) $this->array_get($this->response_body, 'load');
        $this->bid = (float) $this->array_get($this->response_body, 'bid');
        $this->speed = (float) $this->array_get($this->response_body, 'speed');
        $this->total = (integer) $this->array_get($this->response_body, 'total');
    }

    /**
     * Amount of idle workers online, waiting for a task
     * 
     * @return int
     */
    public function getWaiting(): int 
    {
        return $this->waiting;
    }

    /**
     * Queue load in percents
     * 
     * @return float
     */
    public function getLoad(): float 
    {
        return $this->load;
    }

    /**
     * Average task solution cost in USD
     * 
     * @return float
     */
    public function getBid(): float
    {
        return $this->bid;
    }

    /**
     * Average task solution speed in seconds
     * 
     * @return float
     */
    public function getSpeed(): float
    {
        return $this->speed;
    }

    /**
     * Total number of workers
     * 
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }
}