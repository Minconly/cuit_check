<?php

namespace Student\Controller;
use Common\Controller\StudentBaseController;


class TestRedisController extends StudentBaseController
{
    public function get(){
        $redis = $this->getRedis();
        echo $redis->dbsize();
    }
}