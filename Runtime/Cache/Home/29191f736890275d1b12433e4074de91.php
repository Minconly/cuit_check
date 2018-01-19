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
                <blockquote class="layui-elem-quote layui-quote-nm">
                    <button class="layui-btn layui-btn-small layui-btn-normal returnLast" style="margin-left:2px;margin-right: 20px;">
                        <i class="layui-icon">&#xe603;</i>返回上级
                    </button>
                    行课班级名称：<span style="margin-left: 5px;font-size: 1.1em;font-weight: bold"><?php echo ($className); ?></span>
                    <form class="layui-form" style="height:30px;display: inline-block; min-height: inherit; vertical-align: bottom;float: right;">

                        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit;vertical-align: top;">
                            <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词（试卷名或类型）" style="width:300px;height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
                        </div>
                        <a href="javascript:;" class="layui-btn layui-btn-small" id="search" style="vertical-align: top;">
                            <i class="layui-icon">&#xe615;</i> 搜索
                        </a>
                        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll" style="margin-left: 2px;vertical-align: top;">
                            <i class="layui-icon">&#xe615;</i> 查看全部
                        </a>
                    </form>
                </blockquote>
            </div>
            <div class="layui-field-box">
                <table class="site-table table-hover">
                    <thead>
                    <tr>
                        <th>序号</th>
                        <th>试卷名</th>
                        <th>类型</th>
                        <th>所属学院</th>
                        <th>出题人</th>
                        <th>该班测试时间</th>
                        <th>备注</th>
                        <th>操作</th>
                        <!--<th>操作</th>-->
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($paperList)): if(is_array($paperList)): $k = 0; $__LIST__ = $paperList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pl): $mod = ($k % 2 );++$k;?><tr>
                            <td><?php echo ($k); ?></td>
                            <td><?php echo ($pl["paper_name"]); ?></td>
                            <td><?php echo ($pl["examtype"]); ?></td>
                            <td><?php echo ($pl["college_name"]); ?></td>
                            <td><?php echo ($pl["paper_create"]); ?></td>
                            <td><?php echo ($pl["start_time"]); ?><br>至<br><?php echo ($pl["end_time"]); ?></td>
                            <td><?php echo ($pl["comment"]); ?></td>
                            <td><a href="javascript:;" data-id="<?php echo ($pl["paper_id"]); ?>" class="layui-btn layui-btn-mini detail" data-endtime="<?php echo ($pl["end_time"]); ?>">查看详情</a></td>
                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
                        <tr><td colspan="8">暂时未查找到数据！</td></tr><?php endif; ?>
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
    var listurl = "<?php echo U('Home/ScoreAnalysis/classStudent');?>";
    var returnurl = "<?php echo U('Home/ScoreAnalysis/classList');?>";
    var detailurl = "<?php echo U('Home/ScoreAnalysis/paperScore');?>";
    var courseclass_id = "<?php echo ($courseclass_id); ?>";
    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";
</script>
<script>
    layui.config({
        base: rooturl+'Public/static/js/'
    }).use(['layer','laypage'], function() {
        var layer = layui.layer,
                laypage = layui.laypage,
                $ = layui.jquery;

        laypage({
            cont: 'page',
            pages: pages,
            groups: 5,
            //skip: true, //是否开启跳页
            curr: curr,
            jump: function(obj, first) {
                var curr = obj.curr;
                var keyword = $("#keyword").val();
                if(!first) {
                    window.location.href = listurl+"?requestPage="+curr+"&id="+class_id+"&keyword="+keyword;
                }
            }
        });

        //点击搜索按钮的事件处理
        $('#search').on('click', function() {
            var keyword = $('#keyword').val();
            if (keyword == ""){
                layer.msg('请输入或选择内容');
            }
            window.location.href=listurl+"?keyword="+keyword+"&id="+class_id;

        });
        $('#searchAll').on('click', function(){
            window.location.href=listurl+"?id="+class_id;
        });
        $('.returnLast').on('click', function() {
            window.location.href = returnurl;
        });
        //时间比较，判断当前时间与考试时间的关系
        function checkTime(){
            var date = new Date();
            var str = "" + date.getFullYear() + "-";
            str += (date.getMonth()+1) + "-";
            str += date.getDate();
            str += ' '+ date.getHours()+":"+date.getMinutes()+":"+date.getSeconds();
            var tady = new Date(str.replace("-", "/").replace("-", "/"));
            return tady;
        }
        //当考试的结束时间过了才可以查看成绩详情
        $('.detail').on('click', function() {
            var endtime = $(this).data('endtime');
            var nowtime = checkTime();
            var end=new Date(endtime.replace("-", "/").replace("-", "/"));
            if(nowtime < end) {
                layer.msg('考试结束时间还未过！',{time:2000,icon:3});
            }else {
                var paperId = $(this).data('id');
                //弹出即全屏
                var index1 = parent.layer.open({
                    type: 2,
                    title: ['   详细信息', 'text-align:center;'],
                    content: detailurl+"?paperId="+paperId+"&courseclass_id="+courseclass_id,
                    maxmin: true,
                });
                parent.layer.full(index1);
            }
        });
    });
</script>
</body>
</html>