<?php
	/**
	 * 公共的方法类
	 */

use Predis\Client;
use Predis\Autoloader;

/**
	 * 调试时更好的打印数据的函数
	 * @Author   taolei
	 * @DateTime 2017-02-16
	 * @param    [array]     $data [需要打印的数组]
	 * @return   [String]         返回打印的拼接字符串
	 */
	function p($data){
	    // 定义样式
	    $str='<pre style="display: block;padding: 9.5px;margin: 44px 0 0 0;font-size: 13px;line-height: 1.42857;color: #333;word-break: break-all;word-wrap: break-word;background-color: #F5F5F5;border: 1px solid #CCC;border-radius: 4px;">';
	    // 如果是boolean或者null直接显示文字；否则print
	    if (is_bool($data)) {
	        $show_data=$data ? 'true' : 'false';
	    }elseif (is_null($data)) {
	        $show_data='null';
	    }else{
	        $show_data=print_r($data,true);
	    }
	    $str.=$show_data;
	    $str.='</pre>';
	    echo $str;
	}
	//获取用户账号
	function getCurrentUser(){
		return session("account");
	}
	//根据session获取该用户属于哪个学院
	function getdeptId(){
		$account=session("account");
		$map['account']=array('eq',$account);
		$map['del_flag']=array('eq',1);
		$data=M('sysuser')->field('dept_id')->where($map)->find();
		// dump($data['dept_id']);die();
		$isset=$data['dept_id'];
		// dump($isset);die();
		//判断如果是超级管理员
		if(is_null($isset)){
			$data2=0;
		}else{
			$data2=$data['dept_id'];
		}
		// dump($data);die();
		return $data2;
	}
	//根据学院id获取该学院学科信息
	function getcourse($dept_id){
		// dump($id);die();
		$map['college_id']=array('eq',$dept_id);
		$map['del_flag']=array('eq',1);
		$data=M('course')->field('id,name')->where($map)->select();
		return $data;
	}
	//根据学院id获取课程信息
	function getlession($college_id){
		$map['college_id']=array('eq',$college_id);
		$map['del_flag']=array('eq',1);
		$data=M('lession')->field('id,name')->where($map)->select();
		return $data;
	}
	//根据学院id获取学院名称
	function getcollege($id){
		if($id!=0){
			$map['id']=array('eq',$id);
		}
		$map['del_flag']=array('eq',1);
		$data=M('college')->field('id,name')->where($map)->select();
		// dump($data);die();
		return $data;
	}
	/**
	 * 添加日志的公共方法
	 * @Author   taolei
	 * @DateTime 2017-02-16
	 * @param    [array]     $log [传入的日志记录数组]
	 */
	/**
	 * 调用方法  addlog(__ACTION__);
	 */
	function addLog($handMethod){
	    $data = array(
	        "user_account" => getCurrentUser(),
	        "handlemethod" =>  $handMethod,
	        "createip"   => get_client_ip(),
	    );
	    D('Log')->addLog($data);
	}

	/**
	 * @function 获取对应字典字段的值和标签
	 * @Author   许加明
	 * @DateTime 2017-3-2 16:14:04
	 * @param mixed $type 标签的类型【数组】【字符串】 ,mixed $value 标签的值【数组】【字符串】
	 * @return array 一般取array[0]
	 */
	function dict($type='', $value='')
	{
		$data = null;
		$dict = M('Dict');
		if('' === $type && '' === $value){					//都为空时查询全部标签
			$data = $dict->where('del_flag=1')->select();
		}elseif($type!=='' && $value === ''){				//只有$type存在时查询符合的type标签
			$map['type'] = array('in',$type);
			$map['del_flag']=array('eq',1);
			$data = $dict->where($map)->select();
		}elseif($type!=='' && $value !== ''){				//都不为空时查询一种$type类型,且符合$value值的标签
			$map['type'] = $type;
			$map['value'] = array('in',$value);
			$data = $dict->where($map)->select();
		}else{

		}
		return $data;
	}

	/**
	 * @function 输出xls文件
	 * @Author   许加明
	 * @DateTime 2017-4-2 09:30:10
	 * @param
	 * 		$title string 输出的文件名
	 * 		$cellName  array 类似 array('A','B','C');
	 * 		$cellHeader array 类似 array('章节编号','所属学科','章节名称');
	 * 		$data='' array[1...i][array] 二维数组 数据类型一般为通过select()方法获得
	 * @waring 注意$cellName $cellHeader数组大小一致 $data 的列数也与 $cellName一致
	 * @return  execl文件
	 */
	function outputExcel($title,$cellName,$cellHeader,$data=''){
	//导入Excel
	Vendor("PHPExcel.PHPExcel");
	Vendor("PHPExcel.PHPExcel.IOFactory");
	$objExcel = new \PHPExcel();

//        //设置文件名
//        $title = '知识点导入模板';

	//设置基本信息
	$objExcel->getProperties()->setCreator("Chengdu University of Information Technology")
		->setLastModifiedBy("Chengdu University of Information Technology")
		->setTitle("Chengdu University of Information Technology")
		->setSubject("knowledge list")
		->setDescription("")
		->setKeywords("knowledge list")
		->setCategory("");

	$objSheet = $objExcel->getActiveSheet();


	//设置文件默认水平垂直居中
	$objSheet->getDefaultStyle()->getAlignment()
		->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER)
		->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	//设置每列宽度
	foreach($cellName as $value){
		$objSheet->getColumnDimension($value)->setWidth(16);
	}



	$i = 0;
	//填充表头
	foreach($cellHeader as $value){
		$objSheet->setCellValue($cellName[$i].'1',$cellHeader[$i]);
		$i+=1;
	}

	//添加数据
	$j = 2;
	if($data != ''){
		foreach($data as $item => $value){
			$i2 = 0;
			foreach($value as $key => $value2){
				$objSheet->setCellValue($cellName[$i2].$j,$value2);
				$i2++;
			}
			$j++;
		}
	}

	$objWriter = new \PHPExcel_Writer_Excel2007($objExcel);
	//刷新缓冲
	ob_end_clean();
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
	header("Content-Type:application/force-download");
	header("Content-Type:application/vnd.ms-execl");
	header("Content-Type:application/octet-stream");
	header("Content-Type:application/download");
	//生成的文件名字
	//attachment新窗口打印inline本窗口打印
	header('Content-Disposition:attachment;filename='.$title.'.xlsx');
	header("Content-Transfer-Encoding:binary");
	//文件通过浏览器下载
	$objWriter->save('php://output');
        exit(); //跳转结束，否则文件会报错

}

	/**
	 * @function 从excel文件获取数据
	 * @Author   许加明
	 * @DateTime 2017-4-2 22:35:45
	 * @param
	 * 		$filename string 文件名称（包括路劲） 列如： './Uploads/student_import/2017-03-15/1489583713309.xls'
	 * 		$exts string 文件后缀 列如：xls
	 * 		$dataKey array 返回数据对应的键 如：array('id','name','dept_id','comment','del_flag');
	 * @return array[1...i][array]	与select()方法获得 其中一个元素 $key=>$value $key为$dataKey的元素
	 */
	function getDataFromUpExcel($filename,$exts,$dataKey){
	//定义列名
	$cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
	//引入类
	Vendor("PHPExcel.PHPExcel");
	//判断导入的Excel文件格式
	if($exts == 'xlsx') {
		$objReader = \PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
	}else if($exts == 'xls') {
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load($filename, $encode = 'utf-8');
	}
	//获取sheet，如果需要兼容多sheet，将这里改为遍历
	$sheet = $objPHPExcel->getSheet(0);
	//获得行数和列数
	$maxRow = $sheet->getHighestRow();
	$maxColumn = $sheet->getHighestColumn();

	$data = array();
	//从第二行开始取数据,将数据统一转化为String类型，便于处理
	for($i = 2;$i <= $maxRow;$i++){
		$temp = array();
		$j = 0;
		foreach($dataKey as $key){
			$temp[$key] = (String)$objPHPExcel->getActiveSheet()->getCell($cellName[$j] . $i)->getValue();
			$j++;
		}
		array_push($data,$temp);
	}

	return $data;
}

