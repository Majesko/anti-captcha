<?php

namespace AntiCaptcha;

use AntiCaptcha\Responses\QueueStatsResponse;
use AntiCaptcha\Responses\TaskResultResponse;
use AntiCaptcha\Tasks\Task;
use AntiCaptcha\Traits\HelpersTrait;
use GuzzleHttp\Client as HttpClient;
use AntiCaptcha\Responses\BalanceResponse;
use AntiCaptcha\Responses\TaskResponse;
use Psr\Http\Message\ResponseInterface;

class Client
{
    use HelpersTrait;
    
    private $api_url = 'https://api.anti-captcha.com/';
    private $api_key;
    private $client;
    private $timeout = 30.0;
    private $language_pool = 'en';
    
    public function __construct(string $api_key, array $options = [])
    {
        $config = [
            'base_uri' => $this->api_url,
            'timeout' => $this->array_get($options, 'timeout') ?: $this->timeout
        ];
        
        $this->api_key = $api_key;
        $this->language_pool = $this->array_get($options, 'lang') ?: $this->language_pool;
        $this->client = new HttpClient($config);
    }
    
    private function requestApi(string $action, array $params = []): ResponseInterface
    {
        $default_params = [
            'clientKey' => $this->api_key
        ];
        $request_params = array_merge($default_params, $params);

       return $this->client->post('/'.$action, [
            'json' => $request_params
        ]);
    }
    
    public function createTask(Task $task, string $soft_id = null): TaskResponse
    {
        $request_params = [
            'task' => $task->getPropsAsArray(),
            'languagePool' => $this->language_pool,
            'softId' => $soft_id
        ];
        
        return new TaskResponse($this->requestApi('createTask', $request_params));
    }
    
    public function getBalance()
    {
        return new BalanceResponse($this->requestApi('getBalance'));
    }
    
    public function getTaskResult(string $task_id)
    {
        $request_params = [
            'taskId' => $task_id,
        ];
        
        return new TaskResultResponse($this->requestApi('getTaskResult', $request_params));
    }
    
    public function getQueueStats(int $queue_id)
    {
        $request_params = [
            'queueId' => $queue_id
        ];
        
        return new QueueStatsResponse($this->requestApi('getQueueStats', $request_params));
    }
}