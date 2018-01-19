<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>试卷详情</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
</head>
<body>
<div class="admin-main">
    <div>
        <fieldset class="layui-elem-field">
            <div class="layui-field-box">
                <blockquote class="layui-elem-quote layui-quote-nm">试卷名称：<span style="margin-left: 5px;font-size: 1.1em;font-weight: bold"><?php echo ($paperName); ?></span></blockquote>
            </div>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    <thead>
                    <tr>
                        <th>使用班级</th>
                        <th>任课老师</th>
                        <th>总人数</th>
                        <th>参考人数</th>
                        <th>开始时间</th>
                        <th>结束时间</th>
                        <!--<th>操作</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($paperList)): $i = 0; $__LIST__ = $paperList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pl): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($pl["coursename"]); ?></td>
                            <td><?php echo ($pl["name"]); ?></td>
                            <td><?php echo ($pl["totalstu"]); ?></td>
                            <td><?php echo ($pl["factstu"]); ?></td>
                            <td><?php echo ($pl["start_time"]); ?></td>
                            <td><?php echo ($pl["end_time"]); ?></td>
                            <!--<td><a href="javascript:;" data-id="<?php echo ($pl["id"]); ?>" data-courseid="<?php echo ($pl["courserclass_id"]); ?>" class="layui-btn layui-btn-mini detail">查看详情</a></td>-->
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </fieldset>
    </div>
    <div class="" style="margin-left: 38%;position: static;bottom: 0;">
        <div id="page" ></div>
    </div>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script>
    var rooturl = "/";
    var listurl = "<?php echo U('Home/ScoreAnalysis/detailPaper');?>";
    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";
    var paperId = "<?php echo ($paperId); ?>";
</script>
<script>
    layui.config({
        base: rooturl+'Public/static/js/'
    }).use(['layer','laypage'], function() {
        laypage = layui.laypage;
        laypage({
            cont: 'page',
            pages: pages,
            groups: 5,
            //skip: true, //是否开启跳页
            curr: curr,
            jump: function(obj, first) {
                var curr = obj.curr;
                if(!first) {
                    window.location.href = listurl+"?requestPage="+curr+"&id="+paperId;
                }
            }
        });
    });
</script>
</body>
</html>