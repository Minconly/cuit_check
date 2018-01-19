<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	
	<link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css" media="all">
	<link rel="stylesheet" href="/Public/static/css/collegeList.css" media="all">
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
        .detil-block-style{
            padding: 15px;
            margin: 5px;
            border-radius: 10px;
            display: inline-block;
            text-align: center;
        }
        .detil-block-style > i{
            color: #FF5722;
            font-size: x-large;
        }

        .questions{
            height: auto;
            border:solid 1px grey;
            border-radius: 13px;
            -webkit-border-radius: 13px;
            -moz-border-radius: 13px;
            padding: 2%;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 12px;

            -webkit-transition: all 0.5s ease-in;
            -moz-transition: all 0.5s ease-in;
            -o-transition: all 0.5s ease-in;
            transition: all 0.5s ease-in;
        }
        .questions:hover{
            box-shadow: -1px 3px 18px grey;
            -webkit-box-shadow: -1px 3px 18px grey;
            -moz-box-shadow: -1px 3px 18px grey;
        }
        .layui-btn-radius{
            border-radius: 13px;
        }

        .setfontColor span{
            color: #000000;
        }
        .layui-unselect{
            height: 30px;
            line-height: 30px;
            width: 100px;
        }
        .panel{
            border-radius: 6px;
            border: 1px solid #EEE;
            margin-bottom: 20px;
            background-color: #fff;
        }
        .panel-heading {
            border-bottom: 1px solid #EEE;
            padding: 1.4em;
            font-size: 13px;
            border-top-left-radius: 3px;
            border-top-right-radius: 3px;
            font-weight: bold;
            clear:both;
            overflow: hidden;
            cursor: pointer;
        }
        .panel-body {
            padding: 15px;
            clear:both;
            overflow: hidden;
            display: none;
        }
        .pull-right {
            float: right!important;
        }
    </style>
</head>
<body>

	<div class="admin-main">
    <fieldset class="layui-elem-field layui-field-title" style="margin-top: 10px;">
        <legend>试卷详情</legend>
    </fieldset>
    <blockquote class="layui-elem-quote layui-quote-nm">
        <span style="font-size: 0.8em;color: #2795e9">*小提示:及格分数根据总分自动生成</span>
        <div class="layui-inline layui-bg-gray detil-block-style"><p>总&nbsp;&nbsp;&nbsp;分</p><i><?php echo ($testPaper["full_score"]); ?></i></i></div>
        <div class="layui-inline layui-bg-gray detil-block-style"><p>及格分</p><i><?php echo ($testPaper["pass_score"]); ?></i></i></div>
        <div class="layui-inline layui-bg-gray detil-block-style"><p>题&nbsp;&nbsp;&nbsp;量</p><i><?php echo ($testPaperQuesNum); ?></i></i></div>
        <div class="layui-inline" id="detil"  style="width: 500px;height:150px; margin-left: 20%"></div>
    </blockquote>

    <form class="layui-form" action="">
        <blockquote class="layui-elem-quote">
            <a href="javascript:;" id="addSingle"  class="layui-btn layui-btn-small">
                <i class="layui-icon">&#xe608;</i> 单个题目添加
            </a>

            <a href="javascript:;" class="layui-btn layui-btn-small" id="autoAdd">
                <i class="layui-icon">&#xe635;</i> 自动生成
            </a>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="reflush">
                <i class="layui-icon">&#xe615;</i> 刷新
            </a>

        </blockquote>
    </form>

    <fieldset class="layui-elem-field">
        <legend>题目列表</legend>

        <!--选择题列表-->
        <?php if(is_array($choiceList)): $i = 0; $__LIST__ = $choiceList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-field-box questions">
            <div class="questions-item">
                <div class="questions-item-tigan">
                    <code>选择题<?php echo ($i); ?>.</code>&nbsp;&nbsp;&nbsp;<i>(分值：</i><?php echo ($vo["value"]); ?>&nbsp;&nbsp;
                    <?php switch($vo["level"]): case "1": ?><i>难度：简单)</i><?php break;?>
                        <?php case "2": ?><i>难度：普通)</i><?php break;?>
                        <?php case "3": ?><i>难度：困难)</i><?php break;?>
                        <?php default: endswitch;?>
                    <pre>

