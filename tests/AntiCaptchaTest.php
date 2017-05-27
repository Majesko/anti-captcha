<?php

use PHPUnit\Framework\TestCase;
use AntiCaptcha\Client;
use AntiCaptcha\Responses\BalanceResponse;
use AntiCaptcha\Responses\TaskResponse;
use AntiCaptcha\Responses\TaskResultResponse;
use AntiCaptcha\Responses\QueueStatsResponse;
use AntiCaptcha\Solutions\ImageToTextSolution;
use AntiCaptcha\Traits\HelpersTrait;
use AntiCaptcha\Tasks\ImageToTextTask;

class AntiCaptchaTest extends TestCase
{
    use HelpersTrait;
    
    protected $client;
    
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->client = new Client($token = ''); 
    }

    public function testAntiCaptchaInit()
    {
        $this->assertInstanceOf(Client::class, $this->client);
    }
    
    public function testGetBalance()
    {
        $response = $this->client->getBalance();
        $this->assertInstanceOf(BalanceResponse::class, $response);
        $this->assertInternalType('float', $response->getBalance());
    }
    
    public function testGetQueueStats()
    {
        $response = $this->client->getQueueStats(1);
        $this->assertInstanceOf(QueueStatsResponse::class, $response);
    }
    
    public function testCreateTask()
    {
        $captcha_url = '';
        $captcha = $this->image_url_to_base64($captcha_url);
        
        $this->assertInternalType('string', $captcha);
        $task = new \AntiCaptcha\Tasks\ImageToTextTask($captcha);
        $this->assertInstanceOf(ImageToTextTask::class, $task);
        
        $response = $this->client->createTask($task);
        $this->assertInstanceOf(TaskResponse::class, $response);
        
        sleep(60);
        
        $result = $this->client->getTaskResult($response->getTaskId());
        
        $this->assertInstanceOf(TaskResultResponse::class, $result);
        $this->assertInstanceOf(ImageToTextSolution::class, $result->getSolution());
    }
}