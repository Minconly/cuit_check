<?php
namespace Worker\Controller;
use Workerman\Worker;


// 注意：这里与上个例子不通，使用的是websocket协议
$ws_worker = new \Workerman\Worker('http://127.0.0.1:2346');

// 启动4个进程对外提供服务
$ws_worker->count = 4;

// 当收到客户端发来的数据后返回hello $data给客户端
$ws_worker->onMessage = function($connection, $data)
{
    // 向客户端发送hello $data
    $connection->send('hello ' . $data);
};

// 运行worker
Worker::runAll();