<?php echo ($vo["content"]); ?>

                    </pre>
                </div>

                 <div class="questions-item-xuanxiang">
                    <section class="panel">
                        <div class="panel-heading choice-panel" data-id="<?php echo ($vo["question_id"]); ?>" data-type="<?php echo ($vo["type"]); ?>">
                            点击查看正确答案
                            <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe61a;</i></a>
                        </div>
                        <div class="panel-body">
                        </div>
                    </section>
                </div>


                <div class="questions-item-caozuo">
                    <div style="margin-left: 80%">
                        <a href="javascript:;" class="layui-btn layui-btn-small changeVal" data-id="<?php echo ($vo["question_id"]); ?>" data-value="<?php echo ($vo["value"]); ?>">
                            <i class="layui-icon">&#xe642;</i> 分值修改
                        </a>
                        <a href="javascript:;" class="layui-btn layui-btn-small delSingle" data-id="<?php echo ($vo["question_id"]); ?>">
                            <i class="layui-icon">&#x1006;</i> 删除题目
                        </a>
                    </div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--判断题列表-->
        <?php if(is_array($trueOrFalseList)): $i = 0; $__LIST__ = $trueOrFalseList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-field-box questions">
            <div class="questions-item">
                <div class="questions-item-tigan">
                    <code>判断题<?php echo ($i); ?>.</code>&nbsp;&nbsp;&nbsp;<i>(分值：</i><?php echo ($vo["value"]); ?>&nbsp;&nbsp;
                    <?php switch($vo["level"]): case "1": ?><i>难度：简单)</i><?php break;?>
                        <?php case "2": ?><i>难度：普通)</i><?php break;?>
                        <?php case "3": ?><i>难度：困难)</i><?php break;?>
                        <?php default: endswitch;?>
                    <pre>

<?php echo ($vo["content"]); ?>

                    </pre>
                </div>
                <div class="questions-item-xuanxiang">
                    <section class="panel">
                        <div class="panel-heading choice-panel" data-id="<?php echo ($vo["question_id"]); ?>" data-type="<?php echo ($vo["type"]); ?>">
                            点击查看正确答案
                            <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe61a;</i></a>
                        </div>
                        <div class="panel-body">
                            
                        </div>
                    </section>
                </div>
                <div class="questions-item-caozuo">
                    <div style="margin-left: 80%">
                        <a href="javascript:;" class="layui-btn layui-btn-small changeVal" data-id="<?php echo ($vo["question_id"]); ?>" data-value="<?php echo ($vo["value"]); ?>">
                            <i class="layui-icon">&#xe642;</i> 分值修改
                        </a>
                        <a href="javascript:;" class="layui-btn layui-btn-small delSingle" data-id="<?php echo ($vo["question_id"]); ?>">
                            <i class="layui-icon">&#x1006;</i> 删除题目
                        </a>
                    </div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--填空列表-->
        <?php if(is_array($fillBlankList)): $i = 0; $__LIST__ = $fillBlankList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-field-box questions">
            <div class="questions-item">
                <div class="questions-item-tigan">
                    <code>填空题<?php echo ($i); ?>.</code>&nbsp;&nbsp;&nbsp;<i>(分值：</i><?php echo ($vo["value"]); ?>&nbsp;&nbsp;
                    <?php switch($vo["level"]): case "1": ?><i>难度：简单)</i><?php break;?>
                        <?php case "2": ?><i>难度：普通)</i><?php break;?>
                        <?php case "3": ?><i>难度：困难)</i><?php break;?>
                        <?php default: endswitch;?>
                    <pre>

