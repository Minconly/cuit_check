<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>结果详情</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
</head>
<body>
<div class="admin-main">
    <div>
        <fieldset class="layui-elem-field">
            <div class="layui-field-box">
                <blockquote class="layui-elem-quote layui-quote-nm">
                    <button class="layui-btn layui-btn-small layui-btn-normal returnLast" style="margin-left:2px;margin-right: 20px;">
                        <i class="layui-icon">&#xe603;</i>返回上级
                    </button>
                    <a href="javascript:;" class="layui-btn layui-btn-small export" style="margin-left: 100px;vertical-align: top;background-color: #3b83c0">
                        <i class="layui-icon">&#xe601;</i> 导出该学生成绩
                    </a>
                </blockquote>
            </div>

            <div class="layui-field-box">
                <legend>结果详情</legend>
            </div>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    <thead>
                    <tr>
                        <th>学号</th>
                        <th>姓名</th>
                        <th>试卷名称</th>
                        <th>学生班级</th>
                        <th>分数</th>
                        <th>成绩记录时间</th>
                        <!--<th>操作</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($studentScore)): if(is_array($studentScore)): $i = 0; $__LIST__ = $studentScore;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ss): $mod = ($i % 2 );++$i;?><tr>
                            <td><?php echo ($ss["account"]); ?></td>
                            <td><?php echo ($ss["stuname"]); ?></td>
                            <td><?php echo ($ss["papername"]); ?></td>
                            <td><?php echo ($ss["classname"]); ?></td>
                            <td><?php echo ($ss["score"]); ?></td>
                            <td><?php echo ($ss["create_date"]); ?></td>
                            <!--<td></td>-->
                            <!--<td><a href="javascript:;" data-id="<?php echo ($pl["id"]); ?>" data-courseid="<?php echo ($pl["courserclass_id"]); ?>" class="layui-btn layui-btn-mini detail">查看详情</a></td>-->
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <tr><td colspan="6">暂时未找到数据！</td></tr><?php endif; ?>
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
    var returnurl = "<?php echo U('Home/ScoreAnalysis/studentScore');?>";
    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";
    var paperId = "<?php echo ($paperId); ?>";
    var stuId = "<?php echo ($studentScore[0]['stuid']); ?>";
    var exporturl = "<?php echo U('Home/ScoreAnalysis/exportScore');?>";
</script>
<script>
    layui.config({
        base: rooturl+'Public/static/js/'
    }).use(['layer','laypage'], function() {
        $ = layui.jquery,
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
        $('.returnLast').on('click', function() {
            window.location.href = returnurl;
        });
        $('.export').on('click', function() {
            var index3 = layer.confirm('确定导出成绩吗?', {
                btn: ['确定', '取消']
            }, function(){
                window.open(exporturl+"?stuId="+stuId);
                layer.close(index3);
            });
        });
    });
</script>
</body>
</html>