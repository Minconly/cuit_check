<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>知识点管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/main.css" />
    <link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <link rel="stylesheet" href="/Public/static/css/main.css" />
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <style>
        .layui-input{
            height: 30px;
        }
        .my-input .layui-input{
            height: 38px;
        }
        .my-input .layui-form-label{
            width: 90px;
        }
        .courseList{
            margin-top: 10px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }

    </style>
</head>

<body>
<div class="admin-main">

    <fieldset class="layui-elem-field">
        <legend>题库统计</legend>
        <div class="" style="height: 200px;padding-left: 12%">
            <div id="chart1" class="layui-inline" style="width: 30%;height:100%;"></div>
            <div id="chart2" class="layui-inline" style="width: 30%;height:100%; margin-left: 15%"></div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>题目列表</legend>
        <div class="container-fluid">
            <div class="layui-input-block"></div>
            <!--<div class="" style="background-color:#fbfbfb;height: auto;border-radius: 10px;">-->
            <!--<div id="testDetil" class="main" style="width: 100%; min-height: 450px;"></div>-->
            <!--</div>-->
            <form class="layui-form" action="">
                <blockquote class="layui-elem-quote">
                    <a href="javascript:;" class="layui-btn layui-btn-small addSingle">
                        <i class="layui-icon">&#xe608;</i> 添加单个题目
                    </a>
                    <a href="javascript:;" class="layui-btn layui-btn-small addList">
                        <i class="layui-icon">&#xe608;</i> 导入题目
                    </a>

                    <div class=" layui-input-block" style="display: inline-block; margin-left: 2px; vertical-align: bottom;">
                        <div class="layui-form-pane courseList">
                            <label class="layui-form-label" style="padding: 4px 1px;">选择难度</label>
                            <div class="layui-input-inline">
                                <select id="level" name="level_id" lay-verify>
                                    <option value="" selected=""></option>
                                    <option value="1" <?php if(($level) == "1"): ?>selected<?php endif; ?>>简单</option>
                                    <option value="2" <?php if(($level) == "2"): ?>selected<?php endif; ?>>普通</option>
                                    <option value="3" <?php if(($level) == "3"): ?>selected<?php endif; ?>>困难</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" layui-input-block" style="display: inline-block; margin-left: 2px; vertical-align: bottom;">
                        <div class="layui-form-pane courseList">
                            <label class="layui-form-label" style="padding: 4px 1px;">选择题型</label>
                            <div class="layui-input-inline">
                                <select id="type" name="type_id" lay-verify>
                                    <option value="" selected=""></option>
                                    <option value="1" <?php if(($type) == "1"): ?>selected<?php endif; ?>>选择</option>
                                    <option value="2" <?php if(($type) == "2"): ?>selected<?php endif; ?>>判断</option>
                                    <option value="3" <?php if(($type) == "3"): ?>selected<?php endif; ?>>填空</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="testdb_id" value="<?php echo ($testDBId); ?>">

                    <div class="layui-input-block" style="display: inline-block; margin-left: 2px; min-height: inherit; vertical-align: bottom;">
                        <input type="text" name="keyword" id="keyword" required lay-verify class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
                    </div>
                    <a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" lay-submit lay-filter="submit2" id="search">
                        <i class="layui-icon" >&#xe615;</i> 搜索
                    </a>
                    <a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" id="searchAll">
                        <i class="layui-icon">&#xe615;</i> 查看全部
                    </a>
                </blockquote>
            </form>
            <fieldset class="layui-elem-field">
                <!--<legend>学院列表</legend>-->
                <div class="layui-field-box">
                    <table class="site-table table-hover">
                        <colgroup>
                            <col width="5%">
                            <col width="10%">
                            <col width="26%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>所属题库</th>
                            <th>题干</th>
                            <th>题目难度</th>
                            <th>题目类型</th>
                            <th>知识点</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($questionlist)): $i = 0; $__LIST__ = $questionlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td><?php echo ($vo["id"]); ?></td>
                                <td><?php echo ($vo["testdb_id"]); ?></td>
                                <td><?php echo ($vo["content"]); ?></td>
                                <td><?php echo ($vo["level"]); ?></td>
                                <td><?php echo ($vo["type"]); ?></td>
                                <td><?php echo ($vo["knowledge_ids"]); ?></td>
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

            <div id="page" class="page"></div>

        </div>
    </fieldset>

</div>

</body>
        <script src="/Public/static/layui/layui.js"></script>
<script src="https://cdn.bootcss.com/echarts/3.5.2/echarts.min.js"></script>
<script type="text/javascript">
    var rooturl = "/";

    var testDBId = "<?php echo ($testDBId); ?>";
    var curr = "<?php echo ($requestPage); ?>";
    var pages = "<?php echo ($pages); ?>";
    var keyword = "<?php echo ($keyword); ?>";
    var type = "<?php echo ($type); ?>";
    var level = "<?php echo ($level); ?>";
    var str1 = "<?php echo ($str1); ?>";
    var str2 = "<?php echo ($str2); ?>";

    var listurl = "<?php echo U('Home/TestDatabaseMgr/detailTestDB');?>";
    var checkpermis = "<?php echo U('Home/DetailTestDBMgr/checkaddPermiss');?>";
    var addonequs = "<?php echo U('Home/DetailTestDBMgr/addOneQuestion');?>";
    var editqus = "<?php echo U('Home/DetailTestDBMgr/editQuestion');?>";
    var deletequs = "<?php echo U('Home/DetailTestDBMgr/deleteAction');?>";
    var addList = "<?php echo U('Home/DetailTestDBMgr/uploadQuestionViews');?>";
</script>
<script type="text/javascript" src="/Public/static/js/detailTestDB.js"></script>


<script>
   

        var myChart = echarts.init(document.getElementById('chart1'));
        var myChart1 = echarts.init(document.getElementById('chart2'));

        // 指定图表的配置项和数据
        var option1 = {

            tooltip: {},
               legend: {
                   data:['难度']
               },
            xAxis: {
                data: ["简单","普通","困难"]
            },
            yAxis: {},
            series: [{
                name: '难度',
                type: 'bar',
                data: [<?php echo ($str1); ?>]
            }],
            color:['#1AA094', '#c4ccd3']
        };
        // 指定图表的配置项和数据
        var option2 = {

            tooltip: {},
                legend: {
                    data:['类型']
                },

            xAxis: {
                data: ["选择","判断","填空"]
            },
            yAxis: {},
            series: [{
                name: '类型',
                type: 'bar',
                data: [<?php echo ($str2); ?>]
            }],
            color:['#1AA094', '#c4ccd3']
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option1);
        myChart1.setOption(option2);

</script>

</html>