<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>专业管理</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	<style type="text/css">
		.site-table tbody tr td {text-align: center;}
		.site-table tbody tr td .layui-btn+.layui-btn{margin-left: 0px;}
		.admin-table-page {position: fixed;z-index: 19940201;bottom: 0;width: 100%;background-color: #eee;border-bottom: 1px solid #ddd;left: 0px;}
		.admin-table-page .page{padding-left:20px;}
		.admin-table-page .page .layui-laypage {margin: 6px 0 0 0;}
		.table-hover tbody tr:hover{ background-color: #EEEEEE; }
		.layui-input {
			height: 30px;
			width: 140px;
		}
	</style>
</head>
<body>

	<div class="admin-main">

			<blockquote class="layui-elem-quote">
				<a href="javascript:;" class="layui-btn layui-btn-small add">
					<i class="layui-icon">&#xe608;</i> 添加专业
				</a>
				<form class="layui-form" style="display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
					<div class="layui-input-inline" style="">
			        	<select name=""  placeholder="Select Task Type" id="demo-col" lay-filter="collegeSS">
			        	<option value="">选择学院</option>
			         	<?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" <?php if(($col["id"]) == $college_id): ?>selected="selected"<?php endif; ?> ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
			        	</select> 
			        </div>

					<div class="layui-input-block" style="display: inline-block;margin-left: 30px; min-height: inherit; vertical-align: bottom;">
						<div class="layui-form-pane">
						<label class="layui-form-label" style="padding: 4px 15px;">时间范围</label>
						<div class="layui-input-inline">
					      <input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" style="height:30px; line-height:30px;"  value="<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>" readonly="true">
					    </div>
					    <div class="layui-input-inline">
					      <input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" style="height:30px; line-height:30px;" value="<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>" readonly="true">
					    </div>
						</div>
					</div>
					<div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
						<input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
					</div>
					<a href="javascript:;" class="layui-btn layui-btn-small" id="search">
						<i class="layui-icon">&#xe615;</i> 搜索
					</a>
					<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
						<i class="layui-icon">&#xe615;</i> 查看全部
					</a>
				</form>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>专业列表</legend>
				<div class="layui-field-box">
					<table class="site-table table-hover">
						<thead>
							<tr>
								<th>专业编号</th>
								<th>所属学院</th>
								<th>专业名称</th>
								<th>创建时间</th>
								<th>备注</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($majorList)): $i = 0; $__LIST__ = $majorList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["id"]); ?></td>
								<td><?php echo ($vo["college_name"]); ?></td>
								<td><?php echo ($vo["name"]); ?></td>
								<td><?php echo ($vo["create_date"]); ?></td>
								<td><?php echo ((isset($vo["comment"]) && ($vo["comment"] !== ""))?($vo["comment"]):'无'); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
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
	        <script src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var editurl = "<?php echo U('Home/MajorMgr/editMajor');?>";
		var listurl = "<?php echo U('Home/MajorMgr/majorList');?>";
		var deleteurl = "<?php echo U('Home/MajorMgr/deleteMajor');?>";
		var rooturl = "/";
		var pages = <?php echo ($pages); ?>;
		var curr = <?php echo ($requestPage); ?>;
		var keyword = "<?php echo ($keyword); ?>";
		var beginDate = "<?php echo ($beginDate); ?>";
		var endDate = "<?php echo ($endDate); ?>";
	</script>
	<script type="text/javascript" src="/Public/static/js/majorList.js"></script>
	
</body>
</html>