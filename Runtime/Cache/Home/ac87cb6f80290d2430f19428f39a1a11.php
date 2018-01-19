<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>学生管理</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	<link rel="stylesheet" href="/Public/static/css/collegeList.css" />
	<style type="text/css">
		.searchLi {
			width: 140px;
			height:30px; 
			line-height:30px;
			border: 1px solid #e6e6e6;
			background-color: #fff;
			border-radius: 2px;

		}
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
				<i class="layui-icon">&#xe608;</i> 添加学生
			</a>
			<a href="javascript:;" class="layui-btn layui-btn-small batchadd">
				<i class="layui-icon">&#xe60a;</i> 批量导入
			</a>	
			<form class="layui-form" style="display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
				<div class="layui-input-inline" style="">
		        	<select name=""  placeholder="Select Task Type" id="demo-col" lay-filter="collegeSS">
		        	<option value="">选择学院</option>
		         	<?php if(is_array($college_list)): $i = 0; $__LIST__ = $college_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" <?php if(($col["id"]) == $stuArray['college_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		        	</select> 
		        </div>
		        <div class="layui-input-inline" style="padding-left: 4px;">
					<select name="majorSS" id="demo-maj">
					<option value="">请选择专业</option>
					<?php if(is_array($major_list)): $i = 0; $__LIST__ = $major_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$maj): $mod = ($i % 2 );++$i;?><option value="<?php echo ($maj["id"]); ?>" <?php if(($maj["id"]) == $stuArray['major_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($maj["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select> 		
				</div>
		       
		      
		        <div class="layui-input-inline" style="padding-left: 4px;">
		        	<select name="" lay-verify="" id="demo-gra">
		         	<option value="">请选择年级</option>
		         	<?php if(is_array($grade_list)): $i = 0; $__LIST__ = $grade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gra): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gra["id"]); ?>" <?php if(($gra["id"]) == $stuArray['grade_id']): ?>selected="selected"<?php endif; ?>><?php echo ($gra["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		        	</select> 
		        </div>  
		          <div class="layui-input-inline" style="padding-left: 4px;">
		        	<select name="classSS" lay-verify="" id="demo-cla">
		         	<option value="">请选择班级</option>
		         	<?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cla): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cla["id"]); ?>" <?php if(($cla["id"]) == $stuArray['class_id']): ?>selected="selected"<?php endif; ?>><?php echo ($cla["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		        	</select> 
		        </div>
		    
			</form>		         
				
				<div class="layui-input-block" style="margin-left:3px;display: inline-block; min-height: inherit;vertical-align: bottom;">
					<input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;width: 130px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
				</div>
				
				<a href="javascript:;" class="layui-btn layui-btn-small" id="search">
					<i class="layui-icon">&#xe615;</i> 搜索
				</a>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll" style="margin-left: 2px;">
					<i class="layui-icon">&#xe615;</i> 查看全部
				</a>
							
		</blockquote>
		<fieldset class="layui-elem-field">
			<legend>学生列表</legend>
			<div class="layui-field-box">
				<table class="site-table table-hover">
					<thead>
						<tr>
							<th>学号</th>
							<th>姓名</th>
							<th>性别</th>
							<th>学院</th>
							<th>专业</th>
							<th>年级</th>
							<th>班级</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<?php if(is_array($studentList)): $i = 0; $__LIST__ = $studentList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>	
							<tr>
							<td><?php echo ($vo["account"]); ?></td>
							<td><?php echo ($vo["stu_name"]); ?></td>
							<td><?php if($vo['sex'] == 0): ?>女<?php endif; ?>
							<?php if($vo['sex'] == 1): ?>男<?php endif; ?>
							</td>
							<td><?php echo ($vo["col_name"]); ?></td>
							<td><?php echo ($vo["maj_name"]); ?></td>
							<td><?php echo ($vo["gra_name"]); ?></td>
							<td><?php echo ($vo["cla_name"]); ?></td>
							<td><?php if($vo['stu_status'] == 0): ?><span class="layui-btn layui-btn-danger layui-btn-mini">禁用</span><?php endif; ?>
							<?php if($vo['stu_status'] == 1): ?><span class="layui-btn layui-btn-normal layui-btn-mini">激活</span><?php endif; ?></td>
							<td>
								<a href="javascript:;" data-id="<?php echo ($vo["stu_id"]); ?>" class="layui-btn layui-btn-mini detail">详情</a>
								<a href="javascript:;" data-id="<?php echo ($vo["stu_id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
								<a href="javascript:;" data-id="<?php echo ($vo["stu_id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								<a href="javascript:;" data-id="<?php echo ($vo["stu_id"]); ?>" data-opt="" class="layui-btn layui-btn-normal layui-btn-mini resetps">重置密码</a>
							</td>
							</tr>	
					</tbody><?php endforeach; endif; else: echo "" ;endif; ?>
				</table>
			</div>
		</fieldset>
		</div>
			<div class="" style="margin-left: 38%;position: static;bottom: 0;">
			<div id="page" ></div>
			</div>
		</div>
	        <script src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		
		var listurl = "<?php echo U('Home/StudentMgr/studentList');?>";
		var addurl = "<?php echo U('Home/StudentMgr/addStudent');?>";
		var editurl = "<?php echo U('Home/StudentMgr/editStudent');?>";
		var deleteurl = "<?php echo U('Home/StudentMgr/delStudent');?>";
		var resetpsurl = "<?php echo U('Home/StudentMgr/resetPs');?>";
		var batchurl = "<?php echo U('Home/StudentMgr/importStudentHtml');?>";
		var detailurl = "<?php echo U('Home/StudentMgr/detailStudent');?>";
		var linkselecturl = "<?php echo U('Home/StudentMgr/linkSelect');?>";
		var pages = "<?php echo ($pages); ?>";
		var curr = "<?php echo ($requestPage); ?>";
		var dcol = "<?php echo ($stuArray['college_id']); ?>";
		var dmaj = "<?php echo ($stuArray['major_id']); ?>";
		var dgra = "<?php echo ($stuArray['grade_id']); ?>";
		var dcla = "<?php echo ($stuArray['class_id']); ?>";
		var keyword = "<?php echo ($keyword); ?>";
		var rooturl = "/";
	</script>
	<script type="text/javascript" src="/Public/static/js/studentMgr.js"></script>
	<script type="text/javascript">
		layui.config({
	base: rooturl+'Public/static/js/'
	}).use(['layer','laypage','form'], function() {
		laypage = layui.laypage;
			var form = layui.form(),
					$ = layui.jquery;
		laypage({
		cont: 'page',
		pages: pages,
		groups: 5,
		skip: true, //是否开启跳页
		curr: curr,
		jump: function(obj, first) {
			var curr = obj.curr;
			var searchword = "&keyword="+keyword+"&dcol="+dcol+"&dmaj="+dmaj+"&dgra="+dgra+"&dcla="+dcla;
			if(!first) {
				window.location.href = listurl+"?requestPage="+curr+searchword;
			}
		}
	});
			//联动学院专业班级
//			form.on('select(collegeSS)',function() {
//				var dept_id = $('#demo-col').val();
//				$.ajax({
//					url: linkselecturl,
//					type: 'POST',
//					data: {'dept_id': dept_id},
//					//contentType: "application/json; charset=utf-8",
//					dataTpye: 'json',
//					success: function (data) {
//						$('form').find('select[name=majorSS]').html(data.major);
//						$('form').find('select[name=classSS]').html(data.class);
//						form.render('select');
//					}
//				});
//			});
//			$("select [id='demo-maj'] option").each(function() {
//				if($(this).value == dmaj) {
//					console.log(dmaj);
//					$(this).attr("selected","selected");
//				}
//			});
	});
	</script>
</body>
</html>