<?php

namespace AntiCaptcha;

use AntiCaptcha\Responses\QueueStatsResponse;
use AntiCaptcha\Responses\Response;
use AntiCaptcha\Responses\TaskResultResponse;
use AntiCaptcha\Tasks\Task;
use AntiCaptcha\Traits\HelpersTrait;
use GuzzleHttp\Client as HttpClient;
use AntiCaptcha\Responses\BalanceResponse;
use AntiCaptcha\Responses\TaskResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Client
 * @package AntiCaptcha
 */
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

    /**
     * Makes api request
     *
     * @param string $action
     * @param array $params
     * @return ResponseInterface
     */
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

    /**
     * Creates a task for solving selected captcha type
     *
     * @param Task $task
     * @param string|null $soft_id
     * @return TaskResponse
     */
    public function createTask(Task $task, string $soft_id = null): TaskResponse
    {
        $request_params = [
            'task' => $task->getPropsAsArray(),
            'languagePool' => $this->language_pool,
            'softId' => $soft_id
        ];
        
        return new TaskResponse($this->requestApi('createTask', $request_params));
    }

    /**
     * Retrieves account balance
     *
     * @return BalanceResponse
     */
    public function getBalance(): BalanceResponse
    {
        return new BalanceResponse($this->requestApi('getBalance'));
    }

    /**
     * Requests task result
     *
     * @param string $task_id
     * @return TaskResultResponse
     */
    public function getTaskResult(string $task_id): TaskResultResponse
    {
        $request_params = [
            'taskId' => $task_id,
        ];
        
        return new TaskResultResponse($this->requestApi('getTaskResult', $request_params));
    }

    /**
     * Allows to define if it is suitable time to upload new task. Results are cached for 10 seconds
     *
     * @param int $queue_id
     * @return QueueStatsResponse
     */
    public function getQueueStats(int $queue_id): QueueStatsResponse
    {
        $request_params = [
            'queueId' => $queue_id
        ];
        
        return new QueueStatsResponse($this->requestApi('getQueueStats', $request_params));
    }
}