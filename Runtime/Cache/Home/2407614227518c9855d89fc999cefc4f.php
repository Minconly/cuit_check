<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>菜单新增</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
</head>
<body>
<div style="margin: 15px;">
    <form class="layui-form">
        <input type="hidden" name="parent_id" value="<?php echo ((isset($fid) && ($fid !== ""))?($fid):''); ?>">
        <?php if($fid == ''): else: ?> 
            <div class="layui-form-item">
            <label class="layui-form-label">上级菜单</label>
            <div class="layui-input-block">
                <a class="layui-input" style="width:80%;"><?php echo ($fname); ?></a>
            </div>
        </div><?php endif; ?>
        <div class="layui-form-item">
            <label class="layui-form-label">菜单名称</label>
            <div class="layui-input-block">
                <input type="text" name="name"  lay-verify="required" autocomplete="off" placeholder="请输入菜单名称" class="layui-input" style="width:80%;">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">URL</label>
            <div class="layui-input-block">
                <input type="text" name="url"   lay-verify="required" autocomplete="off" placeholder="请输入菜单URL" class="layui-input" style="width:80%;">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">icon</label>
            <div class="layui-input-block">
                <input type="text" name="icon" lay-verify="required" autocomplete="off" placeholder="输入图标代码" class="layui-input" style="width:80%;" >
            </div>
        </div>
         <div class="layui-form-item">
            <label class="layui-form-label">sort</label>
            <div class="layui-input-block">
                <input type="number" name="sort" lay-verify="required" autocomplete="off" placeholder="请输入数字" class="layui-input" style="width:80%;" >
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="saveMenu">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
</div>
        <script src="/Public/static/layui/layui.js"></script>
</body>
<script type="text/javascript">
    layui.use(['form'], function() {
    var form = layui.form(),
        layer = layui.layer,
        $ = layui.jquery;

    var URL  = {
        add : function(){
            return "<?php echo U('Home/System/addMenu');?>";
        },
    }
    form.on('submit(saveMenu)', function(data) {
        layer.confirm('确认提交？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            $.ajax({
                url:URL.add(),
                type:"POST",
                data:data.field,
                success:function(rec){
                    if(!rec.status){
                        layer.msg('保存成功!', {time: 1000,icon: 1},function(){
                            var index = parent.layer.getFrameIndex(window.name);
                            parent.layer.close(index);
                        });
                    }else {
                        layer.msg(rec.msg, {time: 1000,icon: 2});
                    }
                },
                error: function(){
                    layer.msg('请求超时', {time: 1000,icon: 2});
                }
            });
            return false; 
        });
        return false;
    });
});
</script>
</html>