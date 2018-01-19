<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统字典管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

</head>
<body>

<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small add">
            <i class="layui-icon">&#xe608;</i> 添加字典信息
        </a>
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
    </blockquote>



    <fieldset class="layui-elem-field">
        <legend>字典管理</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>类型</th>
                    <th>值</th>
                    <th>标签</th>
                    <th>描述</th>
                    <th>操作</th>
                   
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($DictList)): $i = 0; $__LIST__ = $DictList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["type"]); ?></td>
                        <td><?php echo ($vo["value"]); ?></td>
                        <td><?php echo ($vo["label"]); ?></td>
                        <td><?php echo ($vo["description"]); ?></td>
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
    var listurl = "<?php echo U('Home/Dictionary/DictionaryList');?>";
    var editurl = "<?php echo U('Home/Dictionary/editDict');?>";
    var updateurl = "<?php echo U('Home/Dictionary/updateDict');?>";
    var deleteurl = "<?php echo U('Home/Dictionary/deleteDict');?>";
    var addurl = "<?php echo U('Home/Dictionary/addDict');?>";
    var rooturl = "/";

    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";

    var keyword = "<?php echo ($keyword); ?>";
    var beginDate = "<?php echo ($beginDate); ?>";
    var endDate = "<?php echo ($endDate); ?>";
</script>
<script type="text/javascript" src="/Public/static/js/dictionary.js"></script>

</body>
</html>