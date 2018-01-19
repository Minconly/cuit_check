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
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
    <style>
        .layui-form-select{
            width: 80%;     //调整select的宽度
        }
    </style>
</head>
<body>
<div style="margin: 15px;">

    <form class="layui-form">

        <input type="hidden" name="ruleid" value="<?php echo ($ruleid); ?>">
        <input type="hidden" name="id" value="<?php echo ((isset($ruleedit["id"]) && ($ruleedit["id"] !== ""))?($ruleedit["id"]):''); ?>">

        <div class="layui-form-item">
            <label class="layui-form-label">权限名称</label>
            <div class="layui-input-block">
                <input type="text" name="title" id="title" lay-verify="required" autocomplete="off" placeholder="" class="layui-input" style="width:80%;" value="<?php echo ((isset($ruleedit["title"]) && ($ruleedit["title"] !== ""))?($ruleedit["title"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">权限</label>
            <div class="layui-input-block">
                <input type="text" name="name" id="name" autocomplete="off" placeholder="" class="layui-input" style="width:80%;" value="<?php echo ((isset($ruleedit["name"]) && ($ruleedit["name"] !== ""))?($ruleedit["name"]):''); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">是否启用</label>
            <div class="layui-input-block">
                <?php if(($ruleedit["status"]) == "1"): ?><input name="status" id="status" lay-skin="switch" checked lay-text="启用|禁用" type="checkbox">
                    <?php else: ?>
                    <input name="status" lay-skin="switch" lay-text="启用|禁用" type="checkbox"><?php endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo1">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
 var editurl = "";
  if ('<?php echo ($type); ?>'==='updaterule'){
    editurl = "<?php echo U('Home/SysuserRule/updateSysRule');?>";
  }else if('<?php echo ($type); ?>' === 'addrule'){
    editurl = "<?php echo U('Home/SysuserRule/addSysRule');?>";
  }else{
    editurl = "<?php echo U('Home/SysuserRule/addsonRule');?>";
  }
var rooturl = "/";
</script>
</body>
<script type="text/javascript">
    layui.use(['form'], function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery;

    //监听提交
    form.on('submit(demo1)', function(data) {
        //修改状态所对应的值
        if(data.field.status == 'on'){
            data.field.status = "1";
        }else {
            data.field.status = "0";
        }

        layer.confirm('确认提交？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            layer.msg('已提交！', {icon: 1});
            $.ajax({
                url:editurl,
                type:"POST",
                data:data.field,
                success:function(data2)
                {
                    if(data2.success){
                        layer.msg('保存成功!', {time: 1000,icon: 1},function(){
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        });
                    }else {
                        layer.msg(data2.msg, {time: 1000,icon: 2});
                    }
                },
                error: function(){
                    layer.msg('请求服务器超时', {time: 1000,icon: 2});
                }
            });
            return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        }, function(){

        });

        return false;
    });
});
</script>
</html>