<?php

namespace Student\Controller;
use Common\Controller\StudentBaseController;


class TestRedisController extends StudentBaseController
{
    public function get(){
        $redis = $this->getRedis();
//        $redis->set('mylock', 'value', 'EX', 10,'NX');
//        echo $redis->del(array('mylock'));


        $isok = lock("testLock",30);
        if($isok){
            echo '获得锁';
            sleep(15);
            unlock("testLock");
        }else{
            echo '锁被占用';
        }




    }
}