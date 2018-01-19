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
</head>
<body>
	<div style="margin: 15px;">
		<form class="layui-form">
			<div class="layui-form-item">
				<label class="layui-form-label">学生账号：</label>
				<div class="layui-input-block" style="width:300px;">
				<input type="hidden" name="id" value="<?php echo ($stu_info['stu_id']); ?>">
				<input type="text" name="account" autocomplete="off" placeholder="请输入账号" class="layui-input" style="width:80%;" value="<?php echo ($stu_info['account']); ?>" disabled="false">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">学生姓名：</label>
				<div class="layui-input-block" style="width:300px;">
				<input type="text" name="name" autocomplete="off" placeholder="请输入姓名" class="layui-input" style="width:80%;" value="<?php echo ($stu_info["stu_name"]); ?>">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">学院：</label>
				<div class="layui-input-block" style="width: 240px;">
				<select name="dept_id" lay-filter="collegeS" id="college">
				<?php if(is_array($college_list)): $i = 0; $__LIST__ = $college_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><option value="<?php echo ($co['id']); ?>" <?php if(($co["id"]) == $stu_info['col_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($co["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 		
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">专业：</label>
				<div class="layui-input-block" style="width: 240px;">
				<select name="major_id">
				<?php if(is_array($major_list)): $i = 0; $__LIST__ = $major_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ma): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ma['id']); ?>" <?php if(($ma["id"]) == $stu_info['maj_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($ma["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 		
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">年级：</label>
				<div class="layui-input-block" style="width: 240px;">
				<select name="grade_id">
				<?php if(is_array($grade_list)): $i = 0; $__LIST__ = $grade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gr['id']); ?>" <?php if(($gr["id"]) == $stu_info['gra_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($gr["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 		
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">班级：</label>
				<div class="layui-input-block" style="width: 240px;">
				<select name="class_id">
				<?php if(is_array($class_list)): $i = 0; $__LIST__ = $class_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cs): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cs['id']); ?>" <?php if(($cs["id"]) == $stu_info['cla_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($cs["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select> 		
				</div>
			</div>
			<div class="layui-form-item">
	    		<label class="layui-form-label">性别：</label>
	    		<div class="layui-input-block">
		    	<?php if($stu_info['sex'] == 1): ?><input type="radio" name="sex" value="1" title="男" checked>
			 	<input type="radio" name="sex" value="0" title="女" ><?php endif; ?>
	      		<?php if($stu_info['sex'] == 0): ?><input type="radio" name="sex" value="1" title="男" >
		     	<input type="radio" name="sex" value="0" title="女" checked><?php endif; ?>		
	   			</div>
	  		</div>
	  		<div class="layui-form-item">
				<label class="layui-form-label">手机号：</label>
				<div class="layui-input-block" style="width:300px;">
				<input type="text" name="phone" autocomplete="off" placeholder="请输入手机号" class="layui-input" style="width:80%;" value="<?php echo ($stu_info['phone']); ?>">
				</div>
			</div>
	  		<div class="layui-form-item">
				<label class="layui-form-label">备注：</label>
				<div class="layui-input-block" style="width:300px;">
				<input type="text" name="remarks" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;" value="<?php echo ($stu_info['stu_remarks']); ?>">
				</div>
			</div>	
	  		<div class="layui-form-item">
   				<label class="layui-form-label">禁用：</label>
				<div class="layui-input-block">
				<input type="checkbox" name="status" lay-skin="switch" lay-text="开启|关闭" value="1" <?php if(($stu_info["stu_status"]) == "1"): ?>checked="checked"<?php endif; ?> >
				 </div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="editsave">保存</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</form>
	</div>
	        <script src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript">
		var edithandleurl = "<?php echo U('Home/StudentMgr/editStudentHandle');?>";
		var afterediturl = "<?php echo U('Home/StudentMgr/studentList');?>";
        var linkselecturl = "<?php echo U('Home/StudentMgr/linkSelect');?>";
		var rooturl = "/";
	</script>
	<script type="text/javascript" src="/Public/static/js/studentMgr.js"></script>
    <script>
        layui.use(['layer','form','jquery'],function() {
            var layer = layui.layer,
                    form = layui.form(),
                    $ = layui.jquery;
            form.render();
            //学院专业与班级联动选择
            form.on('select(collegeS)',function() {
                var dept_id = $('#college').val();
                $.ajax({
                    url: linkselecturl,
                    type: 'POST',
                    data: {'dept_id': dept_id},
                    dataTpye: 'json',
                    success: function (data) {
                        //console.log(data);
                        $('form').find('select[name=major_id]').html(data.major);
                        $('form').find('select[name=class_id]').html(data.class);
                        form.render('select');
                    }
                });
            });
        });
    </script>
</body>
</html>