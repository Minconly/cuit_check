<?php
namespace Student\Controller;
use Common\Controller\StudentBaseController;

/**
 * Created by PhpStorm.
 * User: xjm
 * Date: 18-3-2
 * Time: 下午4:09
 */
class StudentApiController extends StudentBaseController{
    public function setAnswer(){
        $paperId = I('post.paper_id');
        $courseId = I('post.course_id');
        $questionId = I('post.question_id');
        $answerId = I('post.answer');
        $redis = $this->getRedis();

        $tag = C('REDIS_TAG')['testinfo'].$courseId.':'.$paperId;

        $AnswerLists = $tag.":".session("stu_account").':studentAnswerLists';

        $data = array(
            "status"=>0,
            "msg"=>"",
            "time" => json_decode($redis->hget($tag,"paperInfo"),true)["end_time"],
            "is_Intime"=> $status = D('paper_courserclass')->isIntime($paperId, $courseId)
        );

        if(empty($paperId)||empty($courseId)||empty($questionId)||empty($answerId)){
            $data["msg"] = "参数不完整,请重新进入";
            $this->ajaxReturn($data,'JSON');
            return;
        }
        if($answerId == "空+" && $redis->hexists($AnswerLists,$questionId)) {
            $redis->hdel($AnswerLists, $questionId);
            $data["msg"] = "存入成功";
            $data["status"] = 1;

            $this->ajaxReturn($data,"JSON");
            return;
        }
        $result = $redis->hset($AnswerLists,$questionId,$answerId);
        if($result!==0 && $result!==1){
            $data["msg"] = "系统错误";

            $this->ajaxReturn($data,'JSON');
            return;
        }
        $data["msg"] = "存入成功";
        $data["status"] = 1;

        $this->ajaxReturn($data,"JSON");
    }

    public function serverTime(){
        return date('Y-m-d H:i:s',time());
    }

    //获得缓存的答案
    public function getAnswer(){
        $paperId = I('post.paper_id');
        $courseId = I('post.course_id');
        $redis = $this->getRedis();
        $data =[];


        if(empty($paperId)||empty($courseId)){
            $data["status"] = 0;
            $data["msg"] = "参数不完整,请重新进入";
            $this->ajaxReturn($data,'JSON');
            return;
        }

        $tag = C('REDIS_TAG')['testinfo'].$courseId.':'.$paperId;
        $answerLists = $tag.":".session("stu_account").':studentAnswerLists';

        foreach ($redis->hkeys($answerLists) as $val){
            $data[$val] = $redis->hget($answerLists,$val);
        }

        $this->ajaxReturn($data,"JSON");

    }
}