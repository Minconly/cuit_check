<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all">
  <style type="text/css">
  .lable-box{
    font-family: '微软雅黑';
    font-size: 10;
  }
   .inputbox{
    padding: 15px;  
  }
</style>
</head>
<body>
  <div style="margin: 20px;">
<form class="layui-form">
<input type="hidden" name="id" value="<?php echo ((isset($class["id"]) && ($class["id"] !== ""))?($class["id"]):''); ?>">
    <div class="layui-form-item">
    <label class="layui-form-label">学院:</label>
    <div class="layui-input-block">
      <select name="college_id" lay-verify="required" lay-filter="collegebtn">
           <option value="" ></option>
        <?php if(is_array($collegelst)): $i = 0; $__LIST__ = $collegelst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>"<?php if($vo['name'] == $class['college_name']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">年级</label>
    <div class="layui-input-block">
      <select name="grade_id" lay-verify="required" lay-filter="aihao">
           <option value="" ></option>
     <?php if(is_array($gradelst)): $i = 0; $__LIST__ = $gradelst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['name'] == $class['grade_name']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
      </select>
      </select>
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label  lable-box">名称:</label>
    <div class="layui-input-block">
      <input type="text" name="name" required  lay-verify="classname" placeholder="请输入班级名称" autocomplete="off" class="layui-input"  style="width:300px;" value="<?php echo ((isset($class["name"]) && ($class["name"] !== ""))?($class["name"]):''); ?>">
   </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="class_btn">提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
</div>
<script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
  var editurl = "";
  if ('<?php echo ($type); ?>' == 'update'){
    editurl = "<?php echo U('Home/classMgr/updateclass');?>";
  }else if ('<?php echo ($type); ?>' == 'add_class'){
    editurl = "<?php echo U('Home/classMgr/add_class');?>";
  }
    var rooturl = "/";
</script>
<!--         <script src="/Public/static/layui/layui.js"></script> -->
</body>
</html>
<script type="text/javascript">
layui.use('form', function(){
  var form = layui.form(),
  $ = layui.jquery;
  form.render(); //更新全部
  form.render('select');
 //监听提交
  form.on('submit(class_btn)', function(data) {

    $.ajax({
      url: editurl,
      type: 'POST',
      data: data.field,
      error: function(request){
        layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success: function(data){
        if (data.success){
          layer.msg('提交成功', {
            time: 1000
          }, function(){
            parent.location.href="<?php echo U('Home/classMgr/classList');?>";
          });
        }else{
          layer.msg(data.msg, {
            time: 1000
          });
        }
      }
    });
    
    return false;
  });
});
</script>