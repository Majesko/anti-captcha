<?php

namespace AntiCaptcha\Responses;


use Psr\Http\Message\ResponseInterface;

/**
 * Class TaskResponse
 * @package AntiCaptcha\Responses
 * 
 * @property integer $task_id
 */
class TaskResponse extends Response
{
    protected $task_id;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->task_id = (integer) $this->array_get($this->response_body, 'taskId');
    }
    
    public function getTaskId(): int 
    {
        return $this->task_id;
    }
}