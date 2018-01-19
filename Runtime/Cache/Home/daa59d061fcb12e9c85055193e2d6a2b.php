<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <style type="text/css">
        .layui-form-select{
            width: 80%;
        }
    </style>
</head>
<body>
<div style="margin: 15px;">
    <form class="layui-form" action="">
        <input type="hidden" name="id" lay-verify="" value="<?php echo ($paperInfo["id"]); ?>">
        <div class="layui-form-item">
            <label class="layui-form-label">试卷名</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="must" autocomplete="off" placeholder="请输入题库名称" class="layui-input" style="width:80%;" value="<?php echo ((isset($paperInfo["name"]) && ($paperInfo["name"] !== ""))?($paperInfo["name"]):''); ?>">
            </div>
        </div>

        <?php if($role == 1): ?><div class="layui-form-item">
                <label class="layui-form-label">选择学院</label>
                <div class="layui-input-block">
                    <select name="college_id" lay-verify="required" lay-filter="collegebtn">
                        <option value=""></option>
                        <?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $paperInfo["college_id"]): ?>selected="selected"<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div><?php endif; ?>
         <?php if($role == 1): ?><div class="layui-form-item">
            <label class="layui-form-label">所属课程</label>
            <div class="layui-input-block">
                <select name="lession_id" id="lession_id" lay-verify="required">
                    <option value="<?php echo ($paperInfo["lession_id"]); ?>" selected><?php echo ($paperInfo["lessionname"]); ?></option>
                </select>
            </div>
        </div>
        <?php else: ?>
        <div class="layui-form-item">
            <label class="layui-form-label">所属课程</label>
            <div class="layui-input-block">
                <select name="lession_id" id="lession_id" lay-verify="required">
                    <option value=""></option>
                 <?php if(is_array($lessionlist)): $i = 0; $__LIST__ = $lessionlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if($vo['name'] == $paperInfo['lessionname']): ?>selected<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div><?php endif; ?>
        <div class="layui-form-item">
            <label class="layui-form-label">类型</label>
            <div class="layui-input-block">
                <select name="type_id" lay-verify="required">
                    <option value=""></option>
                    <?php if(is_array($paperTypeList)): $i = 0; $__LIST__ = $paperTypeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["value"]); ?>" <?php if(($vo["value"]) == $paperInfo["type_id"]): ?>selected="selected"<?php endif; ?>><?php echo ($vo["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <input name="is_use" lay-verify="required" lay-skin="switch" lay-text="ON|OFF" type="checkbox" value="1" <?php if(($paperInfo["is_use"]) == "1"): ?>checked<?php endif; ?>>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block" >
                <input type="text" name="comment" lay-verify="" autocomplete="off" placeholder="请输入备注（可为空）" class="layui-input" style="width:80%;" value="<?php echo ((isset($paperInfo["comment"]) && ($paperInfo["comment"] !== ""))?($paperInfo["comment"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <a class="layui-btn" lay-submit="" lay-filter="save">保存</a>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    //    var rooturl = "/";
    //    var editurl = "";
    //    if ('<?php echo ($type); ?>' == 'update'){
    //        editurl = "<?php echo U('Home/TestDatabaseMgr/updateTestDB');?>";
    //    }else if ('<?php echo ($type); ?>' == 'add'){
    var updateurl = "<?php echo U('Home/ClassPapersCreateMgr/updatePaper');?>";
      var getlessionurl = "<?php echo U('Home/courseclassMgr/getlession');?>";
    //    }
</script>
<script>
    layui.use(['form','layer'], function() {
        var $ = layui.jquery,
            layer = layui.layer,
            form = layui.form();

        var index2;

        form.on('select(collegebtn)', function(data){
                $.getJSON(getlessionurl+"?college_id="+data.value, function(data){
                    var optionstring = "";
                    if(data.data!=""){
                    $.each(data.data, function(i,item){
                        optionstring += "<option value=\"" + item.id + "\" >" + item.name + "</option>";
                    });
                    $("#lession_id").html('<option value=""></option>' + optionstring);
                  }
                  else{
                    optionstring="<option value=\"" + 0 + "\" >" + "该学院下没有课程请重新选择!" + "</option>";
                    $("#lession_id").html('<option value=""></option>' + optionstring);
                  }
                    form.render('select');
                });
          });


        $('.del').on('click',function () {
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                layer.msg('ok', {icon: 1});
            }, function(){
                layer.msg('已取消', {
                    time: 1000, //1s后自动关闭
                });
            });
        });


        form.verify({
            must: function(value) {
                if(value.length < 5 || value == null) {
                    return '内容至少得5个字符啊';
                }
            }
        });

        form.on('submit(save)', function(data) {
            console.log(data.field);
            if(data.field.is_use === undefined){
                data.field['is_use']= 0;
            }
            layer.confirm('确认更改？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                $.ajax({
                    url:updateurl,
                    type:"POST",
                    data:data.field,
                    timeout: 2000,
                    beforeSend: function(){

                    },
                    success:function(data2)
                    {
                        if(data2.success){
                            // 关闭当前窗口
                            layer.msg(data2.msg, {time: 2000,icon: 1},function () {
                                var index = parent.layer.getFrameIndex(window.name);
                                parent.layer.close(index);
                            });
                        }else {
                            layer.msg(data2.msg, {time: 3000,icon: 2});
                        }
                    },
                    error: function(){
                        layer.msg('修改失败!', {icon: 2});
                    }
                });
            }, function(){
                layer.msg('已取消', {
                    time: 1000, //1s后自动关闭
                });
            });


            return false;
        });
    });
</script>
</body>
</html>