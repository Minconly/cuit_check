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
<div style="margin: 15px;">
    <form class="layui-form">
      <input type="hidden" name="id" value="<?php echo ((isset($lession["id"]) && ($lession["id"] !== ""))?($lession["id"]):''); ?>">
      <div class="layui-form-item">
        <label class="layui-form-label">课程名称：</label>
        <div class="layui-input-block" style="width:300px;">
        <input type="text" name="name" autocomplete="off" placeholder="请输入名称" class="layui-input" style="width:80%;" value="<?php echo ((isset($lession["name"]) && ($lession["name"] !== ""))?($lession["name"]):''); ?>">
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">所属学院：</label>
           <div class="layui-input-block" style="width: 240px;">
        <select name="college_id" id="college_id" class="college_id" lay-verify="" lay-filter="filter1">
            <option value="">选择学院</option>
           <?php if(is_array($collegelist)): $i = 0; $__LIST__ = $collegelist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><option value="<?php echo ($co['id']); ?>"<?php if($co['name'] == $lession['college_name']): ?>selected<?php endif; ?>><?php echo ($co["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>     
        </div>
      </div>
      <div class="layui-form-item">
        <label class="layui-form-label">所属学科：</label>
        <div class="layui-input-block" style="width: 240px;">
        <select name="course_id" id="course_id" class="course_id">
           <option value="<?php echo ($lession['course_id']); ?>"><?php echo ($lession["course_name"]); ?></option>
        </select>     
        </div>
      </div>
        <div class="layui-form-item">
        <label class="layui-form-label">课程备注：</label>
        <div class="layui-input-block" style="width:300px;">
        <input type="text" name="remarks" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;" value="<?php echo ((isset($lession["remarks"]) && ($lession["remarks"] !== ""))?($lession["remarks"]):''); ?>">
        </div>
      </div>  
      <div class="layui-form-item">
        <div class="layui-input-block">
          <button class="layui-btn" lay-submit="" lay-filter="lession_btn">提交</button>
          <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
      </div>
    </form>
  </div>
<script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript" src="/Public/static/js/layui-mz-min.js"></script>
<script type="text/javascript">
  var editurl = "";
  if ('<?php echo ($type); ?>' == 'update'){
    editurl = "<?php echo U('Home/lessionMgr/updatelession');?>";
  }else if ('<?php echo ($type); ?>' == 'add_lession'){
    editurl = "<?php echo U('Home/lessionMgr/add_lession');?>";
  }
    var rooturl = "/";
    var getcourse="<?php echo U('Home/lessionMgr/getcourselist');?>";
</script>
<!--         <script src="/Public/static/layui/layui.js"></script> -->
</body>
</html>
<script type="text/javascript">
layui.use(['form','laydate'], function(){
  var form = layui.form(),
   laydate = layui.laydate,
  $ = layui.jquery;
   layui.selMeltiple($);
  form.on('select(filter1)', function(data){
        $.getJSON(getcourse+"?college_id="+data.value, function(data){
            var optionstring = "";
            if(data.data!=""){
            $.each(data.data, function(i,item){
                optionstring += "<option value=\"" + item.id + "\" >" + item.name + "</option>";
            });
            $("#course_id").html('<option value=""></option>' + optionstring);
          }
          else{
            optionstring="<option value=\"" + 0 + "\" >" + "该学院下暂没有学科请重新选择!" + "</option>";
            $("#course_id").html('<option value=""></option>' + optionstring);
          }
            form.render('select');
        });
  });
  form.on('submit(lession_btn)', function(data) {
     // console.log(data.field);
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
            parent.location.href="<?php echo U('Home/lessionMgr/lessionList');?>";
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