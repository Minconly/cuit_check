<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh">

<head>
	<meta charset="utf-8">
	<title>个人中心修改界面</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css">
	<style>
		.site-demo-upload, .site-demo-upload img{
			width: 100px;
			height: 100px;
			border-radius: 5%;
		}
		.site-demo-upbar{
			width: 100px;
			margin: -18px 0 0 -50px;
		}
		.layui-box{
			margin-left: 10px;
			font-size: 8px;
		}
		.layui-upload-button{
			height: 30px;
			line-height: 30px;
		}
	</style>
</head>

<body>
<div style="margin: 15px;">
	<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
		<legend>个人信息</legend>
	</fieldset>

	<form class="layui-form " enctype="multipart/form-data" action="">
		<label class="layui-form-label">头像:</label>

		<!--<div class="site-demo-upload layui-input-inline" style="margin-bottom: 15px;margin-left: 15px">-->
		<!--<img id="LAY_demo_upload" src="http://layer.layui.com/images/tong.jpg">-->
		<!--<div class="site-demo-upbar">-->
		<!--<div class="layui-box layui-upload-button">-->
		<!--<input name="photo" class="layui-upload-file" id="uerPhoto" type="file">-->
		<!--<span class="layui-upload-icon">-->
		<!--<i class="layui-icon"></i>点击上传-->
		<!--</span>-->
		<!--</div>-->
		<!--</div>-->
		<!--</div>   以上为文件上传组件生成-->

		<div class="site-demo-upload layui-input-inline" style="margin-bottom: 15px;margin-left: 15px">
			<img id="LAY_demo_upload" src="<?php if(($info["photo"]) != ""): echo ($info["photo"]); else: ?>/Public/static/img/tong.jpg<?php endif; ?> "/>
			<div class="site-demo-upbar">
				<input name="photo" class="layui-upload-file" id="uerPhoto" type="file">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">账号:</label>
			<div class="layui-input-inline">
				<input type="text" name="title" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["account"]); ?>">
			</div>
			<label class="layui-form-label">名字:</label>
			<div class="layui-input-inline">
				<input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["name"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">邮箱:</label>
			<div class="layui-input-inline">
				<input type="text" name="email" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["email"]); ?>">
			</div>

			<label class="layui-form-label">角色:</label>
			<div class="layui-input-inline">
				<input type="text" name="role" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["role"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">所属学院:</label>
			<div class="layui-input-inline">
				<input type="text" name="dept_id" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["dept_id"]); ?>">
			</div>

			<label class="layui-form-label">电话:</label>
			<div class="layui-input-inline">
				<input type="text" name="phone" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled  value="<?php echo ($info["phone"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">性别:</label>
			<div class="layui-input-block">
				<?php if($info["sex"] == 1): ?><input type="radio" name="sex" value="1" title="男" checked="">
					<input type="radio" name="sex" value="0" title="女" disabled>

					<?php else: ?>
					<input type="radio" name="sex" value="1" title="男" disabled>
					<input type="radio" name="sex" value="0" title="女" checked=""><?php endif; ?>


			</div>

		</div>

		<div class="layui-form-item">

			<label class="layui-form-label"> </label>
			<div class="layui-input-inline">
				<div class="layui-btn" id="fixInfo" style=" ">修改信息</div>
			</div>

			<label class="layui-form-label"> </label>
			<div class="layui-input-inline">
				<div class="layui-btn" id="fixPass" style=" ">修改密码</div>
			</div>
		</div>
	</form>
</div>


<!--窗口模板一-->
<div class="window1" style="display: none">
	<form class="layui-form " method="post" action="">
		<input type="hidden" name="id" lay-verify="id" autocomplete="off" placeholder="" class="layui-input"  value="<?php echo ($info["id"]); ?>">
		<div class="layui-form-item">
			<label class="layui-form-label">账号:</label>
			<div class="layui-input-inline">
				<input type="text" name="account" lay-verify="title" autocomplete="off" placeholder="请输入内容" class="layui-input" disabled value="<?php echo ($info["account"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">名字:</label>
			<div class="layui-input-inline">
				<input type="text" name="name" lay-verify="required" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="<?php echo ($info["name"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">邮箱:</label>
			<div class="layui-input-inline">
				<input type="text" name="email" lay-verify="email" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="<?php echo ($info["email"]); ?>">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">电话:</label>
			<div class="layui-input-inline">
				<input type="text" name="phone" lay-verify="phone" autocomplete="off" placeholder="请输入内容" class="layui-input"   value="<?php echo ($info["phone"]); ?>">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">性别:</label>
			<div class="layui-input-block">
				<?php if($info["sex"] == 1): ?><input type="radio" name="sex" value="1" title="男" checked="">
					<input type="radio" name="sex" value="0" title="女" >
					<?php else: ?>
					<input type="radio" name="sex" value="1" title="男">
					<input type="radio" name="sex" value="0" title="女" checked=""><?php endif; ?>
			</div>

		</div>

		<div class="layui-form-item">
			<label class="layui-form-label"> </label>
			<div class="layui-input-inline">
				<div type="button" class="layui-btn" id="sureInfo" lay-submit="" lay-filter="submit1">提交</div>
			</div>
		</div>
	</form>
</div>



<!--窗口模板二-->
<div class="window2" style="display: none">
	<form class="layui-form " method="post" action="">
		<input type="hidden" name="id" lay-verify="id" autocomplete="off" placeholder="" class="layui-input"  value="<?php echo ($info["id"]); ?>">
		<div class="layui-form-item">
			<label class="layui-form-label">原密码:</label>
			<div class="layui-input-inline">
				<input type="password" name="oldPass" lay-verify="pass" autocomplete="off" placeholder="请输入内容" class="layui-input"  value=".....">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">新密码:</label>
			<div class="layui-input-inline">
				<input type="password" name="newPass" lay-verify="pass" id="first" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label">再次确认:</label>
			<div class="layui-input-inline">
				<input type="password" name="surePass" lay-verify="pass2" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="">
			</div>
		</div>
		<div class="layui-form-item">
			<label class="layui-form-label"></label>
			<div class="layui-input-inline">
				<div type="button" class="layui-btn" id="surePass" lay-submit="" lay-filter="submit2">提交</div>
			</div>
		</div>
	</form>
</div>

        <script src="/Public/static/layui/layui.js"></script>
<script>
	var updateUserUrl = "<?php echo U('Home/PersonCenter/userSaveInfo');?>";
	var updatePassUrl = "<?php echo U('Home/PersonCenter/userSavePass');?>";
	var updatePhotoUrl = "<?php echo U('Home/PersonCenter/updatePhoto');?>";
	var site = "http://cuitcheck.cn/";
	var rooturl = "/";
</script>
<script type="text/javascript" src="/Public/static/js/homePersonCenter.js"></script>
</body>
</html>