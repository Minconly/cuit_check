<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生成绩检索</title>
    <link rel="stylesheet" href="/Public/student/SemanticUI/semantic.min.css">
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/studentScore.css">
</head>
<body>
<div class="body-main">
    <div class="sign-diver" >
        <h4 class="ui horizontal header divider">
        <i class="bar chart icon"></i>
        学生成绩检索
        </h4>
    </div>
    <div class="main-content">
        <fieldset class="layui-elem-field" style="min-height: 430px;">
            <legend>面板</legend>
            <div class="stepStyle">
                <div class="ui steps">
                    <div class="step">
                        <i class="edit icon"></i>
                        <div class="content">
                            <div class="title">输入</div>
                            <div class="description">在搜索框输入学号</div>
                        </div>
                    </div>
                    <div class="step">
                        <i class="search icon"></i>
                        <div class="content">
                            <div class="title">搜索</div>
                            <div class="description">系统搜索出相关成绩信息</div>
                        </div>
                    </div>
                    <div class="step">
                        <i class="info icon"></i>
                        <div class="content">
                            <div class="title">详情</div>
                            <div class="description">结果查看，可导出</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="searchInput">
                <div class="ui action input">
                    <input type="text" placeholder="搜索..." class="inputStyle" id="keyword">
                    <button class="ui icon button" id="search">
                        <i class="search icon"></i>
                    </button>
                </div>
            </div>
            <!--<div class="pictureStyle">-->
                <!--<div class="" id="chart1" style="width:30%;height:80%;float: left;margin-top: 2%"></div>-->
                <!--<div class="" id="chart2" style="width:30%;height:65%;float: right;margin-right: 5%;margin-top: 7%;"></div>-->
                <!--<div class="" id="chart3" style="width:30%;height:65%;float: right;margin-top: 7%;"></div>-->
            <!--</div>-->


        </fieldset>
    </div>

</div>
        <script src="/Public/static/layui/layui.js"></script>
<script src="/Public/static/jsbar/echarts.min.js"></script>
<script>
    var rooturl = "";
    var seaarch_listurl = "<?php echo U('Home/ScoreAnalysis/guoduSearch');?>";
</script>
<script src="/Public/static/js/studentScore.js"></script>
<script>/**
    var myChart1 = echarts.init(document.getElementById('chart1'));
    var myChart2 = echarts.init(document.getElementById('chart2'));
    var myChart3 = echarts.init(document.getElementById('chart3'));
    option1 = {
        title : {
            text: '总体试卷分数分析',
            subtext: '纯属虚构',
            x:'center'
        },
        tooltip : {
            trigger: 'item',
            formatter: "{a} <br/>{b} : {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            left: 'left',
            data: ['直接访问','邮件营销']
        },
        series : [
            {
                name: '访问来源',
                type: 'pie',
                radius : '55%',
                center: ['50%', '60%'],
                data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                ],
                itemStyle: {
                    emphasis: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }
        ]
    };
    option2 = {
        title : {
            text: '平均分最高学生',
            subtext: '纯属虚构',
            x:'bottom'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'right',
            data:['直接访问','邮件营销']
        },
        series: [
            {
                name:'访问来源',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                ]
            }
        ]
    };
    option3 = {
        title : {
            text: '平均分最高学生',
            subtext: '纯属虚构',
            x:'top'
        },
        tooltip: {
            trigger: 'item',
            formatter: "{a} <br/>{b}: {c} ({d}%)"
        },
        legend: {
            orient: 'vertical',
            x: 'right',
            data:['直接访问','邮件营销']
        },
        series: [
            {
                name:'访问来源',
                type:'pie',
                radius: ['50%', '70%'],
                avoidLabelOverlap: false,
                label: {
                    normal: {
                        show: false,
                        position: 'center'
                    },
                    emphasis: {
                        show: true,
                        textStyle: {
                            fontSize: '30',
                            fontWeight: 'bold'
                        }
                    }
                },
                labelLine: {
                    normal: {
                        show: false
                    }
                },
                data:[
                    {value:335, name:'直接访问'},
                    {value:310, name:'邮件营销'},
                ]
            }
        ]
    };
    myChart1.setOption(option1);
    myChart2.setOption(option2);
    myChart3.setOption(option3);**/
</script>
</body>
</html>