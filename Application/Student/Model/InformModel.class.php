<?php 
/**
 * 通知公告的数据模型
 * @arthur luochao
 */
namespace Student\Model;
use Think\Model;

class InformModel extends Model{	
	public function getInformList(){
		$limit=5;
		$map['kh_inform.del_flag']=array('eq','1');
		$map['sendtype']=array('neq' , '2' );
		$list=M('inform')
        ->join("left join kh_student as stu on kh_inform.dept_id = stu.dept_id")
		->field('kh_inform. id,title,greatedate')
		->where($map)->where(array("stu.account" => session("stu_account")))
		->order('kh_inform.greatedate desc')
		->limit($limit)
		->select();
		return $list;

	}
	/**
	 * 通知公告详细信息
	 */
	public function informPreShow($id){
		$map['kh_inform.id']=$id;
		// $map['del_flag']=array('eq',1 );
		$data=M('inform')
		->field('id,title,greatedate,content,file_url,file_name,greateby')
		->where($map)
		->find();
		return $data;
	}

}