<?php
namespace Worker\Controller;
use Think\Controller;
use Home\Model\TestpaperModel;
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
       //p($data);
       $this->display();
    }

    public function detail(){

        //获取当前登录的用户信
        $this->assign('accountname','xxx');
        $this->assign('account','taolei233');
        $this->assign('room_id','11');
        $this->assign('account_type','admin');
        $this->display();
    }
}