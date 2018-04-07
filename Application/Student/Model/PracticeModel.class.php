<?php
/**
 * Created by PhpStorm.
 * User: xjmhome
 * Date: 18-4-4
 * Time: 下午5:42
 */

namespace Student\Model;
use Think\Model;

class PracticeModel extends  Model
{
    public function getPractice($type,$account,$corseClassId,$num){
        $questions = '';
        $randQuestionIds = '';
        //返回的信息
        $data = [];
        $question_info = [];
        //最终产生的题目id列表
        $questionIds = [];
        $questionIdsStr = "";
        //获得lession_id
        $courseclass = M('courseclass')->where(['id'=>$corseClassId])->find();
        switch ($type){
            //随机出题
            case 1:{
                //获得当前课程
                $databaseIds = M('testdatabase')->where(['lession_id'=>$courseclass['lession_id'],'college_id'=>$courseclass['college_id'],'type'=>1,'status'=>1,'del_flag'=>1])
                ->getField("id",true);
                $databaseIds  = $this->ArrToStr($databaseIds);
                if($databaseIds == ""){
                    break;
                }
                $questions = M('question')->where(['testdb_id'=>array('in',$databaseIds)])->select();
                $num = $num > count($questions,0) ?count($questions,0):$num;
                $randQuestionIds = array_rand($questions,$num);
            }
            break;
            //从错题中出题
            case 2:{
                //获得错题列表
                $map['account'] = $account;
                $map['college_id'] = $courseclass['college_id'];
                $map['lession_id'] = $courseclass['lession_id'];
                $map['del_flag'] = 1;
                $map['is_true'] = 0;
                $questionIdsStr = M('practice')->where($map)->getField('question_id',true);
                if($this->ArrToStr($questionIdsStr) == ""){
                    break;
                }
                $questions = M('question')->where(['id'=>array('in',$this->ArrToStr($questionIdsStr))])->select();
                $num = $num > count($questions,0) ?count($questions,0):$num;
                $randQuestionIds = array_rand($questions,$num);
            }
            break;
            //出新题
            case 3:{
                //获得所有题目
                $databaseIds = M('testdatabase')->where(['lession_id'=>$courseclass['lession_id'],'college_id'=>$courseclass['college_id'],'type'=>1,'status'=>1,'del_flag'=>1])
                    ->getField("id",true);
                $databaseIds  = $this->ArrToStr($databaseIds);
                $allQuestions = M('question')->where(['testdb_id'=>array('in',$databaseIds)])->select();
                //获得错题
                $map['account'] = $account;
                $map['college_id'] = $courseclass['college_id'];
                $map['lession_id'] = $courseclass['lession_id'];
                $map['del_flag'] = 1;
                $questionIdsStr = M('practice')->where($map)->getField  ('question_id',true);
                $errQuestions = M('question')->where(['id'=>array('in',$this->ArrToStr($questionIdsStr))])->select();

                $questions = $this->my_array_diff($allQuestions,$errQuestions);
                $num = $num > count($questions,0) ?count($questions,0):$num;
                $randQuestionIds = array_rand($questions,$num);
            }
            break;
        }

        foreach ($randQuestionIds as $key => $value) {
            $question_info[$key] = $questions[$value];
            $answer_info = M('answer')->field(array('content', 'id','is_true'))->where(array('question_id'=>$questions[$value]['id'],'del_flag'=>1))->select();
            $question_info[$key]['answer'] = $answer_info;
            if($type == 1 || $type == 3){
                array_push($questionIds,$questions[$value]['id']);
            }
        }
        if($type == 1 || $type == 3){
            $data = array('question_info'=>$question_info,'courseclass'=>$courseclass,'questionIds'=>implode(',',$questionIds));
        }else if($type == 2){
            $data = array('question_info'=>$question_info,'courseclass'=>$courseclass,'questionIds'=>$this->ArrToStr($questionIdsStr));
        }

//        p($data);
        return $data;
    }

    private function ArrToStr($arr){
        return implode(',',$arr);
    }

    private function my_array_diff($arr1,$arr2){
        $arr3=array();
        foreach ($arr1 as $key => $value) {
            if(!in_array($value,$arr2)){
                $arr3[]=$value;
            }
        }
            return $arr3;
        }

}