/**
 * @Function: 判断角色
 * @Author: xuanhao
 * @DateTime: ${DATE} ${TIME}
 * 角色判断：1--超级管理员；2--系统管理员；3--学院管理员；4--老师；
 * 如需增添角色，修改此处
 */
    function judgeRole() {
        $accInfo = session('accInfo');
        $roleNumber = $accInfo['role'];     //获取角色代号
        $role_auth = '';
        switch ($roleNumber) {
            case 1:
                $role_auth = 1;
                break;
            case 2:
                $role_auth = 2;
                break;
            case 3:
                $role_auth = 3;
                break;
            case 4:
                $role_auth = 4;
                break;
        }
        return $role_auth;

    }

if (!function_exists('cutl_post')) {
    /**
     * curl模拟post请求
     * @param $url
     * @param $data
     * @return mixed
     */
    function curl_post($url, $data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

    /**
     * 将数据按某个key分类
     * @param array $arr
     * @param string $key
     * @param bool $is_array
     * @return array
     */
    function  sortByKey($arr = array(),$key = 'add_admin',$is_array = false)
    {
        $ret = array();
        if (empty($arr)) return $ret;
        foreach ($arr as $k=>$v) {
            if ($is_array) {
                $ret[$v[$key]][] = $v;
            } else {
                $ret[$v[$key]] = $v;
            }
        }
        return $ret;
    }


#获取一定长度的盐字符串
if (!function_exists('cuit_salt')) {

    /**
     * 获取一定长度的盐字符串
     * @param int $len
     * @return bool|string
     */
    function cuit_salt($len = 4)
    {
        $rand = cuit_rand($len);//
        $rand_crypt = sha1($rand);
        $maxLen = strlen($rand_crypt);
        $start = intval($rand) % ( $maxLen - $len - 1 );//0-28
        return '' . substr($rand_crypt, $start, $len);
    }
}
#生成密码
if (!function_exists('cuit_password')) {
    /**
     * 生成密码
     * @param string $pwd 源密码
     * @param string $salt 盐
     * @return string
     */
    function cuit_password($pwd = '', $salt = '')
    {
        if (!$pwd) return '';
        $_pwd = md5($pwd);
        $_salt = $salt ? md5($salt) : '';
        if ($_salt) {
            $_pwd = md5($_pwd . $_salt);
        }
        return $_pwd;
    }
}

#生成一个长度一定的随机数字串（不足长度以0补位）
if (!function_exists('cuit_rand')) {

    /**
     * 生成一个长度一定的随机数字串（不足长度以0补位）
     * @param int $len
     * @return string
     */
    function cuit_rand($len = 4)
    {
        $len = intval($len);
        if ($len < 1) {
            $len = 4;
        } elseif ($len > 9) {
            $len = 9;
        }
        $max = str_repeat('9', $len);
        $rand = rand(0, intval($max));
        return sprintf('%0' . $len . 's', $rand);
    }
}



if(!function_exists('cuit_dateYW')){
    /**
     * 获取时间中的YW
     */
    function cuit_dateYW($time, &$info = array())
    {
        $time = intval($time);
        $date = date('Y-m-d', $time);  //当前日期
        $first = 1; //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
        $w = date('w', strtotime($date));  //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $Y = date('Y', strtotime("$date -" . ( $w ? $w - $first : 6 ) . ' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        $YW = $Y . date('W', $time);
        $info[ 'YW' ] = $YW;
        $info[ 'start_date' ] = date('Y-m-d', strtotime("$date -" . ( $w ? $w - $first : 6 ) . ' days')); //获取本周开始日期，如果$w是0，则表示周日，减去 6 天;
        $info[ 'end_date' ] = date('Y-m-d', strtotime("{$info['start_date']} +6 days"));
        $info[ 'start_time' ] = strtotime($info[ 'start_date' ] . ' 00:00:00');
        $info[ 'end_time' ] = strtotime($info[ 'end_date' ] . ' 23:59:59');
        return $YW;
    }
}

//数组按照某个字段排序
if (!function_exists('cuit_multisort')) {

    /**
     * 数组排序
     * @param $arrays
     * @param $sort_key
     * @param int $sort_order
     * @param int $sort_type
     * @return bool|array
     */
    function cuit_multisort($arrays, $sort_key, $sort_order = SORT_ASC, $sort_type = SORT_NUMERIC)
    {
        $key_arrays = [];
        if (is_array($arrays) && $arrays) {
            foreach ($arrays as $array) {
                if (isset($array[ $sort_key ])) {
                    $key_arrays[] = $array[ $sort_key ];
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
        array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
        return $arrays;
    }
}


#获取时间格式化
if (!function_exists('time_foramt_q')) {
    /**
     * @param int $timestamp
     * @return bool|string
     */
    function time_foramt_q($timestamp = 0)
    {
        $current_time = time();
        (int)$span = (int)$current_time - (int)$timestamp;
        if ($span < 60) {
            return "1分钟内";
        } else if ($span < 3600) {
            $m = floor($span / 60);
            return $m . "分钟前";
        } else if ($span < 24 * 3600) {
            $h = floor($span / 3600);
            return $h . '小时前';
        } else {
            if ($timestamp == 0) {
                return '';
            } else {
                if (date('Y-m-d', $timestamp) == date('Y-m-d', time())) {
                    return date('H:i', $timestamp);
                } elseif (date('Y', $timestamp) == date('Y', time())) {
                    return date('m-d', $timestamp);
                } else {
                    return date('Y-m-d H:i', $timestamp);
                }
            }
        }
    }
}


#剩余时间戳格式化
if (!function_exists('time_foramt_h')) {
    /**
     * 社区时间戳格式化
     * @param int $timestamp
     * @return bool|string
     */
    function time_foramt_h($timestamp = 0)
    {
        $current_time = time();
        (int)$span = (int)$timestamp - (int)$current_time;
        if ($span < 60) {
            return $span . "秒后";
        } else if ($span < 3600) {
            $m = floor($span / 60);
            return $m . "分钟后";
        } else if ($span < 24 * 3600) {
            $h = floor($span / 3600);
            return $h . '小时后';
        } else {
            if ($timestamp == 0) {
                return '';
            } else {
                if (date('Y-m-d', $timestamp) == date('Y-m-d', time())) {
                    return date('H:i', $timestamp);
                } elseif (date('Y', $timestamp) == date('Y', time())) {
                    return date('m-d', $timestamp);
                } else {
                    return date('Y-m-d H:i', $timestamp);
                }
            }
        }
    }
}

//清空某个目录下的文件
if(!function_exists('clearDir')){
    function clearDir($directory)
    {
        if (file_exists($directory)) {                        //判断被删除的目录是否存在
            if ($dir_handle = @opendir($directory)) {         //打开目录，返回目录指针
                while ($filename = readdir($dir_handle)) {   //循环遍历目录中的文件
                    if ($filename != "." && $filename != "..") {   //去掉.和..目录
                        $subFile = $directory . "/" . $filename;   //连接目录名
                        if (is_dir($subFile))                //如果遍历的是目录
                            clearDir($subFile);       //调用自己删除子目录
                        if (is_file($subFile))               //如果遍历的是文件
                            @unlink($subFile);            //直接删除文件
                    }
                }
                closedir($dir_handle);                      //关闭目录资源
            }
            @rmdir($directory);
        }
    }
}


//链接redis库2
if(!function_exists('connectRedis')){
        function connectRedis(){
            \Predis\Autoloader::register();
            $redis = new Client(C('PREDIS_OPTIONS_SYS'));
            return $redis;
        }
}
//获取锁
if(!function_exists('lock')){
    function lock($key, $expire=15){
        $redis = connectRedis();
        $isok = $redis->set($key, session_id(), 'EX', $expire,'NX');
        if(!$isok){
            $isok = ($redis->get($key) == session_id())?true:false;
        }
        return $isok?true:false;
    }
}
//释放锁
if(!function_exists('unlock')){
    function unlock($keys){
        $redis = connectRedis();
        if(is_array($keys)){
            $isdel = $redis->del($keys);
        }else if(is_string($keys)){
            $isdel = $redis->del(array($keys));
        }
        return $isdel?true:false;
    }

}

/**
获取 IP  地理位置
 * 淘宝IP接口
 * @Return: array
 * @example {"code":0,"data":{"ip":"182.150.27.61","country":"中国","area":"","region":"四川","city":"成都","county":"XX","isp":"电信","country_id":"CN","area_id":"","region_id":"510000","city_id":"510100","county_id":"xx","isp_id":"100017"}}
 */
if(!function_exists('getCity')) {
    function getCity($ip = '')
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ip = json_decode(file_get_contents($url));
        if ((string)$ip->code == '1') {
            return false;
        }
        $data = (array)$ip->data;
        return $data;
    }
}

/**
 * 获取
 */
if(!function_exists('get_ip')){
    function get_ip(){
        if ($_SERVER['HTTP_CLIENT_IP']) {
            $onlineip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif ($_SERVER['HTTP_X_FORWARDED_FOR']) {
            $onlineip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $onlineip = $_SERVER['REMOTE_ADDR'];
        }
        return $onlineip;
    }

}

//获得redis实例
if(!function_exists('getRedis')) {
    function getRedis($which = "PREDIS_OPTIONS_STUDENT")
    {
        //自动加载predis
        Autoloader::register();

        return new Client(C($which));
    }
}
