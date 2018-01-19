<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>知识点管理</title>

    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <style>
        .layui-input{
            height: 30px;
            width: 140px;
        }
    </style>
</head>
<body>

<div class="admin-main">

    <fieldset class="layui-elem-field">
        <div style="margin-top: 12px;margin-left: 15px;">
            <a href="javascript:;" class="layui-btn layui-btn-small addSingle" data-id="<?php echo ($chapter_id); ?>">
                <i class="layui-icon">&#xe608;</i> 添加知识点
            </a>
        </div>

        <!--<legend>学院列表</legend>-->
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>名称</th>
                    <th>所属章节</th>
                    <th>所属课程</th>
                    <th>备注</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($vo["id"]); ?></td>
                            <td><?php echo ($vo["name"]); ?></td>
                            <td><?php echo ($vo["chaptername"]); ?></td>
                            <td><?php echo ($vo["lessionname"]); ?></td>
                            <td><?php echo ($vo["comment"]); ?></td>
                            <td style="max-width: 100px">
                                <div style="width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo ($vo["create_date"]); ?></div>
                            </td>
                            <td>
                                <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit2">编辑</a>
                                <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del2">删除</a>
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

<!--在单个章节的知识点添加知识点窗口-->
<div style="display: none;margin-top: 10px;" id="windows1" >
    <form class="layui-form">
        <div class="layui-form-item">
            <label class="layui-form-label">名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" lay-verify="title" autocomplete="on" placeholder="知识点名" class="layui-input" style="width:80%;"  value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">所属章节</label>
            <div class="layui-input-block">
                <select name="chapter_id" lay-verify="chapter">
                    <option value="">请选择章节</option>
                    <?php if(is_array($chapterForSelect)): $i = 0; $__LIST__ = $chapterForSelect;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["id"]); ?>" <?php if(($vo["id"]) == $chapter_id): ?>selected="selected"<?php endif; ?>><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>

                </select>
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-block">
                <input type="text" name="comment" maxlength="25" lay-verify="title" autocomplete="off" placeholder="最多25字" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["remarks"]) && ($sysuser["remarks"] !== ""))?($sysuser["remarks"]):''); ?>">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="demo3">保存</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
        </div>

    </form>
</div>
<!--<script type="text/javascript" src="plugins/layui/layui.js" charset="utf-8"></script> 子页面不能加载 -->
<script>

    var pages = "<?php echo ((isset($pages) && ($pages !== ""))?($pages):''); ?>";
    var curr = "<?php echo ((isset($requestPage) && ($requestPage !== ""))?($requestPage):''); ?>";
    var keyword = "<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>";
    var chapter_id = "<?php echo ((isset($chapter_id) && ($chapter_id !== ""))?($chapter_id):''); ?>";
    var lession_id = "<?php echo ((isset($lession_id) && ($lession_id !== ""))?($lession_id):''); ?>";

//    var editurl = "<?php echo U('Home/KnowledgeMgr/editKnowledge');?>";
//    var listurl = "<?php echo U('Home/KnowledgeMgr/knowledges');?>";


    var data = {
        "keyword":keyword,
//        "beginDate":beginDate,
//        "endDate":endDate,
        "chapter_id":chapter_id,
        "lession_id":lession_id
    };

layui.use(['laypage','layer','form'], function(){
    var $ = layui.jquery,
            laypage = layui.laypage,
            layer = layui.layer,
            form = layui.form();
    form.render();
    var index2;
    laypage({
        cont: $('#page'),
        pages: pages, //总页数
        groups: 5, //连续显示分页数
        curr: curr,//获得当前页码
        jump: function(obj, first) {
            //得到了当前页，用于向服务端请求对应数据
            var curr = obj.curr;
            data["requestPage"] = curr;
//            console.log(data);
            if(!first) {
                var index = layer.load(2,{offset: ['45%', '60%']});
                $('#knowledgeItem').load(listurl,data,function(){
                    layer.close(index);
                });
            }
        }
    });

//    layui.render();
    form.on('submit(demo3)', function(data) {

        layer.confirm('确认提交？', {
            btn: ['确认','取消'] //按钮
        }, function(){
            layer.msg('已提交！', {icon: 1});
            $.ajax({
                url:addurl,
                type:"POST",
                data:data.field,
                beforeSend: function(){
                    //
                },
                success:function(data2)
                {
                    if(data2.success){
                        layer.msg(data2.msg, {time: 1000,icon: 1},function(){
                            layer.close(index2);
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


    //点击添加知识点的事件处理
    $('.addSingle').on('click', function(){
        //var chapter_id = $(this).data('id');
        index2 = layer.open({
            type: 1,
            skin: 'layui-layer-rim my-input', //加上边框
            shadeClose: true,
            shade: 0.8,
            scrollbar: false,
            area: ['350px', '400px'], //宽高
            content: $('#windows1'),
            end: function (){
                var index = layer.load(2,{offset: ['45%', '60%']});
                $('#knowledgeItem').load(listurl,data,function(){
                    layer.close(index);
                });
            }
        });

    });

    //点击删除按钮的事件处理
    $('.del2').on('click', function(){

        var id = $(this).data('id');
        layer.confirm('确定删除该知识点?', {
            btn: ['确定', '取消']
        }, function(){
            $.ajax({
                url:deleteurl,
                type:"POST",
                data:{
                    'id':id
                },
                beforeSend: function(){
                    //
                },
                success:function(data2)
                {
                    if(data2.success){
                        //layer.close(index1);
                        layer.msg(data2.msg, {time: 2000,icon: 1});

                        var index = layer.load(2,{offset: ['45%', '60%']});
                        $('#knowledgeItem').load(listurl,data,function(){
                            layer.close(index);
                        });
                    }else {
                        layer.msg(data2.msg, {time: 1000,icon: 2});
                    }
                },
                error: function(){
                    layer.msg('请求服务器超时', {time: 1000,icon: 2});
                }
            });
        },function(){});
    });

    //点击编辑按钮的事件处理
    $('.edit2').on('click', function(){

        var id = $(this).data('id');

        layer.open({
            type: 2,
            title: ['修改用户信息', 'text-align:center;'],
            content: editurl+"?id="+id,
            area:['380px', '400px'],  //宽高
            resize: false,		//是否允许拉伸
            scrollbar: false,
            end: function(){
                var index = layer.load(2,{offset: ['45%', '60%']});
                $('#knowledgeItem').load(listurl,data,function(){
                    layer.close(index);
                });
            }
        });

    });

});

</script>

</body>
</html>