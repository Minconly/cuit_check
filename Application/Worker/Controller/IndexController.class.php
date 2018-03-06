<?php
namespace Worker\Controller;
use Think\Controller;
use Workerman\Worker;
use Workerman\WebServer;
use Workerman\Lib\Timer;
use \GatewayWorker\Gateway;
use \GatewayWorker\Register;
use \GatewayWorker\BusinessWorker;


class IndexController  extends Controller{
    public function index(){
        if(!IS_CLI){
            die("无法直接访问，请通过命令行启动");
        }

        $register = new \GatewayWorker\Register('text://0.0.0.0:1236');
        $worker = new \Workerman\Worker('websocket://127.0.0.1:2346');


        // gateway 进程
        $gateway = new Gateway("Websocket://0.0.0.0:7272");

        // 设置名称，方便status时查看
                $gateway->name = 'ChatGateway';
        // 设置进程数，gateway进程数建议与cpu核数相同
                $gateway->count = 4;
        // 分布式部署时E请设置成内网ip（非127.0.0.1）
                $gateway->lanIp = '127.0.0.1';
        // 内部通讯起始端口。假如$gateway->count=4，起始端口为2300
        // 则一般会使用2300 2301 2302 2303 4个端口作为内部通讯端口
                $gateway->startPort = 2300;
        // 心跳间隔
                $gateway->pingInterval = 10;
        // 心跳数据
                $gateway->pingData = '{"type":"ping"}';
        // 服务注册地址
                $gateway->registerAddress = '127.0.0.1:1236';

        // bussinessWorker 进程
        $worker = new BusinessWorker();
        // worker名称
                $worker->name = 'ChatBusinessWorker';
        // bussinessWorker进程数量
                $worker->count = 4;
        // 服务注册地址
                $worker->registerAddress = '127.0.0.1:1236';

//        // 当收到客户端发来的数据后返回hello $data给客户端
//        $worker->onWorkerStart = function($worker){
//            echo "Worker starting...\n";
//        };
//
//        $worker->onMessage = function($connection, $data)
//        {
//            // 向客户端发送hello $data
//            $connection->send('hello world'.$data);
//        };
        // 运行worker
        Worker::runAll();
    }

}