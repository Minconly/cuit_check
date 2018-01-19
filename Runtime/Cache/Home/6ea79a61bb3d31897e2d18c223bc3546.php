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
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">


    <style>
        .layui-form-select{
            width: 80%;     /*//调整select的宽度*/
        }
    </style>
</head>
<body>
<div style="margin: 10px;">

    <form class="layui-form">


        <input type="hidden" name="id" value="<?php echo ((isset($data["id"]) && ($data["id"] !== ""))?($data["id"]):''); ?>">


        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="" class="layui-input" style="width:80%;"  value="<?php echo ((isset($data["name"]) && ($data["name"] !== ""))?($data["name"]):''); ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">所属章节</label>
            <div class="layui-input-block">

                <select name="chapter_id" lay-verify="require">
                    <option value="">请选择章节</option>

                    <?php if(is_array($chapterList)): $i = 0; $__LIST__ = $chapterList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $chapter_id): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
        </div>


        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <input type="text" name="comment" maxlength="25" lay-verify="title" autocomplete="off" placeholder="最多25字" class="layui-input" style="width:80%;" value="<?php echo ((isset($data["comment"]) && ($data["comment"] !== ""))?($data["comment"]):''); ?>">
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
</body>
        <script src="/Public/static/layui/layui.js"></script>

<script type="text/javascript">
    var updateurl = "<?php echo U('Home/KnowledgeMgr/updateKnowledge');?>";
    layui.use(['form','layer'],function () {
        var $ = layui.jquery,
            form = layui.form(),
            layer = layui.layer;
//        layui.render('select');
        //监听提交
        form.on('submit(demo1)', function(data) {

            layer.confirm('确认提交？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                layer.msg('已提交！', {icon: 1});
                $.ajax({
                    url:updateurl,
                    type:"POST",
                    data:data.field,
                    beforeSend: function(){
                        //
                    },
                    success:function(data2)
                    {
                        if(data2.success){
                            layer.msg(data2.msg, {time: 1000,icon: 1},function(){
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

        form.verify({
            title: function(value) {
                if(value.length > 25) {
                    return '内容最多25个字符';
                }
            }
        });


    });

</script>
</html>