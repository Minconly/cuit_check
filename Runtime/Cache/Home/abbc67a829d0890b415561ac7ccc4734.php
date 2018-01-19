<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>章节管理</title>
    <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all" />
    <!--<link rel="stylesheet" href="/Public/static/css/main.css" />-->
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css">
    <style>
        .layui-form-label{
            width: 100px;
        }
        .layui-tree li a cite {
            padding: 0 6px;
            font-size: 12px;
        }
        .theSelect .layui-input {
            height: 30px;
            width: 140px;
        }
    </style>
</head>

<body>
<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <?php if($select_show == true): ?>您当前所查看的学院是：
        <span style="margin-left: 5px;font-size: 1.1em;">
        <form class="layui-form" style="display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
            <div class="layui-input-inline theSelect" style="height: 30px;width: 140px;">
                <select name=""  placeholder="Select Task Type" id="demo-col">
                    <?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <a href="javascript:;" class="layui-btn layui-btn-small cut">
            <i class="layui-icon">&#xe623;</i> 切换学院
        </a>
        </form>
    </span>
            <?php else: endif; ?>
        <a href="javascript:;" class="layui-btn layui-btn-small add" style="padding-left: 10px;">
            <i class="layui-icon">&#xe608;</i> 添加章节
        </a>

        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
            <i class="layui-icon">&#xe615;</i> 刷新
        </a>
    </blockquote>

    <fieldset class="layui-elem-field">
        <legend>章节列表</legend>
        <div class="container-fluid">
            <div class="grid-4">
                <ul id="chapterTree" style="background-color:#fbfbfb;border-radius: 10px;">
                    <span style="font-size: 0.8em;color: #2795e9">*小提示：一级为学科，二级为课程，三级为章节</span>
                </ul>
            </div>
            <div class="grid-8" style="background-color:#eeeeee;height: auto;border-radius: 10px;">
                <div id="chapterItem" style="width: 100%; min-height: 450px;">
                    <div class="" style="margin-left: 10%;margin-top: 30%">
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;margin-left: 25%;border:1px;">
                            <legend>请选择点击左侧章节进行查看 详细信息 或者 知识点</legend>
                        </fieldset>
                    </div>
                </div>
                <!--<iframe id="chapterItem" src="" frameborder="0" style="width: 100%; min-height: 550px;"></iframe>-->
            </div>
        </div>
    </fieldset>

    <div class="window2" style="display: none;margin-top: 20px;">
        <form class="layui-form " method="post" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">名称:</label>
                <div class="layui-input-inline">
                    <input type="text" name="name" lay-verify="title" autocomplete="off" placeholder="请输入内容(最多18个字符)" class="layui-input"  value="">
                </div>
            </div>
            <?php if($select_show == true): ?><div class="layui-form-item">
                    <label class="layui-form-label">所属学院:</label>
                    <div class="layui-input-inline">
                        <select name="college_id" lay-filter="college" id="adminCol">
                            <option value="">选择学院</option>
                            <?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <?php else: endif; ?>
            <div class="layui-form-item">
                <label class="layui-form-label">所属课程:</label>
                <div class="layui-input-inline">
                    <select name="lession_id">
                        <option value="">选择课程</option>
                        <?php if(is_array($lessionList)): $i = 0; $__LIST__ = $lessionList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><optgroup label="<?php echo ($vo["name"]); ?>">
                                <?php if(is_array($vo["children"])): $i = 0; $__LIST__ = $vo["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo2["id"]); ?>"><?php echo ($vo2["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </optgroup><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <div class="layui-form-mid layui-word-aux">该课程为当前所在学院下的学科课程</div>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">排序号:</label>
                <div class="layui-input-inline">
                    <input type="text" name="sortnumber" lay-verify="sort" autocomplete="off" placeholder="请输入内容" class="layui-input"  value="">
                </div>
                <div class="layui-form-mid layui-word-aux">章节顺序(如是第七章：7)</div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">注解:</label>
                <div class="layui-input-inline">
                    <input type="text" name="comment" lay-verify="" autocomplete="off" placeholder="请输入内容(可为空)" class="layui-input"   value="">
                </div>
                <div class="layui-form-mid layui-word-aux">指章节辅助说明</div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label"> </label>
                <div class="layui-input-inline">
                    <div type="button" class="layui-btn" id="addChapter" lay-submit="" lay-filter="submit2">提交</div>
                </div>
            </div>
        </form>
    </div>

</div>
</body>
<script type="text/javascript" src="/Public/static/layui/layui.js"></script>
<script>
    layui.use(['layer','tree','form'],function () {
        var $ = layui.jquery,
                layer = layui.layer,
                form = layui.form();
        var index2;
        form.render();
        $.ajax({
            url:'getChapterList',
            type:"POST",
//            data:data.field,
            timeout: 2000,
            beforeSend: function(){

            },
            success:function(data2)
            {
                layui.tree({
                    elem: '#chapterTree',
                    nodes: data2,
                    click: function(node){
//                        console.log(node);
                        if(node.homePart == 'kids'){
                            var index = layer.load(2,{offset: ['45%', '64%']});
                            $('#chapterItem').load('getChapterItem',node,function(){
                                layer.close(index);
                            });
                        }
                    }
                });

//                var index = layer.load(2,{offset: ['45%', '64%']});
//                $('#chapterItem').load('getChapterItem',{id:1},function(){
//                    layer.close(index);
//                });

            },
            error: function(){
                layer.msg('列表请求失败!', {icon: 2});
            }
        });
        $('.cut').on('click', function(){
            var col = $('#demo-col').val();
            $("#chapterTree").html("");  //在每次ajax切换的时候，将该页原本的tree清空
            $.ajax({
                url:'getChapterList',
                type:"POST",
                data: {'choiceDept':col},
                timeout: 2000,
                beforeSend: function(){

                },
                success:function(data2)
                {
                    layui.tree({
                        elem: '#chapterTree',
                        nodes: data2,
                        click: function(node){
//                        console.log(node);
                            if(node.homePart == 'kids'){
                                var index = layer.load(2,{offset: ['45%', '64%']});
                                $('#chapterItem').load('getChapterItem',node,function(){
                                    layer.close(index);
                                });
                            }
                        }
                    });

                    var index = layer.load(2,{offset: ['45%', '64%']});
                    $('#chapterItem').load('getChapterItem',{id:1},function(){
                        layer.close(index);
                    });

                },
                error: function(){
                    layer.msg('列表请求失败!', {icon: 2});
                }
            });
        });
        $('.add').on('click',function () {
            index2 = layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['490px', '400px'], //宽高
                shadeClose: true,
                shade: 0.8,
                scrollbar: false,
                content: $('.window2'),
                end: function (){
//                    window.location.reload();
                }
            });

        });

        $('#searchAll').on('click',function () {
            var index = layer.load(2,{time:1000});
            window.location.reload();
        });

        form.verify({
            title: function(value) {
                if(value.length < 1 || value == null) {
                    return '内容至少得1个字符啊';
                }
                if(value.length > 18) {
                    return '最多18个字符'
                }
            },
            sort: function(value) {
                if(value.length < 1 || value == null) {
                    return '内容至少得1个字符啊';
                }
            }
        });
         form.on('select(college)',function(data) {
             var col = $('#adminCol').val();
         	$.ajax({
         		url: 'adminGetDept',
         		type: 'POST',
         		data: {'choiceDept1': col},
         		//contentType: "application/json; charset=utf-8",
         		dataTpye: 'json',
         		success:function(data) {
         		    //处理返回的json数组
         		    var html = '<option value="">选择课程</option>';
         		    console.log(data);
                    $.each(data, function(i,item) {
                        html += '<optgroup label='+item.name+'></optgroup>';
                        $.each(item.children, function(j, item2) {
                            html += '<option value='+item2.id+'>'+item2.name+'</option>';
                        });
                    });
                    $('form').find('select[name=lession_id]').html("");
         			$('form').find('select[name=lession_id]').append(html);
         			form.render();
         		}
         	});
         });
        form.on('submit(submit2)', function(data){
            layer.confirm('确认添加？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                $.ajax({
                    url:"<?php echo U('Home/ChapterMgr/addChapter');?>",
                    type:"POST",
                    data:data.field,
                    timeout: 2000,
                    beforeSend: function(){

                    },
                    success:function(data2)
                    {
                        if(data2.success){
                            layer.msg(data2.msg, {time: 1000,icon: 1});
                            location.reload();
                        }else {
                            layer.msg(data2.msg, {time: 1000,icon: 2});
                        }

                    },
                    error: function(){
                        layer.msg('请求服务器超时!', {time: 1000,icon: 2});
                    }
                });
                return false;
            }, function(){

            });
        });
    });
</script>

</html>