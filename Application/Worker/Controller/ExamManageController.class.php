<?php
/**
 * Created by PhpStorm.
 * User: xjmhome
 * Date: 18-3-11
 * Time: 下午9:40
 */
namespace Worker\Controller;
use Think\Controller;
use \GatewayWorker\Lib\Gateway;


class ExamManageController extends Controller{

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

    //定时任务
    /**
     * 定时结束考试并且统计
     * @param array  $data
     */
    public function timerFlishTest($data){
        $cid = $data['courserclass_id'];
        $pid = $data['testpaper_id'];
        $stime = $data['start_time'];
        $etime = $data['end_time'];
        $tag = C('REDIS_TAG')['testinfo'].$cid.':'.$pid;

        $redis = getRedis();

        //获得获得某个行课班级
        echo '$cid,$pid=======>'.$cid."  ".$pid."      ".var_dump($data);
        $studentList = D('Home/courseclass')->getStuInfoByCid($cid,$pid);
//        echo "定时任务执行：";
        echo var_dump($studentList)."55";
//        foreach ($studentList as $key => $value){
//            $singleData = [];
//            $studentInfoTag = $tag.":".$value['account'].":studentTestingInfo";
//            $studentAnswerTag = $tag.":".$value['account'].":studentAnswerLists";
//            if($redis->exists($studentInfoTag)){
//                //判断是否标记为作弊
//                if($redis->hget($studentInfoTag,"is_cheat")==1){
//                    break;
//                }
//                if($redis->exists($studentAnswerTag)){
//                    break;
//                }
//                //获得所有回答的题
//                $doQustionIds = $redis->hkeys($studentAnswerTag);
//                //循环获得单条记录
//                foreach ($doQustionIds as $key2 => $id) {
//                    $singleData['student_id'] = $value['id'];
//                    $singleData['testpaper_id'] = $pid;
//                    $singleData['question_id'] = $id;
//                    $singleData['answer_value'] = $redis->hget($studentAnswerTag,$id);
//                    $isTrue = ($redis->hget($studentAnswerTag,$id)) == ($redis->hget($tag.":questionLists",$id));
//                    $singleData['is_true'] = $isTrue;
//                    $answerIds = D('answer')->where(['question_id'=>$id])->select();
//                    if(count($answerIds) === 1){
//                        $singleData['answer_id'] = $answerIds[0]['id'];
//                    }else if(count($answerIds) > 1){
//                        $singleData['answer_id'] = $singleData['answer_value'];
//                    }else{
//                        break;
//                    }
//                    if(!D('testFinal')->data($singleData)->add()){
//                        break;
//                    }
//                }
//
//            }else{
//                break;
//            }
//        }

    }

}