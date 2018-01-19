<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>添加单个题目</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
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
            width: 70%; /*     调整select的宽度*/
        }
        .add-titile {
            padding: 5px 0px;
            width: 80px;
        }
        .add-titile:after {
            padding: 5px 0px;
            width: 80px;
            border: dashed 1px red;
        }
        .layui-form-select {
            width: 200px;
        }
    </style>
</head>
<body>
	
	<div class="admin-main layui-form">
		<form class="my-form" action="">
        <blockquote class="layui-elem-quote">
            <div class=" layui-input-block" style="display: inline-block; margin-left: 10px; vertical-align: bottom;">
                <div class="layui-form-pane courseList">
                    <label class="layui-form-label" style="padding: 4px 1px;">选择题库</label>
                    <div class="layui-input-inline ">
                        <select name="database_id" id="database_id" class="database_id" lay-verify="" lay-filter="filter1">
                            <option value="" selected="">选择题库</option>
                            <?php if(is_array($DbList)): $i = 0; $__LIST__ = $DbList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>"><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class=" layui-input-block" style="display: inline-block; margin-left: 10px; vertical-align: bottom;">
                <div class="layui-form-pane courseList">
                    <label class="layui-form-label" style="padding: 4px 1px;">选择章节</label>
                    <div class="layui-input-inline ">
                        <select id="chapter_id" name="chapter_id" multiple="multiple" class="chapter_id"  lay-filter="filter2">
                            <option value="" >选择章节</option>
                        </select>
                    </div>
                </div>
            </div>

            <a href="javascript:;" class="layui-btn layui-btn-small" id="query" style="background-color: #1E9FFF;display: inline-block">
                查询
            </a>
            <!--<a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" id="searchAll">-->
            <!--<i class="layui-icon">&#xe615;</i> 生成-->
            <!--</a>-->
        </blockquote>

        <fieldset class="layui-elem-field">
                <!--<legend>学院列表</legend>-->
                <div class="layui-field-box">
                    <table class="site-table table-hover">
                        <colgroup>
                            <col width="26%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="10%">
                            <col width="15%">
                            <col width="10%">
                        </colgroup>
                        <thead>
                        <tr>
                            <th>题干</th>
                            <th>所属章节</th>
                            <th>所属题库</th>
                            <th>题目难度</th>
                            <th>题目类型</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($questionlist)): if(is_array($questionlist)): $i = 0; $__LIST__ = $questionlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>                    
                                <td><?php echo ($vo["content"]); ?></td>
                                <td><?php echo ($vo["chapter"]); ?></td>
                                <td><?php echo ($vo["name"]); ?></td>
                                <td><?php switch($vo["level"]): case "1": ?>简单<?php break;?>
                                	<?php case "2": ?>普通<?php break;?>
                                	<?php case "3": ?>困难<?php break; endswitch;?></td>
                                <td><?php switch($vo["type"]): case "1": ?>选择<?php break;?>
                                	<?php case "2": ?>判断<?php break;?>
                                	<?php case "3": ?>填空<?php break;?>
                                	<?php case "4": ?>编程<?php break; endswitch;?></td>
                                <td>
                                    <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini addSinger">添加</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        <?php else: ?>
	                        <tr><td colspan="6">暂没有数据，或该题库数据已被添加。请选择条件后再查询</td></tr><?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </fieldset>
    </form>
	</div>

</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript" src="/Public/static/js/layui-mz-min.js"></script>
<script type="text/javascript">
	var rooturl = "/";
	var getbd = "<?php echo U('Home/ClassPapersDetialMgr/getList');?>";
    var getlession="<?php echo U('Home/ClassPapersDetialMgr/getlessionlist');?>";
	var queryurl = "<?php echo U('Home/ClassPapersDetialMgr/queryList');?>";
	var addSingerurl = "<?php echo U('Home/ClassPapersDetialMgr/addSinger');?>";
	var college_id="<?php echo ($college_id); ?>";
	var testpaper_id = "<?php echo ($testpaper_id); ?>";
</script>
<script type="text/javascript" src="/Public/static/js/addSingerQuestion.js"></script>
</html>