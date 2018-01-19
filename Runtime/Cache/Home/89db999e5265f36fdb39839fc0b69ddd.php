<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>权限管理</title>
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
			<a href="javascript:;" class="layui-btn layui-btn-small add">
				<i class="layui-icon">&#xe608;</i> 添加学院
			</a>
			<div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
				<input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>" style="height:30px; line-height:30px;">
			</div>
			<a href="javascript:;" class="layui-btn layui-btn-small" id="search">
				<i class="layui-icon">&#xe615;</i> 搜索
			</a>
			<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
				<i class="layui-icon">&#xe615;</i> 查看全部
			</a>
		</blockquote>
		<fieldset class="layui-elem-field">
				<legend>拥有权限的学院列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>学院名称</th>
								<th>权限类型</th>
								<th>操作人</th>
								<th>操作时间</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($collegePerList)): $i = 0; $__LIST__ = $collegePerList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["name"]); if(($vo["college_id"]) == $create_id): ?>(题库创建学院，不可编辑)<?php endif; ?></td>
								<td><?php echo ($vo["label"]); ?></td>
								<td><?php echo ($vo["create_by"]); ?></td>
								<td><?php echo ($vo["create_date"]); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["college_id"]); ?>" class="layui-btn layui-btn-mini edit">修改权限</a>
									<a href="javascript:;" data-id="<?php echo ($vo["college_id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>

				</div>
			</fieldset>
	</div>
	
</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
	var rooturl = "/";
	var keyword = "<?php echo ($keyword); ?>";
	var testdb_id = "<?php echo ($testdb_id); ?>";
	var create_id = "<?php echo ($create_id); ?>";
	var editurl = "<?php echo U('Home/TestDBPermissionMgr/editTestDBPer');?>";
	var listurl = "<?php echo U('Home/TestDBPermissionMgr/detailTestDBPer');?>";
	var deleteurl = "<?php echo U('Home/TestDBPermissionMgr/deleteTestDBPer');?>";
</script>
<script type="text/javascript" src="/Public/static/js/detailTestDBPer.js"></script>
</html>