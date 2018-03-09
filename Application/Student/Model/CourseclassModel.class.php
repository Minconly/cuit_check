<?php 
/**
 * 行课班级管理的数据模型
 */
namespace Student\Model;
use Think\Model;
Class courseclassModel extends Model{

	/**
	 * 获取session中的用户
	 */
	public function getAccount(){
		$account = session('account');

		return $account;
	}


	//获得所有课程信息
    public function getAllCourseClassList(){
        $courseList = D("class_student")->getCourse(session('stu_account'));
        $data = [];
        foreach ($courseList as $value){
            $cci = $value['cci'];

            $rowData = $this //多表联合查询
            ->join('LEFT join kh_college ON kh_college.id = kh_courseclass.college_id
				LEFT join kh_grade ON kh_grade.id = kh_courseclass.grade_id
				LEFT join kh_lession ON kh_lession.id = kh_courseclass.lession_id
				LEFT join kh_sysuser ON kh_sysuser.id = kh_courseclass.teacher_id')
                ->field('kh_courseclass.id,
				 kh_courseclass.name,
				 kh_courseclass.start_time,
				 kh_courseclass.end_time,
		 		 kh_college.name as college_name,
		 	     kh_grade.name as grade_name,
		 	     kh_lession.id as lession_id,
		 	     kh_lession.name as lession_name,
				 kh_sysuser.name as teacher_name')
                ->where(array("kh_courseclass.id"=>$cci))
                ->find();
            array_push($data,$rowData);
        }

        return $data;
    }

	/**
	 * 获取当前时间
	 * 
	 */
	public function getTime(){
		return date('Y-m-d H:i:s', time());
	}



	public function getcourseClassId($id){

		$map['kh_courseclass.id'] = array('eq', $id);
		$map['kh_courseclass.del_flag'] = array('eq', '1');

		$data = M('courseclass') //多表联合查询
		->join('LEFT join kh_college ON kh_college.id = kh_courseclass.college_id
				LEFT join kh_grade ON kh_grade.id = kh_courseclass.grade_id
				LEFT join kh_lession ON kh_lession.id = kh_courseclass.lession_id
				LEFT join kh_sysuser ON kh_sysuser.id = kh_courseclass.teacher_id
			')
		->field('kh_courseclass.id,
				 kh_courseclass.name,
				 kh_courseclass.start_time,
				 kh_courseclass.end_time,
		 		 kh_college.name as college_name,
		 	     kh_grade.name as grade_name,
		 	     kh_lession.id as lession_id,
		 	     kh_lession.name as lession_name,
				 kh_sysuser.name as teacher_name
		 	     ')
		->where($map)
		->find();

		return $data;
	}
	/**
	 * 行课班级详细展示
	 */
	public function getallcourseclass($id,$keyword){
		$data1['courseclass_id'] = $id;
		// dump($map);die();
		// if ($keyword != ''){
		// 	$map['name'] = array('like', '%'.$keyword.'%');
		// }
		$map['account'] = M('class_student') 
		->field('account')
		->where($data1)
		->select();
		// p($map);die();
		$data=array();
		if(sizeof($map['account'])!=0){
		if ($keyword != ''){
			$map2['name'] = array('like', '%'.$keyword.'%');
			for($i=0;$i<sizeof($map['account']);++$i){ //遍历条件查询
				$where3=array($map['account'][$i],$map2,'_logic'=>'and');
				$rowdata=M('student')
				->field('account,name,sex')
				->where($where3)
				->find();
				if(sizeof($rowdata)!=0){
				array_push($data,$rowdata);
			}
			}
			// dump($data);die();
		}else{
			for($i=0;$i<sizeof($map['account']);++$i){ //遍历条件查询
				$rowdata=M('student')
				->field('account,name,sex')
				->where($map['account'][$i])
				->find();
				array_push($data,$rowdata);
			}
		}
		}
		// dump($data);die();
		return $data;

	}
	/**
	 * 获取添加班级时获取的数据
	 */
	
	public function getcollgelist(){

		$map['del_flag'] = array('eq', '1');
		$data = M('College')
		->field('id, name')
		->where($map)
		->select();

		return $data;
	}


}