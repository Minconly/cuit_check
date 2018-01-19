<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>出题授权</title>
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
			<a href="#" class="layui-btn layui-btn-small add">
				<i class="layui-icon">&#xe608;</i> 添加教师权限
			</a>
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
				<legend>拥有权限的教师列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>id</th>
								<th>教师名称</th>
								<th>出题权限对应学院</th>
								<th>开始时间</th>
								<th>结束时间</th>
								<th>权限状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($testTeacherList)): $i = 0; $__LIST__ = $testTeacherList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["id"]); ?></td>
								<td><?php echo ($vo["teachername"]); ?></td>
								<td><?php echo ($vo["collegename"]); ?></td>
								<td><?php echo ($vo["start_time"]); ?></td>
								<td><?php echo ($vo["end_time"]); ?></td>
								<td>
									<?php if((strtotime($vo['end_time']) > $ptime ) AND (strtotime($vo['start_time']) < $ptime)): ?><span class="layui-btn layui-btn-mini">生效中</span>
									<?php elseif(strtotime($vo['start_time']) > $ptime): ?>
										<span class="layui-btn layui-btn-danger layui-btn-mini">未生效</span>
									<?php elseif(strtotime($vo['end_time']) < $ptime): ?>
										<span class="layui-btn layui-btn-primary layui-btn-mini">已过期</span><?php endif; ?>
								</td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
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
	var rooturl = "/";
	var pages = <?php echo ($pages); ?>;
	var curr = <?php echo ($requestPage); ?>;
	var keyword = "<?php echo ($keyword); ?>";
	var listurl = "<?php echo U('Home/TestTeacherPerMgr/testTeacherList');?>";
	var editurl = "<?php echo U('Home/TestTeacherPerMgr/editTestTeaPer');?>";
	var deleteurl = "<?php echo U('Home/TestTeacherPerMgr/deleteTestTeaPer');?>"
</script>
<script type="text/javascript" src="/Public/static/js/testTeacherList.js"></script>
</html>