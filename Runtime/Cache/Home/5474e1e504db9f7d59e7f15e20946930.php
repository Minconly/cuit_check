<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>成绩详情</title>
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <link rel="stylesheet" href="/Public/student/SemanticUI/semantic.min.css">
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <style>
        .layui-input{
            height: 30px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }
        th {
            cursor: pointer;
        }
        th:hover,
        th.sorted {
            background: #d4d4d4;
        }

        th.no-sort,
        th.no-sort:hover {
            background: #f4f4f4;
            cursor: not-allowed;
        }

        th.sorted.ascending:after {
            content: "  \2191";
        }

        th.sorted.descending:after {
            content: " \2193";
        }

        .disabled {
            opacity: 0.5;
        }
    </style>
</head>
<body>
<div class="admin-main">
    <div class="layui-field-box" style="padding: 0;">
        <blockquote class="layui-elem-quote layui-quote-nm" style="padding: 10px;">试卷名称：<span style="margin-left: 5px;font-size: 1.2em;font-weight: bold;"><?php echo ($data["paperName"]); ?></span></blockquote>
    </div>
    <fieldset class="layui-elem-field">
        <legend>综合分析</legend>
            <div class="ui grid">
                <div class="eight wide column" style="height: 400px;padding-left: 100px;padding-top: 20px;">
                    <div class="" id="chart1" style="width:570px;height:100%;"></div>
                </div>
                <div class="six wide column" style="margin-top: 4%">
                    <div class="default-panel">
                        <div class="ui three small statistics">
                            <div class="statistic">
                                <div class="value">
                                    <?php echo ($data["full_score"]); ?>
                                </div>
                                <div class="label">
                                    试卷总分
                                </div>
                            </div>
                            <div class="blue statistic">
                                <div class="value">
                                    <?php echo ($data["pass_score"]); ?>
                                </div>
                                <div class="label">
                                    及格分数
                                </div>
                            </div>
                            <div class="blue statistic">
                                <div class="value">
                                    <?php echo ($data["averageScore"]); ?>
                                </div>
                                <div class="label">
                                    平均成绩
                                </div>
                            </div>
                            <div class="teal statistic">
                                <div class="value">
                                    <?php echo ($data["passCount"]); ?>
                                </div>
                                <div class="label">
                                    及格人数
                                </div>
                            </div>
                            <div class="red statistic">
                                <div class="value">
                                    <?php echo ($data["notPassCount"]); ?>
                                </div>
                                <div class="label">
                                    不及格人数
                                </div>
                            </div>
                            <div class="statistic">
                                <div class="value">
                                    <?php echo ($data["passRate"]); ?>
                                </div>
                                <div class="label">
                                    及格率
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>学生成绩</legend>
        <div class="layui-field-box" >
            <blockquote class="layui-elem-quote" style="border-left: 5px solid #00B5AD;height: 50px;">
                <a href="javascript:;" class="layui-btn layui-btn-small export" id="" style="margin-left: 10px;vertical-align: top;background-color: #3b83c0">
                    <i class="layui-icon">&#xe61d;</i> 导出该班成绩
                </a>

                <form class="layui-form" style="height:30px;display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
                    <a href="javascript:;" class="layui-btn layui-btn-small layui-btn-normal" id="paperKnowlwdge" style="vertical-align: top;">
                        <i class="layui-icon">&#xe62d;</i> 知识点分析
                    </a>
                    <div class="layui-input-block" style="display: inline-block; margin-left: 15px; min-height: inherit;vertical-align: top;">
                        <label class="layui-form-label" style="width: 130px;">分数段查询：</label>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" id="score_min" placeholder="下限分数（最低为0）" autocomplete="off" class="layui-input" value="<?php echo ((isset($passdata["score_min"]) && ($passdata["score_min"] !== ""))?($passdata["score_min"]):''); ?>">
                        </div>
                        --
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="text" id="score_max" placeholder="上限分数" autocomplete="off" class="layui-input" value="<?php echo ((isset($passdata["score_max"]) && ($passdata["score_max"] !== ""))?($passdata["score_max"]):''); ?>">
                        </div>
                    </div>
                    <a href="javascript:;" class="layui-btn layui-btn-small" id="scoreStage" style="vertical-align: top;">
                        <i class="layui-icon">&#xe615;</i> 查询
                    </a>
                    <div class="layui-input-block" style="display: inline-block; margin-left: 110px; min-height: inherit;vertical-align: top;">
                        <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词(分数，姓名或者学号)" style="width:300px;height: 30px; line-height: 30px;" value="<?php echo ((isset($passdata["keyword"]) && ($passdata["keyword"] !== ""))?($passdata["keyword"]):''); ?>">
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
            <span style="font-size: 0.9em;color: #2795e9">*小提示：点击指定表头可以排序</span>
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>学生学号</th>
                    <th>姓名</th>
                    <th class="no-sort">性别</th>
                    <th>分数</th>
                    <th>行政班级</th>
                    <th>排名</th>

                </tr>
                </thead>
                <tbody>
                <?php if(!empty($scoreList)): if(is_array($scoreList)): $i = 0; $__LIST__ = $scoreList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sl): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($sl["account"]); ?></td>
                        <td><?php echo ($sl["name"]); ?></td>
                        <td><?php if($sl['sex'] == 0): ?>女<?php endif; ?>
                            <?php if($sl['sex'] == 1): ?>男<?php endif; ?></td>
                        <td><?php echo ($sl["score"]); ?></td>
                        <td><?php echo ($sl["classname"]); ?></td>
                        <td><?php echo ($sl["rank"]); ?></td>
                        <!--<td><a href="javascript:;" data-id="<?php echo ($pl["id"]); ?>" data-courseid="<?php echo ($pl["courserclass_id"]); ?>" class="layui-btn layui-btn-mini detail">查看详情</a></td>-->
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                    <?php else: ?>
                    <tr><td colspan="6">暂时未查找到数据！</td></tr><?php endif; ?>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
