<?php
/**
 * Created by PhpStorm.
 * User: majesko
 * Date: 27.05.17
 * Time: 21:09
 */

namespace AntiCaptcha\Responses;

use AntiCaptcha\Solutions\ImageToTextSolution;
use AntiCaptcha\Solutions\Solution;
use Psr\Http\Message\ResponseInterface;

/**
 * Class TaskResultResponse
 * @package AntiCaptcha\Responses
 * 
 * @property string $status
 * @property string $solution
 * @property string $cost
 * @property string $ip
 * @property string $create_time
 * @property string $end_time
 * @property string $solve_count
 */
class TaskResultResponse extends Response
{
    protected $status;
    protected $solution;
    protected $cost;
    protected $ip;
    protected $create_time;
    protected $end_time;
    protected $solve_count;
    
    public function __construct(ResponseInterface $response)
    {
        parent::__construct($response);
        $this->status = $this->array_get($this->response_body, 'status');
        $this->cost = $this->array_get($this->response_body, 'cost');
        $this->ip = $this->array_get($this->response_body, 'ip');
        $this->create_time = $this->array_get($this->response_body, 'createTime');
        $this->end_time = $this->array_get($this->response_body, 'endTime');
        $this->solve_count = $this->array_get($this->response_body, 'solveCount');
        $this->solution = $this->status == 'ready' 
            ? new ImageToTextSolution($this->array_get($this->response_body, 'solution')) 
            : null;
    }
    
    public function getStatus(): string
    {
        return $this->status;
    }
    
    public function getSolution()
    {
        return $this->solution;
    }
    
    public function getCost()
    {
        return $this->cost;
    }
    
    public function getIp()
    {
        return $this->ip;
    }
    
    public function getCreateTime()
    {
        return $this->create_time;
    }
    
    public function getEndTime()
    {
        return $this->end_time;
    }
    
    public function getSolveCount()
    {
        return $this->solve_count;
    }
}