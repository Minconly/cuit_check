<?php
/**
 * Created by PhpStorm.
 * User: xjm
 * Date: 18-3-8
 * Time: 下午3:36
 */

namespace Student\Controller;
use Common\Controller\StudentBaseController;

class CourseClassController extends StudentBaseController
{
    public function courseClassList(){
        $currentCourse = I("courseClassId");
        $data =  D("Courseclass")->getAllCourseClassList();
        $this->assign('list',$data);
        $this->assign('currentCourse',$currentCourse);
        $content = $this->fetch();
        $this->ajaxReturn(array("data"=>$content),"json");
    }
}