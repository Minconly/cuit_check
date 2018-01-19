<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>题库授权</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	<style type="text/css">
		.layui-unselect{
			height: 30px;
			line-height: 30px;
			width: 100px;
		}
		.site-table tbody tr td {text-align: center;}
		.site-table tbody tr td .layui-btn+.layui-btn{margin-left: 0px;}
		.admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;}
		.admin-table-page .page{padding-left:20px;}
		.admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
		.table-hover tbody tr:hover{ background-color: #EEEEEE; }
	</style>
</head>
<body>

	<div class="admin-main">

		<blockquote class="layui-elem-quote">
			<div class="layui-form layui-input-inline">
				
				<?php if(isset($collegeList)): ?><div class="layui-input-inline">
					<label class="layui-form-label" style="width: auto; padding: 5px 15px;">创建学院</label>
						<div class="layui-input-inline">
							<select name="college_id" lay-verify="" id="college_id" lay-filter="college">
								<option value=""></option>
								<?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["id"]) == $college_id): ?><option value="<?php echo ($vo["id"]); ?>" selected><?php echo ($vo["name"]); ?></option>
								    <?php else: ?>
								    	<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
				</div><?php endif; ?>

				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: auto; padding: 5px 15px;">所属学科</label>
						<div class="layui-input-inline">
							<select name="course_id" lay-verify="" id="course_id">
								<option value=""></option>
								<?php if(is_array($courseList)): $i = 0; $__LIST__ = $courseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(($vo["id"]) == $course_id): ?><option value="<?php echo ($vo["id"]); ?>" selected><?php echo ($vo["name"]); ?></option>
								    <?php else: ?>
								    	<option value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endif; endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
				</div>
				
				<div class="layui-input-inline">
					<label class="layui-form-label" style="width: auto; padding: 5px 15px;">题库状态</label>
						<div class="layui-input-inline">
							<select name="status" lay-verify="" id="status">
								<option value=""></option>
								<?php switch($status): case "1": ?><option value="1" selected>公开</option>
										<option value="0">未公开</option><?php break;?>
								    <?php case "0": ?><option value="1">公开</option>
										<option value="0" selected>未公开</option><?php break;?>
									<?php default: ?>
										<option value="1">公开</option>
										<option value="0">未公开</option><?php endswitch;?>
							</select>
						</div>
				</div>
			</div>
			<div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
				<input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" value="<?php echo ($keyword); ?>" style="height:30px; line-height:30px;">
			</div>
			<a href="javascript:;" class="layui-btn layui-btn-small" id="search">
				<i class="layui-icon">&#xe615;</i> 搜索
			</a>
			<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
				<i class="layui-icon">&#xe615;</i> 查看全部
			</a>
		</blockquote>
		<fieldset class="layui-elem-field">
				<legend>题库列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>题库编号</th>
								<th>题库名称</th>
								<th>所属学科</th>
								<th>创建学院</th>
								<th>创建时间</th>
								<th>题库状态</th>
								<th>备注</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($testDBList)): $i = 0; $__LIST__ = $testDBList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["id"]); ?></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ($vo["coursename"]); ?></td>
								<td><?php echo ($vo["collegename"]); ?></td>
								<td><?php echo ($vo["create_date"]); ?></td>
								<td>
									<?php if(($vo["status"]) == "1"): ?><span class="layui-btn layui-btn-mini" style="cursor:auto; ">公开</span>
									<?php else: ?>
										<span class="layui-btn layui-btn-danger layui-btn-mini" style="cursor:auto; ">未公开</span><?php endif; ?>
								</td>
								<td><?php echo ((isset($vo["comment"]) && ($vo["comment"] !== ""))?($vo["comment"]):'无'); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-normal layui-btn-mini detail">管理权限</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>

				</div>
			</fieldset>

		<div class="admin-table-page">
			<div id="page" class="page">
			</div>
		</div>

	</div>
	
</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
	var listurl = "<?php echo U('Home/TestDBPermissionMgr/testDBList');?>";
	var rooturl = "/";
	var detailurl = "<?php echo U('Home/TestDBPermissionMgr/detailTestDBPer');?>";
	var getCourse = "<?php echo U('Home/TestDBPermissionMgr/getCourse');?>";
	var pages = <?php echo ($pages); ?>;
	var curr = <?php echo ($requestPage); ?>;
	var keyword = "<?php echo ($keyword); ?>";
	var course_id = "<?php echo ($course_id); ?>";
	var college_id = "<?php echo ($college_id); ?>";
	var status = "<?php echo ($status); ?>";
</script>
<script type="text/javascript" src="/Public/static/js/testDBPermissionList.js"></script>
</html>