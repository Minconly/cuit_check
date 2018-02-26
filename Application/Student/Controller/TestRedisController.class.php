<?php

namespace Student\Controller;
use Common\Controller\StudentBaseController;


class TestRedisController extends StudentBaseController
{
    public function get(){
        $redis = $this->getRedis();
        $redis->set('mylock', 'value', 'EX', 10,'NX');
        echo $redis->get('mylock');
    }
}