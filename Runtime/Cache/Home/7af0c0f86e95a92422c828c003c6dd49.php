<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>学科管理</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	<link rel="stylesheet" href="/Public/static/css/courseList.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/main.css">
</head>
<body>

	<div class="admin-main">
		<blockquote class="layui-elem-quote">
			<a href="javascript:;" class="layui-btn layui-btn-small add">
				<i class="layui-icon">&#xe608;</i> 添加学科
			</a>
		</blockquote>
		<?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="row">
				<div class="col-md-12">
					<section class="panel">
						<div class="panel-heading"><i class="fa fa-bell-o"></i>
							<?php echo ($vo["name"]); ?><span class="badge" style="background-color:#FF3333;"><?php echo (count($vo["course"])); ?></span>
							<a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe619;</i></a>
						</div>
						<div class="panel-body">
							<?php if(is_array($vo["course"])): $i = 0; $__LIST__ = $vo["course"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vc): $mod = ($i % 2 );++$i;?><div class="course-box" data-id="<?php echo ($vc["id"]); ?>">
									<div class="symbol">
										<i class="layui-icon" style="color: #fff;font-size: 3em;">&#xe60a;</i>
									</div>
									<div class="value">
										<span><?php echo ($vc["name"]); ?></span>
									</div>
								</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</section>
				</div>
			</div><?php endforeach; endif; else: echo "" ;endif; ?>


		<div>
		</div>
	</div>
	
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
	var rooturl = "/";
	var editurl = "<?php echo U('Home/CourseMgr/editCourse');?>";
</script>
<script type="text/javascript" src="/Public/static/js/courseList.js"></script>

</body>
</html>