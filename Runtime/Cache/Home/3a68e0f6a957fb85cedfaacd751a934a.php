<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统用户管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

</head>
<body>
<style type="text/css">
.layui-input-block {
    margin-left: 90px;
}

.layui-form-label {
    padding: 8px 0;
    text-align: center;
}

</style>

<div class="admin-main">

    <form class="layui-form">
            <?php if(($type) == "update"): ?><input type="hidden" name='id' class="id" value="<?php echo ((isset($info['id']) && ($info['id'] !== ""))?($info['id']):''); ?>"><?php endif; ?>

            <div class="layui-form-item">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    <input type="text" name="type" required lay-verify="required" placeholder="请输入类型" autocomplete="off" class="type layui-input" value="<?php echo ($info['type']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">值</label>
                <div class="layui-input-block">
                    <input type="text" name="value" required lay-verify="required" placeholder="请输入值" autocomplete="off" class="value layui-input" value="<?php echo ($info['value']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">标签</label>
                <div class="layui-input-block">
                    <input type="text" name="label" required lay-verify="required" placeholder="请输入类型" autocomplete="off" class="label layui-input" value="<?php echo ($info['label']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">描述</label>
                <div class="layui-input-block">
                    <input type="text" name="description" required lay-verify="required" placeholder="请输入类型" autocomplete="off" class="description layui-input" value="<?php echo ($info['description']); ?>">
                </div>
            </div>

            <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="editDict">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>


    </form>
    


</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var editurl = "";

    if ('<?php echo ($type); ?>' == 'update'){
        editurl = "<?php echo U('Home/Dictionary/updateDict');?>";
    }else{
        editurl = "<?php echo U('Home/Dictionary/addDict');?>";
    }
    var rooturl = "/";
</script>
<script type="text/javascript" src="/Public/static/js/editDict.js"></script>

</body>
</html>