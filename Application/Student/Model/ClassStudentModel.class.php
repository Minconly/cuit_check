<?php
/**
 * Created by PhpStorm.
 * User: xjm
 * Date: 18-3-6
 * Time: 下午2:49
 */

namespace Student\Model;
use Think\Model;


class ClassStudentModel extends Model
{
    //获取学生加入的课程，并且在行课中
    public function getCourse($studentId){
        $where = [];
        $where["kcs.account"] = $studentId;
        $where["kcc.end_time"] = array('lt',time());

        $result = M("class_student")->alias("kcs")
            ->field("kcs.courseclass_id cci, kcc.name")
            ->join("left join kh_courseclass kcc on kcs.courseclass_id = kcc.id ")
            ->where($where)->select();
        return $result;
    }
}