<?php echo ($vo["content"]); ?>

                    </pre>
                </div>
                <div class="questions-item-xuanxiang">
                    <section class="panel">
                        <div class="panel-heading choice-panel" data-id="<?php echo ($vo["question_id"]); ?>" data-type="<?php echo ($vo["type"]); ?>">
                            点击查看正确答案
                            <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe61a;</i></a>
                        </div>
                        <div class="panel-body">
                        </div>
                    </section>
                </div>

                <div class="questions-item-caozuo">
                    <div style="margin-left: 80%">
                        <a href="javascript:;" class="layui-btn layui-btn-small changeVal" data-id="<?php echo ($vo["question_id"]); ?>" data-value="<?php echo ($vo["value"]); ?>">
                            <i class="layui-icon">&#xe642;</i> 分值修改
                        </a>
                        <a href="javascript:;" class="layui-btn layui-btn-small delSingle" data-id="<?php echo ($vo["question_id"]); ?>">
                            <i class="layui-icon">&#x1006;</i> 删除题目
                        </a>
                    </div>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

        <!--编程题列表-->
        <?php if(is_array($programeList)): $i = 0; $__LIST__ = $programeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="layui-field-box questions">
        <div class="questions-item">
            <div class="questions-item-tigan">
                <code>编程题<?php echo ($i); ?>.</code>&nbsp;&nbsp;&nbsp;<i>(分值：</i><?php echo ($vo["value"]); ?>&nbsp;&nbsp;
                    <?php switch($vo["level"]): case "1": ?><i>难度：简单)</i><?php break;?>
                        <?php case "2": ?><i>难度：普通)</i><?php break;?>
                        <?php case "3": ?><i>难度：困难)</i><?php break;?>
                        <?php default: endswitch;?>
                    <pre>

<?php echo ($vo["content"]); ?>

                    </pre>
            </div>
            <div class="questions-item-xuanxiang">
                <section class="panel">
                    <div class="panel-heading choice-panel" data-id="<?php echo ($vo["question_id"]); ?>" data-type="<?php echo ($vo["type"]); ?>">
                        点击查看正确答案
                        <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe61a;</i></a>
                    </div>
                    <div class="panel-body">

                    </div>
                </section>
            </div>
            <div class="questions-item-caozuo">
                <div style="margin-left: 80%">
                    <a href="javascript:;" class="layui-btn layui-btn-small changeVal" data-id="<?php echo ($vo["question_id"]); ?>" data-value="<?php echo ($vo["value"]); ?>">
                        <i class="layui-icon">&#xe642;</i> 分值修改
                    </a>
                    <a href="javascript:;" class="layui-btn layui-btn-small delSingle" data-id="<?php echo ($vo["question_id"]); ?>">
                        <i class="layui-icon">&#x1006;</i> 删除题目
                    </a>
                </div>
            </div>
        </div>
    </div><?php endforeach; endif; else: echo "" ;endif; ?>

    </fieldset>



</div>
	
</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript" src="/Public/static/jsbar/echarts.min.js"></script>
<script type="text/javascript">
	var rooturl = "/";
	var autoCreateurl = "<?php echo U('Home/AutoCreatePaperMgr/showAutoPaper');?>";
    var editAddSingleurl = "<?php echo U('Home/ClassPapersDetialMgr/editAddSingle');?>";
	var testpaper_id = "<?php echo ($testpaper_id); ?>";
    var college_id="<?php echo ($college_id); ?>";
    var lession_id="<?php echo ($lession_id); ?>";
    var type_id="<?php echo ($type_id); ?>";
    var easyNumArray = [<?php echo implode(',',$easyNumArray);?>];
    var normalNumArray = [<?php echo implode(',',$normalNumArray);?>];
    var hardNumArray = [<?php echo implode(',',$hardNumArray);?>];
    var getAnswerurl = "<?php echo U('Home/ClassPapersDetialMgr/getAnswer');?>";
    var changeValueurl = "<?php echo U('Home/ClassPapersDetialMgr/changeValue');?>";
    var deleteurl = "<?php echo U('Home/ClassPapersDetialMgr/deleteSingle');?>";
</script>
<script type="text/javascript" src="/Public/static/js/paperDetial.js"></script>
</html>