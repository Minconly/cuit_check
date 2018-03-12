<?php
/**
 * Created by PhpStorm.
 * User: xjmhome
 * Date: 18-3-11
 * Time: 下午9:40
 */
namespace Worker\Controller;
use Think\Controller;
use Common\Controller\StudentBaseController as stuControlller;
use \GatewayWorker\Lib\Gateway;


class ExamManageController extends Controller{

    //设为作弊
    public function setCheat(){
        $course_id = I("post.cid");
        $paper_id = I("post.pid");
        $client_id = I("post.client_id","");
        $tag = 'TestInfo:'.$course_id.':'.$paper_id;
        $student = $tag.":".session("stu_account");
        $student = $student.":studentTestingInfo";

        $studentController = new stuControlller();
        $redis = $studentController->getRedis();

        $arr = [];
        //设置redis缓存中的数据
        if($redis->hset($student,"is_cheat",1) == 0 ){
            $arr["status"] = 1;
            $arr["msg"] = "标记成功！";
            if($client_id !== ""){
                $message = array(
                    'type'=>'cheat',
                    'message'=>'您被标记为作弊！',
                    'time'=>date('Y-m-d H:i:s'),
                );
                if(Gateway::sendToClient($client_id,json_encode($message))){
                    $arr["msg"] = "标记作弊成功，并且将其踢下线";
                }else{
                    $arr["msg"] = "标记作弊成功，但踢下线失败";
                }
            }

        }else{
            $arr["status"] = 0;
            $arr["msg"] = "标记失败！";
        }

        $this->ajaxReturn($arr,"JSON");
    }

}