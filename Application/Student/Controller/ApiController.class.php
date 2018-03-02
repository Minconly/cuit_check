<?php

use Common\Controller\StudentBaseController;

/**
 * Created by PhpStorm.
 * User: xjm
 * Date: 18-3-2
 * Time: 下午4:09
 */
class ApiController extends StudentBaseController{
    public function setAnswer(){
        $paperId = I('post.paper_id');
        $courseId = I('post.course_id');
        $questionId = I('post.question_id');
        $answerId = I('post.answer');
        $redis = $this->getRedis();

        $tag = C('REDIS_TAG')['testinfo'].$courseId.':'.$paperId;

        $AnswerLists = $tag.":".session("stu_account").'studentAnswerLists';

        $data = array(
            "status"=>0,
            "msg"=>"",
            "time" => time(),
            "is_Intime"=> $status = D('paper_courserclass')->isIntime($paperId, $courseId)
        );

        if(empty($paperId)||empty($courseId)||empty($questionId)||empty($answerId)){
            $data["msg"] = "参数不完整,请重新进入";
            $this->ajaxReturn($data,'JSON');
            return;
        }

        $result = $redis->hset($AnswerLists,$questionId,$answerId);
        if(!$result){
            $data["msg"] = "系统错误";

            $this->ajaxReturn($data,'JSON');
            return;
        }
        $data["msg"] = "存入成功";
        $data["status"] = 1;

        $this->ajaxReturn($data,"JSON");
    }
}