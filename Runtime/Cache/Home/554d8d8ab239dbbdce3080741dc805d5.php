<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统用户组管理</title>
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
            <i class="layui-icon">&#xe608;</i> 添加用户组
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
        <legend>用户组列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>用户组名称</th>
                    <th>用户组状态</th>
                    <th>用户组权限编号</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($grouplst)): $i = 0; $__LIST__ = $grouplst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["title"]); ?></td>
                        <td><?php if(($vo["status"]) == "1"): ?>是<?php else: ?>否<?php endif; ?></td>
                        <td><?php echo ($vo["rules"]); ?></td>
                        <td>
                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal power">分配权限</a>
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
    var editurl = "<?php echo U('Home/SysuserGroup/editSysGroup');?>";
    var listurl = "<?php echo U('Home/SysuserGroup/sysGroupList');?>";
    var powerturl = "<?php echo U('Home/SysuserGroup/rule_group');?>";
    var deleteurl = "<?php echo U('Home/SysuserGroup/deleteSysGroup');?>";
    var rooturl = "/";
    var pages = "<?php echo ((isset($pages) && ($pages !== ""))?($pages):''); ?>";
    var curr = "<?php echo ((isset($requestPage) && ($requestPage !== ""))?($requestPage):''); ?>";
    var keyword_l = "<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>";
    var beginDate_l = "<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>";
    var endDate_l = "<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>";

</script>
</body>
<script type="text/javascript">
layui.use(['laypage', 'layer', 'laydate'], function() {
    var $ = layui.jquery,
        laypage = layui.laypage,
        layer = layui.layer,
        laydate = layui.laydate;

    //page
    laypage({
        cont: 'page',
        pages: pages //总页数
        ,
        groups: 5 //连续显示分页数
        ,
        curr: curr,//获得当前页码
        jump: function(obj, first) {
            //得到了当前页，用于向服务端请求对应数据
            var curr = obj.curr;
            if(!first) {
                window.location.href=listurl+"?requestPage="+curr+"&beginDate="+beginDate_l+"&endDate="+endDate_l+
                "&keyword="+keyword_l;
            }
        }
    });

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
    $('.power').on('click', function() {   
       var id = $(this).data('id'); 
        layer.open({
            type: 2,
            title: ['权限分配', 'text-align:center;'],
            content: powerturl+"?id="+id,
            area:['700px', '500px'],  //宽高
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
        layer.confirm('确定删除该用户?', {
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
            content: editurl+"?type=updategroup&id="+id,
            area:['400px', '300px'],  //宽高
            resize: false,      //是否允许拉伸
            scrollbar: false,
            end: function(){
                location.reload();
            }
        });

    });

    //点击添加学院的事件处理
    $('.add').on('click', function(){

        layer.open({
            type: 2,
            title: ['添加系统用户组', 'text-align:center;'],
            content: editurl+"?type=addgroup",
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