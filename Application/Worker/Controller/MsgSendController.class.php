<?php
namespace Worker\Controller;
use Think\Controller;
use Home\Model\TestpaperModel;
use Home\Model\CourseclassModel as Courseclass;
/**
 * 消息推送
 * @package Student\Controller
 */
class MsgSendController extends controller{
    /**
     */
    public function index(){
        //获取正在进行的考试列表
        $data = (new TestpaperModel())->getNowExam();
       $this->assign('exam_list',$data);
       $this->display();
    }

    public function detail(){
        //当前考试对应的班级id
        $cid = I('cid',0,'int');
        //试卷id
        $pid = I('pid',0,'int');
        if($cid && $pid){
            //获取当前登录的用户信
            $this->assign('accountname','xxx');
            $this->assign('account','taolei233');
            $this->assign('room_id',md5($pid*1234567+$cid));
            $this->assign('account_type','admin');

            //获取当场考试的所有学生信息
            $list = (new Courseclass())->getStuInfoByCid($cid,$pid);
            $this->assign('cid',$cid);
            $this->assign('pid',$pid);
            $this->assign('user_list',$list);
//            p($list);
            $this->display();
        }
    }
}