<?php
namespace Student\Controller;

use Common\Controller\StudentBaseController;
use Predis\Client;


class PracticeController extends StudentBaseController
{
    protected $redis;
    public function beginPractice (){
        //判断进行什么样的测试
        $type = I('type',"1");
        //获得用户信息
        $account = session("stu_account");
        $corseClassId = session("courseClassId");
        $questionList = D("Practice")-> getPractice($type,$account,$corseClassId,5);

        $this->assign("question",$questionList['question_info']);
        $this->assign("courseclass",$questionList['courseclass']);
        $this->assign("questionIds",$questionList['questionIds']);
        $this->assign("type",$type);
        $this->display("practicePaper");
    }

    public function commitAnswer(){
        $type = I('type');
        $lession_id  = I('lession_id');
        $college_id  = I('college_id');
        $questionIds = I('questionIds');
        $questionIdsArr = explode(',',$questionIds);

        //答题列表
        $havaQuestionIds = [];
        //答题值
        $havaQuestionValue = [];

        if(!IS_POST || $type == "") {
            $msg = array('success' => false, 'msg' => '提交方式不正确');
            $this->ajaxReturn($msg,'json');
            return;
        }else{
            $allNum = 0;
            $rightNum = 0;
            $errQuestion = [];
            switch ($type){
                case 1:{
                    foreach ($questionIdsArr as $key => $value){
                        $data = [];
                        $userAnswerValue = I('post.question_'.$value);
                        $is_true = 0;
                        if($userAnswerValue == ""){
                            continue;
                        }else{
                            $allNum += 1;
                            array_push($havaQuestionIds,$value);
                            array_push($havaQuestionValue,$userAnswerValue);
                            //获得题目正确答案内容
                             $rightAnsValue = M('answer')
                                ->where(['question_id'=>$value,'is_true'=>1,'del_flag'=>1])
                                ->field("id,content")->find();
                            if($userAnswerValue === $rightAnsValue['content']){
                                $rightNum += 1;
                                $is_true = 1;
                            }else{
                                array_push($errQuestion,$value);
                            }

                            $data['question_id'] = $value;
                            $data['account'] = session('stu_account');
                            $data['college_id'] = $college_id;
                            $data['lession_id'] = $lession_id;

                            //查找此题目是否已经存在
                            $practiceItem = M('practice')->where($data)->select();

                            if($practiceItem==null){
                                $data['answer_id'] = $rightAnsValue['id'];
                                $data['answer_value'] = $userAnswerValue;
                                $data['is_true'] = $is_true;
                                $data['creatime'] = date("Y-m-d H:i:s",time());
                                $data['create_date'] = date("Y-m-d H:i:s",time());
                                $data['del_flag'] = 1;
                                $data['create_by'] = "system";
                                if(!M('practice')->data($data)->add()){
                                    $msg = array('success' => false, 'msg' => '系统有误');
                                    $this->ajaxReturn($msg,'json');
                                    return;
                                }
                            }else{
                                $updateCol['is_true'] = $is_true;
                                $updateCol['answer_value'] = $userAnswerValue;
                                $updateCol['update_by'] = "system";
                                $updateCol['update_date'] = date("Y-m-d H:i:s",time());
                                if(!M('practice')->where($data)->save($updateCol)){
                                    $msg = array('success' => false, 'msg' => '系统有误');
                                    $this->ajaxReturn($msg,'json');
                                    return;
                                }
                            }

                        }
                    }
                }
                break;
                case 2:{
                    foreach ($questionIdsArr as $key => $value){
                        $userAnswerValue = I('post.question_'.$value);
                        $is_true = 0;
                        if($userAnswerValue == ""){
                            continue;
                        }else{
                            $allNum += 1;
                            array_push($havaQuestionIds,$value);
                            array_push($havaQuestionValue,$userAnswerValue);
                            //获得题目正确答案内容
                            $rightAnsValue = M('answer')
                                ->where(['question_id'=>$value,'is_true'=>1,'del_flag'=>1])
                                ->field("id,content")->find();
                            if($userAnswerValue === $rightAnsValue['content']){
                                $rightNum += 1;
                                $is_true = 1;
                            }else{
                                array_push($errQuestion,$value);
                            }

                            $data['question_id'] = $value;
                            $data['account'] = session('stu_account');
                            $data['college_id'] = $college_id;
                            $data['lession_id'] = $lession_id;

                            $updateCol['is_true'] = $is_true;
                            $updateCol['answer_value'] = $userAnswerValue;
                            $updateCol['update_by'] = "system";
                            $updateCol['update_date'] = date("Y-m-d H:i:s",time());
                            if(!M('practice')->where($data)->save($updateCol)){
                                $msg = array('success' => false, 'msg' => '系统有误');
                                $this->ajaxReturn($msg,'json');
                                return;
                            }
                        }
                    }
                }
                break;
                case 3:{
                    foreach ($questionIdsArr as $key => $value){
                        $userAnswerValue = I('post.question_'.$value);
                        $is_true = 0;
                        if($userAnswerValue == ""){
                            continue;
                        }else{
                            $allNum += 1;
                            array_push($havaQuestionIds,$value);
                            array_push($havaQuestionValue,$userAnswerValue);
                            //获得题目正确答案内容
                            $rightAnsValue = M('answer')
                                ->where(['question_id'=>$value,'is_true'=>1,'del_flag'=>1])
                                ->field("id,content")->find();
                            if($userAnswerValue === $rightAnsValue['content']){
                                $rightNum += 1;
                                $is_true = 1;
                            }else{
                                array_push($errQuestion,$value);
                            }

                            $data['question_id'] = $value;
                            $data['account'] = session('stu_account');
                            $data['college_id'] = $college_id;
                            $data['lession_id'] = $lession_id;

                            $data['answer_id'] = $rightAnsValue['id'];
                            $data['answer_value'] = $userAnswerValue;
                            $data['is_true'] = $is_true;
                            $data['creatime'] = date("Y-m-d H:i:s",time());
                            $data['create_date'] = date("Y-m-d H:i:s",time());
                            $data['del_flag'] = 1;
                            $data['create_by'] = "system";
                            if(!M('practice')->data($data)->add()){
                                $msg = array('success' => false, 'msg' => '系统有误');
                                $this->ajaxReturn($msg,'json');
                                return;
                            }
                        }
                    }
                }
                break;


            }

            /*计算正确率*/
            $correctRate = $rightNum == 0?0:sprintf("%.2f",$rightNum/$allNum);

            /*更新排行榜*///分数 = （错题）* 0.2 + (正确题) * 0.8;
            //计算正确的题量和错误的题量
            $allRightNum = M('practice')->where(['account'=>session('stu_account'),
                'lession_id'=>$lession_id,'college_id'=>$college_id,'is_true'=>1])->count();
            $allErrNum = M('practice')->where(['account'=>session('stu_account'),
                'lession_id'=>$lession_id,'college_id'=>$college_id,'is_true'=>0])->count();

            $score = ceil($allRightNum * 9.5 + $allErrNum * 0.5);

            $tag = "userRank:".$college_id.":".$lession_id;
            $myRedis = $this->getMyRedis();
            $myRedis->zadd($tag,intval($score),session('stu_account').':'.session('stuInfo')['name']);
            //返回错题集
            $notRightIds = implode(',',$errQuestion);

            //保存测试历史
            $practiceLog['account']=session('stu_account');
            $practiceLog['date']=date("Y-m-d H:i:s",time());
            $practiceLog['lession_id']=$lession_id;
            $practiceLog['ratio'] = $correctRate;
            $practiceLog['questions'] = implode(":",$havaQuestionIds);
            $practiceLog['answers'] = implode(":",$havaQuestionValue);
            $practiceLog['create_by'] = "system";
            $practiceLog['create_date'] = date("Y-m-d H:i:s",time());
            $practiceLog['del_flag'] = "1";

            if(!M('practiceLog')->data($practiceLog)->add()){
                $msg = array('success' => false, 'msg' => '系统有误');
                $this->ajaxReturn($msg,'json');
                return;
            }

            $msg = array('success' => true, 'msg' => 'ok','rate'=>$correctRate,'errList'=>$notRightIds);

            $this->ajaxReturn($msg,"json");
        }
    }

    public function getRank(){
        $account = session("stu_account");
        $corseClassId = session("courseClassId");
        //获得lession_id
        $courseclass = M('courseclass')->where(['id'=>$corseClassId])->find();
        $college_id=$courseclass['college_id'];
        $lession_id=$courseclass['lession_id'];
        $tag = "userRank:".$college_id.":".$lession_id;
        $myRedis = $this->getMyRedis();
        $msg['data'] = $myRedis->zrevrange($tag,0,-1,'WITHSCORES'   );
        $msg['success'] = true;
        $this->ajaxReturn($msg,"json");
    }

    //获取redis客户端
    private function getMyRedis(){
        if($this->redis == null) {
            $this->redis = new Client(C('PREDIS_OPTIONS_SYS'));
        }
        return $this->redis;
    }



}