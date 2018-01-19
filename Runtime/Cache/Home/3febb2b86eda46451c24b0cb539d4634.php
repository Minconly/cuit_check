<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<style type="text/css">
		.layui-form-label {
			width: 130px;
			text-align: center;
		}
		.btn_clo {
			margin-left: 28%;
		}
		.site-table thead tr th{
			text-align: center;
		}
		.site-table tbody tr td{
			text-align: center;
		}
		.detail-la {
			padding-left: 50px;
		}
		.detail-va {
			padding-left: 1px;
		}
		.head-imgpo img{
			width: 100px;
			height: 100px;
			border-radius: 5%;
		}
	</style>
</head>
<body>
	<div style="margin-left: 15px;margin-top: 15px;margin-right: 400px;float: left;" id="stu-info">		
			<div class="layui-form-item">
				<label class="layui-form-label">学生账号：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["account"]); ?></label>
				<label class="layui-form-label detail-la">学生姓名：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["stu_name"]); ?></label>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">学院：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["col_name"]); ?></label>
				<label class="layui-form-label detail-la">专业：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["maj_name"]); ?></label>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">年级：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["gra_name"]); ?></label>
				<label class="layui-form-label detail-la">班级：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["cla_name"]); ?></label>
			</div>
			<div class="layui-form-item">
	    		<label class="layui-form-label">性别：</label>
	    		<?php if($stu_info['sex'] == 1): ?><label class="layui-form-label detail-va">男</label><?php endif; ?>
	    		<?php if($stu_info['sex'] == 0): ?><label class="layui-form-label detail-va">女</label><?php endif; ?>
	    		<label class="layui-form-label detail-la">手机号：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["phone"]); ?></label>
	  		</div>
	  		<div class="layui-form-item">
				<label class="layui-form-label detail">email: </label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["email"]); ?></label>
				<label class="layui-form-label detail-la">创建时间：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["stu_create_date"]); ?></label>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">状态：</label>
				<?php if($stu_info['stu_status'] == 1): ?><label class="layui-form-label detail-va"><button class="layui-btn layui-btn-mini">激活</button></label><?php endif; ?>
	    		<?php if($stu_info['stu_status'] == 0): ?><label class="layui-form-label detail-va"><button class="layui-btn layui-btn-mini layui-btn-danger">禁用</button></label><?php endif; ?>
				<label class="layui-form-label detail-la">备注：</label>
				<label class="layui-form-label detail-va"><?php echo ($stu_info["stu_remarks"]); ?></label>
			</div>
	</div>
	<div class="head-imgpo" style="position: absolute;right:250px;top:30px;">
	<span class="" style="margin-right: 30px;margin-top: 30px;">头像:</span>
		<img src="/Uploads/UserPhoto/<?php echo ((isset($stu_info['photo']) && ($stu_info['photo'] !== ""))?($stu_info['photo']):'sysuser_2.jpeg'); ?>">
	</div>
	        <script src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var rooturl = "/";
	</script>
	<script type="text/javascript" src="/Public/static/js/studentMgr.js">
	</script>
</body>
</html>