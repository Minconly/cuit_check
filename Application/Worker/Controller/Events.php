<?php
use \GatewayWorker\Lib\Gateway;
use Workerman\Lib\Timer;

/**
 * 监听和消息推送主逻辑代码
 */
class Events
{

    //将某个 学生踢出考试!
    public static function  delStu($account,$msg){
        Gateway::closeClient(md5($account),$msg);
    }

    /**
     * 有消息时
     * @param int $client_id
     * @param mixed $message
     */
    public static function onMessage($client_id, $message)
    {
        // debug
        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id session:".json_encode($_SESSION)." onMessage:".$message."\n";

        // 客户端传递的是json数据
        $message_data = json_decode($message, true);
        if(!$message_data)
        {
            return ;
        }

        // 根据类型执行不同的业务
        switch($message_data['type'])
        {
            // 客户端回应服务端的心跳
            case 'pong':
                return;
            // 客户端登录 message格式: {type:login, name:xx, room_id:1} ，添加到客户端，广播给所有客户端xx进入聊天室
            case 'login':
                // 判断是否有房间号
                if(!isset($message_data['room_id']))
                {
                    throw new \Exception("\$message_data['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']} \$message:$message");
                }

                // 把房间号昵称放到session中
                $room_id = $message_data['room_id'];
                $client_name = htmlspecialchars($message_data['client_name']);
                $_SESSION['room_id'] = $room_id;
                $_SESSION['client_name'] = $client_name;

                // 获取房间内所有用户列表
                $clients_list = Gateway::getClientSessionsByGroup($room_id);

                //判断该用户是否已经登录了
                foreach($clients_list as $tmp_client_id=>$item)
                {
                    //判断该用户是否已经登录了
                    //判断是否已经连接，如果有链接则之前的下线
                   if($item['client_name']==$client_name){
                       $offlineMessage = array(
                           'type'=>'out',
                           'message'=>'您的账号在其他地方登录本场考试,当前登录将在３s后下线!',
                           'time'=>date('Y-m-d H:i:s'),
                       );
                       Gateway::sendToClient($tmp_client_id, json_encode($offlineMessage));
                   }
                    $clients_list[$tmp_client_id] = $item['client_name'];
                }


                $clients_list[$client_id] = $client_name;
                // 转播给当前房间的所有客户端，xx进入聊天室 message {type:login, client_id:xx, name:xx}
                $new_message = array('type'=>$message_data['type'], 'client_id'=>$client_id, 'client_name'=>htmlspecialchars($client_name), 'time'=>date('Y-m-d H:i:s'));
                Gateway::sendToGroup($room_id, json_encode($new_message));
                Gateway::joinGroup($client_id, $room_id);


                // 给当前用户发送用户列表
                $new_message['client_list'] = $clients_list;
                Gateway::sendToCurrentClient(json_encode($new_message));
                return;

            // 客户端发言 message: {type:say, to_client_id:xx, content:xx}
            case 'say':
                // 非法请求
                if(!isset($_SESSION['room_id']))
                {
                    throw new \Exception("\$_SESSION['room_id'] not set. client_ip:{$_SERVER['REMOTE_ADDR']}");
                }
                $room_id = $_SESSION['room_id'];
                $client_name = $_SESSION['client_name'];

                // 私聊
                if($message_data['to_client_id'] != 'all')
                {
                    $message_data['to_client_id'];

                    $new_message = array(
                        'type'=>'say',
                        'from_client_id'=>$client_id,
                        'from_client_name'=>$client_name,
                        'content'=>htmlspecialchars($message_data['content']),
                        'time'=>date('Y-m-d H:i:s'),
                    );
                    foreach ($message_data['to_client_id'] as $k=>$v){
                        $new_message['to_client_id'] = $v;
                        Gateway::sendToClient($v,json_encode($new_message));
                        Gateway::sendToCurrentClient(json_encode($new_message));
                    }
                    return ;

//                    $new_message = array(
//                        'type'=>'say',
//                        'from_client_id'=>$client_id,
//                        'from_client_name' =>$client_name,
//                        'to_client_id'=>$message_data['to_client_id'],
//                        'content'=>"<b>对你说: </b>".nl2br(htmlspecialchars($message_data['content'])),
//                        'time'=>date('Y-m-d H:i:s'),
//                    );
//
//
//                    Gateway::sendToClient($message_data['to_client_id'], json_encode($new_message));
//                    $new_message['content'] = "<b>你对".htmlspecialchars($message_data['to_client_name'])."说: </b>".nl2br(htmlspecialchars($message_data['content']));
//                    return Gateway::sendToCurrentClient(json_encode($new_message));
                }

                $new_message = array(
                    'type'=>'say',
                    'from_client_id'=>$client_id,
                    'from_client_name' =>$client_name,
                    'to_client_id'=>'all',
                    'content'=>nl2br(htmlspecialchars($message_data['content'])),
                    'time'=>date('Y-m-d H:i:s'),
                );
                return Gateway::sendToGroup($room_id ,json_encode($new_message));
            case 'addTimer':
//                $cid = $message_data['courserclass_id'];
//                $pid = $message_data['testpaper_id'];
//                $stime = $message_data['start_time'];
                $etime = $message_data['end_time'];
                //获得当前时间距离考试结束的时间(s)
                $duringTime = strtotime($etime)-time();
                echo "建立一个定时任务在". $duringTime." s后执行";
                echo $message_data['courserclass_id']."-----".$message_data['testpaper_id']."";
                $workRoomId = Timer::add($duringTime, array(new \Worker\Controller\ExamManageController(), 'timerFlishTest'), array($message_data), false);
                echo "定时任务id".$workRoomId;
                $redis = getRedis('PREDIS_OPTIONS_SYS');
                $redis->set("worker:".$message_data['room_id'],$workRoomId,'EX',$duringTime);
                return;
            case 'delTimer':
                $cid = $message_data['cid'];
                $pid = $message_data['pid'];
                $redis = getRedis('PREDIS_OPTIONS_SYS');
                echo "取消定时任务"."worker:".md5($pid*1234567+$cid)."";
                $redis = getRedis('PREDIS_OPTIONS_SYS');
                if(!Timer::del($redis->get("worker:".md5($pid*1234567+$cid)))){
                    return;
                }
                $redis->del(array("worker:".md5($pid*1234567+$cid)));
                return;
        }
    }

    /**
     * 当客户端断开连接时
     * @param integer $client_id 客户端id
     */
    public static function onClose($client_id)
    {
        // debug
        echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id onClose:''\n";

        // 从房间的客户端列表中删除
        echo $_SESSION['room_id'];
        if(isset($_SESSION['room_id']))
        {
            $room_id = $_SESSION['room_id'];
            $new_message = array('type'=>'logout', 'from_client_id'=>$client_id, 'from_client_name'=>$_SESSION['client_name'], 'time'=>date('Y-m-d H:i:s'));

            Gateway::sendToGroup($room_id, json_encode($new_message));
        }
    }

}