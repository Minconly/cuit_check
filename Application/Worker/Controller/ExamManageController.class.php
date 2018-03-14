<?php
/**
 * Created by PhpStorm.
 * User: xjmhome
 * Date: 18-3-11
 * Time: 下午9:40
 */
namespace Worker\Controller;
use Think\Controller;
//use Common\Controller\StudentBaseController as stuControlller;
use Predis\Autoloader;
use Predis\Client;
use \GatewayWorker\Lib\Gateway;


class ExamManageController extends Controller{
    protected  $redis;

    //设为作弊
    public function setCheat(){
        $course_id = I("post.cid");
        $paper_id = I("post.pid");
        $name = I("post.name");
        $client_id = I("post.client_id","");
        $account = I("post.account","");
        $tag = 'TestInfo:'.$course_id.':'.$paper_id;
        $student = $tag.":".$account;
        $student = $student.":studentTestingInfo";

        $redis = getRedis();

        $arr = [];

        $isok = false;
        //设置redis缓存中的数据
        if($redis->hexists($student,"is_cheat") && $redis->hset($student,"is_cheat",1) == 0 ){
            if(!M('cheat')->where(array("account"=>$account,"cid"=>$course_id,"pid"=>$paper_id))->find()){
                $isok = M('cheat')->data(array("account"=>$account,"cid"=>$course_id,"pid"=>$paper_id,"cheat"=>1,"name"=>$name))->add();
            }else{
                $isok = M('cheat')->data(array("cheat"=>1))->where(array("account"=>$account,"cid"=>$course_id,"pid"=>$paper_id))->save();
            }
            if($isok){
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
                $redis->hset($student,"is_cheat",0);
                $arr["status"] = 0;
                $arr["msg"] = "标记失败 或 已经被标记！";
            }

        }else{
            $arr["status"] = 0;
            $arr["msg"] = "该生还未答题 或 标记失败！";
        }

        $this->ajaxReturn($arr,"JSON");
    }


    //取消作弊
    public function unSetCheat(){
        $course_id = I("post.cid");
        $paper_id = I("post.pid");
        $account = I("post.account","");
        $tag = 'TestInfo:'.$course_id.':'.$paper_id;
        $student = $tag.":".$account;
        $student = $student.":studentTestingInfo";

        $redis = getRedis();

        $arr = [];
        $isok = false;
        //设置redis缓存中的数据
        if($redis->hexists($student,"is_cheat") && ($redis->hset($student,"is_cheat",0) == 0) ){
            if(!M('cheat')->where(array("account"=>$account,"cid"=>$course_id,"pid"=>$paper_id))->find()){
                $arr["status"] = 0;
                $arr["msg"] = "解除失败，未标记过！";
            }else{
                $isok = M('cheat')->data(array("cheat"=>0))->where(array("account"=>$account,"cid"=>$course_id,"pid"=>$paper_id))->save();
            }
            if($isok){
                $arr["status"] = 1;
                $arr["msg"] = "解除成功！";
            }else{
                $arr["status"] = 0;
                $arr["msg"] = "该用户没有被标记，无需解除！";
            }

        }else{
            $arr["status"] = 0;
            $arr["msg"] = "解除失败，该生还未答题！";
        }

        $this->ajaxReturn($arr,"JSON");
    }


}