<?php

namespace Student\Model;
use Think\Model;

/**
 * 试卷-问题表
 */
class PaperQuestionModel extends Model{


	/**
	 * 根据试卷id得到问题列表
	 * @function
	 * @AuthorPJY
	 * @DateTime  2017-07-22T09:53:03+0800
	 * @return    [type]                   [description]
	 */
	public function getQuestionList($paper_id){
		// 得到问题id
		$question = $this->field('question_id,value')->where(array('testpaper_id'=>$paper_id))->select();
		$question_info = [];
        $question_value = [];
        foreach ($question as $key => $value) {
            $answer_info = "";
			$info = M('question')->field(array('content','type','id'))->where(array('id'=>$value['question_id'],'del_flag'=>1))->select();
			$question_info[$key] = $info[0];
			$answer_info = M('answer')->field(array('content', 'id','is_true'))->where(array('question_id'=>$value['question_id'],'del_flag'=>1))->select();
			$question_info[$key]['answer'] = $answer_info;
            $question_value[$key] = $value['value'];
		}
		$data = array('question_info'=>$question_info,'question_value'=>$question_value);
		return $data;
	}

}