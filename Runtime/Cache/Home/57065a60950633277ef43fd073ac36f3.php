<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>权限管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

</head>
<body>

<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small add">
            <i class="layui-icon">&#xe608;</i> 添加父权限
        </a>
        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
            <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;">
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
            <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>权限列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th width="20%;">权限名称</th>
                    <th width="40%;">权限</th>
                    <th width="20%">状态</th>
                    <th width="20%">操作</th>
                </tr>
                </thead>
                <tbody>
                  <?php if(is_array($rulelst)): foreach($rulelst as $key=>$v): ?><tr>
                        <td style="text-align: left; padding-left: 5%;"><?php echo ($v['title']); ?></td>
                        <td><?php echo ($v['name']); ?></td>
                        <td><?php if(($v["status"]) == "1"): ?>已开启<?php else: ?>未开启<?php endif; ?></td>
                        <td>
                            <a href="javascript:;" data-id="<?php echo ($v['id']); ?>" class="layui-btn layui-btn-mini layui-btn-normal sonadd">添加子权限</a>
                            <a href="javascript:;" data-id="<?php echo ($v['id']); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="<?php echo ($v['id']); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                        </td>
                    </tr>
                      <?php if(is_array($v['children'])): foreach($v['children'] as $key=>$n): ?><tr>
                        <td>│---<?php echo ($n['title']); ?></td>
                        <td><?php echo ($n['name']); ?></td>
                        <td><?php if(($n["status"]) == "1"): ?>已开启<?php else: ?>未开启<?php endif; ?></td>
                        <td style="text-align: left; padding-left: 10%;">
                            <a href="javascript:;" data-id="<?php echo ($n['id']); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="<?php echo ($n['id']); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                        </td>
                    </tr><?php endforeach; endif; endforeach; endif; ?>
                </tbody>
            </table>

        </div>
    </fieldset>

</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var editurl = "<?php echo U('Home/SysuserRule/editSysRule');?>";
    var listurl = "<?php echo U('Home/SysuserRule/sysRuleList');?>";
    var deleteurl = "<?php echo U('Home/SysuserRule/deleteSysRule');?>";
    var rooturl = "/";
    var curr = "<?php echo ((isset($requestPage) && ($requestPage !== ""))?($requestPage):''); ?>";
    var keyword_l = "<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>";
    var beginDate_l = "<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>";
    var endDate_l = "<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>";

</script>
</body>
<script type="text/javascript">
layui.use(['layer', 'laydate'], function() {
    var $ = layui.jquery,
        layer = layui.layer,
        laydate = layui.laydate;

    //点击搜索按钮的事件处理
    $('#search').on('click', function() {
        var keyword = $("#keyword").val();


        if (keyword == ""){
            layer.msg('请先输入内容', {time: 1000});
        }else{
                window.location.href=listurl+"?keyword="+keyword;
        }
    });

    //点击分配权限的事件处理
    $('.sonadd').on('click', function() {   
       var id = $(this).data('id'); 
        layer.open({
            type: 2,
            title: ['添加子权限', 'text-align:center;'],
            content: editurl+"?type=sonadd&id="+id,
            area:['400px', '300px'],  //宽高
            resize: false,      //是否允许拉伸
            scrollbar: false,
                maxmin: true,
            end: function(){
                location.reload();
            }
        });
    });


    //点击删除按钮的事件处理
    $('.del').on('click', function(){

        var id = $(this).data('id');
        layer.confirm('确定删除该权限?', {
            btn: ['确定', '取消']
        }, function(){
            $.ajax({
                url:deleteurl,
                type:"POST",
                data:{
                    'id':id
                },
                success:function(data2)
                {
                    if(data2.success){
                        //layer.close(index1);
                        layer.msg('删除成功！', {time: 1000,icon: 1});
                        location.reload();
                    }else {
                        layer.msg('删除失败!', {time: 1000,icon: 2});
                    }
                },
                error: function(){
                    layer.msg('请求服务器超时', {time: 1000,icon: 2});
                }
            });
        },function(){});
    });

    //点击编辑按钮的事件处理
    $('.edit').on('click', function(){

        var id = $(this).data('id');

        layer.open({
            type: 2,
            title: ['修改用户信息', 'text-align:center;'],
            content: editurl+"?type=updaterule&id="+id,
            area:['400px', '300px'],  //宽高
            resize: false,      //是否允许拉伸
            scrollbar: false,
            end: function(){
                location.reload();
            }
        });

    });


    $('.add').on('click', function(){

        layer.open({
            type: 2,
            title: ['添加父权限', 'text-align:center;'],
            content: editurl+"?type=addrule",
            area:['400px', '300px'],  //宽高
            resize: false,      //是否允许拉伸
            scrollbar: false,
            end: function(){
                location.reload();
            }
        });
    });

    //点击查看全部的事件处理
    $('#searchAll').on('click', function(){

        window.location.href=listurl;
    });

});
</script>
</html>