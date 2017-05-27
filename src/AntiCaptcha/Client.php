<?php

namespace AntiCaptcha;

use AntiCaptcha\Responses\QueueStatsResponse;
use AntiCaptcha\Responses\TaskResultResponse;
use AntiCaptcha\Tasks\Task;
use GuzzleHttp\Client as HttpClient;
use AntiCaptcha\Responses\BalanceResponse;
use AntiCaptcha\Responses\TaskResponse;

class Client
{
    private $api_url = 'https://api.anti-captcha.com/';
    private $api_key;
    private $client;
    private $timeout = 30.0;
    private $language_pool;
    
    public function __construct(string $api_key, string $lang = 'en')
    {
        $config = [
            'base_uri' => $this->api_url,
            'timeout' => $this->timeout
        ];
        $this->api_key = $api_key;
        $this->language_pool = $lang;
        $this->client = new HttpClient($config);
    }
    
    private function getClient()
    {
        return $this->client;
    }
    
    public function createTask(Task $task, string $soft_id = null): TaskResponse
    {
        $request_params = [
            'clientKey' => $this->api_key,
            'task' => $task->getPropsAsArray(),
            'languagePool' => $this->language_pool,
            'softId' => $soft_id
        ];
        
        $response = $this->getClient()->post('/createTask', [
            'json' => $request_params
        ]);
        
        return new TaskResponse($response);
    }
    
    public function getBalance()
    {
        $request_params = [
            'clientKey' => $this->api_key
        ];
        $response = $this->getClient()->post('/getBalance', [
            'json' => $request_params
        ]);
        
        return new BalanceResponse($response);
    }
    
    public function getTaskResult(string $task_id)
    {
        $request_params = [
            'clientKey' => $this->api_key,
            'taskId' => $task_id,
        ];
        
        $response = $this->getClient()->post('/getTaskResult', [
            'json' => $request_params
        ]);
        
        return new TaskResultResponse($response);
    }
    
    public function getQueueStats(int $queue_id)
    {
        $response = $this->getClient()->post('/getQueueStats ', [
            'json' => [
                'queueId' => $queue_id
            ]
        ]);
        
        return new QueueStatsResponse($response);
    }
}