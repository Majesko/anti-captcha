<?php

namespace AntiCaptcha\Responses;


use Psr\Http\Message\ResponseInterface;

/**
 * Class TaskResponse
 * @package AntiCaptcha\Responses
 */
class TaskResponse extends Response
{
    protected $task_id;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->task_id = (integer) $this->array_get($this->response_body, 'taskId');
    }

    /**
     * Task ID for future use in getTaskResult method
     * 
     * @return int
     */
    public function getTaskId(): int 
    {
        return $this->task_id;
    }
}