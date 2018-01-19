<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>行政班级管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <style type="text/css">
        .layui-input{
            height: 30px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }
    </style>
</head>
<body>
<div class="admin-main">
    <!--搜索组件的显示判断-->
    <?php if($showFlag == true): ?><blockquote class="layui-elem-quote">
        <form class="layui-form" style="height:30px;display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
            <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                <div class="layui-form-pane">
                    <label class="layui-form-label" style="padding: 4px 1px;">所属学院</label>
                    <div class="layui-input-inline">
                        <select name="col"  required lay-filter="" id="colid">
                            <option value=""></option>
                            <?php if(is_array($college)): $i = 0; $__LIST__ = $college;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><option value="<?php echo ($co["id"]); ?>" <?php if(($co["id"]) == $college_id): ?>selected="selected"<?php endif; ?>><?php echo ($co["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                <div class="layui-form-pane">
                    <label class="layui-form-label" style="padding: 4px 1px;">选择年级</label>
                    <div class="layui-input-inline">
                        <select class="select_paper" name="grade" required lay-filter="" id="gradeid">
                            <option value=""></option>
                            <?php if(is_array($grade)): $i = 0; $__LIST__ = $grade;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tt["id"]); ?>" <?php if(($tt["id"]) == $grade_id): ?>selected="selected"<?php endif; ?>><?php echo ($tt["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit;vertical-align: top;">
                <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="关键词（老师名，课程名或班级名）" style="width:250px;height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
            </div>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="search" style="vertical-align: top;">
                <i class="layui-icon">&#xe615;</i> 搜索
            </a>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll" style="margin-left: 2px;vertical-align: top;">
                <i class="layui-icon">&#xe615;</i> 查看全部
            </a>
        </form>
    </blockquote>
        <?php else: endif; ?>

    <fieldset class="layui-elem-field">
        <legend>选择行课班级</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>班级名称</th>
                    <th>课程名</th>
                    <th>任课老师</th>
                    <th>年级名称</th>
                    <th>所属学院</th>
                    <th>行课时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($classList)): $k = 0; $__LIST__ = $classList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($k); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php echo ($vo["lession_name"]); ?></td>
                        <td><?php echo ($vo["teacher_name"]); ?></td>
                        <td><?php echo ($vo["grade_name"]); ?></td>
                        <td><?php echo ($vo["college_name"]); ?></td>
                        <td><?php echo ($vo["start_time"]); ?> --- <?php echo ($vo["end_time"]); ?></td>
                        <td>
                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini enter">点击进入行课班级</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>
    <div class="" style="margin-left: 38%;position: static;bottom: 0;">
        <div id="page" ></div>
    </div>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var listurl = "<?php echo U('Home/ScoreAnalysis/classList');?>";
    var rooturl = "/";
    var enterurl = "<?php echo U('Home/ScoreAnalysis/classPaper');?>";
    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";
</script>
</body>
</html>
<script type="text/javascript">
    layui.use(['layer','form','jquery','laypage'],function(){
        var layer = layui.layer,
                form = layui.form(),
                laypage = layui.laypage,
                $ = layui.jquery;
        form.render('select');
        laypage({
            cont: 'page',
            pages: pages ,//总页数
            // skin:'#AF0000',
            skip:true, //显示跳页
            groups: 5, //连续显示分页数
            curr: curr,//获得当前页码
            jump: function(obj, first) {
                //得到了当前页，用于向服务端请求对应数据
                var curr = obj.curr;
                var college_id = $('#colid').val();
                var grade_id = $('#gradeid').val();
                var keyword = $('#keyword').val();
                if(!first) {
                    window.location.href=listurl+"?requestPage="+curr+"&college_id="+college_id+"&grade_id="+grade_id+"&keyword="+keyword;
                }
            }
        });
        //点击搜索按钮的事件处理
        $('#search').on('click', function() {
            var college_id = $('#colid').val();
            var grade_id = $('#gradeid').val();
            var keyword = $('#keyword').val();
            var searchword = "?keyword="+keyword+"&college_id="+college_id+"&grade_id="+grade_id;
            if (searchword == ""){
                layer.msg('请输入或选择内容');
            }
            window.location.href=listurl+searchword;

        });
        $('#searchAll').on('click', function(){
                 window.location.href=listurl;
        });
        $('.enter').on('click', function() {
            var id = $(this).data('id');
            window.location.href = enterurl+"?id="+id;
        });

    })
</script>