<div>
    <div class="" style="margin-left: 38%;position: static;bottom: 0;">
        <div id="page" ></div>
    </div>
</div>

        <script src="/Public/static/layui/layui.js"></script>
<script>
    var rooturl = "";
    var listurl = "<?php echo U('Home/ScoreAnalysis/paperScore');?>";
    var paperId = "<?php echo ($passdata["paperId"]); ?>";
    var courseclass_id = "<?php echo ($passdata["courseclass_id"]); ?>";
    var pages = "<?php echo ($data["pages"]); ?>";
    var keyword = "<?php echo ($passdata["keyword"]); ?>";
    var curr = "<?php echo ($passdata["requestPage"]); ?>";
    var exporturl = "<?php echo U('Home/ScoreAnalysis/exportCourseScore');?>";
    var paperKnowledgeUrl = "<?php echo U('Home/ScoreAnalysis/paperKnowledge');?>";

</script>
<script src="/Public/static/jsbar/echarts.min.js"></script>
<!--<script src="/Public/static/js/scoreDetail.js"></script>-->
<script src="/Public/static/js/scoreDetail2.js"></script>
<script>
    var myChart1 = echarts.init(document.getElementById('chart1'));
    //var myChart2 = echarts.init(document.getElementById('chart2'));
    option1 = {
        title: {
            text: '分数段统计（单位:人数）',
            subtext: '来源于统计中心',
        },
        tooltip : {
            trigger: 'axis',
            axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
            },
            formatter: function (params) {
                var tar = params[1];
                return tar.name + '<br/>' + tar.seriesName + ' : ' + tar.value;
            }
        },
        grid: {
            width: 'auto',
            //bottom: '3%',
            containLabel: false
        },
        xAxis: {
            type : 'category',
            splitLine: {show:false},
            data : ['40分以下','40 - 50','50 - 60','60 - 70','70 - 80','80 - 90','90 - 100'],
            name: '分数段',
            nameGap: '11'
        },
        yAxis: [
            {
                type : 'value',
                name: '人数',
                nameLocation: 'start',
                nameGap: '18'
            },
        ],
        series: [
            {
                name: '辅助',
                type: 'bar',
                stack:  '总计',
                itemStyle: {
                    normal: {
                        barBorderColor: 'rgba(0,0,0,0)',
                        color: 'rgba(0,0,0,0)'
                    },
                    emphasis: {
                        barBorderColor: 'rgba(0,0,0,0)',
                        color: 'rgba(0,0,0,0)'
                    }
                },
                data: [0, 0, 0, 0, 0, 0, 0]
            },
            {
                name: '数量',
                type: 'bar',
                stack: '值',
                barWidth: '80%',
                label: {
                    normal: {
                        show: true,
                        position: 'inside'
                    }
                },
                data:[<?php echo ($score_segment); ?>],
            }
        ],
        color:['#3498db']
    };
    myChart1.setOption(option1);
</script>
<script src="/Public/student/js/jquery-3.1.1.min.js"></script>
<script src="/Public/static/jsbar/jquery.tablesort.min.js"></script>
<script>
    $(function() {
        $('table').tablesort().data('tablesort');
    })
</script>
</body>
</html>