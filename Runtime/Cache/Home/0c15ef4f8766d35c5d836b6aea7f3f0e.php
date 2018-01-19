<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>知识点管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css">
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

    <style>
        .layui-input{
            height: 30px;
            width: 140px;
        }
        .my-input .layui-input{
                height: 38px;
        }
        .my-input .layui-form-label{
            /*width: 140px;*/
        }
        .courseList{
            margin-top: 10px;
        }
         .layui-form-select{
             width: 80%; /*     调整select的宽度*/
         }
        .layui-tree li a cite {
            padding: 0 6px;
            font-size: 12px;
        }
        .notice {
            display: none;
            float: left;
            height: 75px;
            width: 330px;
            overflow: hidden;
            background: #5FB878;
            padding: 10px;
            border-radius: 5px;
        }
        .notice span {
            padding-top:50%;
            color: white;
        }
    </style>
</head>

<body>
<div class="admin-main">
    <blockquote class="layui-elem-quote">
        <form class="layui-form" action="" style="display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
        <!--<a href="javascript:;" class="layui-btn layui-btn-small addSingle">-->
            <!--<i class="layui-icon">&#xe608;</i> 添加知识点-->
        <!--</a>-->
        <?php if($select_show == true): ?>您当前所查看的学院是：
            <span style="margin-left: 5px;font-size: 1.1em;">

            <div class="layui-input-inline theSelect" style="height: 30px;width: 140px;">
                <select name=""  placeholder="Select Task Type" id="demo-col">
                    <?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
                <a href="javascript:;" class="layui-btn layui-btn-small cut">
                    <i class="layui-icon">&#xe623;</i> 切换学院
                </a>
            </span>
            <?php else: endif; ?>
        <a href="javascript:;" class="layui-btn layui-btn-small addList">
            <i class="layui-icon">&#xe608;</i> 导入知识点
        </a>

        <!--<div class=" layui-input-block" style="display: inline-block; margin-left: 30px; vertical-align: bottom;">-->
            <!--<div class="layui-form-pane courseList">-->
                <!--<label class="layui-form-label" style="padding: 4px 1px;">选择课程</label>-->
                <!--<div class="layui-input-inline">-->
                    <!--<select name="course_id" lay-verify="">-->
                        <!--<option value="" >选择课程</option>-->
                        <!--<?php if(is_array($course)): $i = 0; $__LIST__ = $course;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                            <!--<option value="<?php echo ($vo["id"]); ?>" ><?php echo ($vo["name"]); ?></option>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                        <!--<option value="" >无</option>-->
                    <!--</select>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
            <input type="text" name="keyword" id="keyword" lay-verify class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;">
        </div>

        <a href="javascript:;" class="layui-btn layui-btn-small" lay-submit lay-filter="submit2" id="search">
            <i class="layui-icon" >&#xe615;</i> 搜索
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
            <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
    </form>
    </blockquote>

    <fieldset class="layui-elem-field">
        <legend>知识点列表</legend>
        <div class="container-fluid">
            <div class="grid-4">
                <ul id="chapterTree" style="background-color:#fbfbfb;border-radius: 10px;">
                    <span style="font-size: 0.8em;color: #2795e9">*小提示：一级为学科，二级为课程，三级为章节</span>
                </ul>
            </div>
            <div class="grid-8" style="background-color:#fbfbfb;height: auto;border-radius: 10px;">
                <div id="knowledgeItem" style="width: 100%; min-height: 450px;">
                    <div class="" style="margin-left: 10%;margin-top: 30%">
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;margin-left: 25%;border:1px;">
                            <legend>请选择点击左侧章节或者课程进行查看 知识点 详细信息</legend>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>

</div>
<!--<div style="display: none" id="windows1">-->
        <!--<form class="layui-form">-->
            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">名称</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" name="name" lay-verify="title" autocomplete="on" placeholder="知识点名" class="layui-input" style="width:80%;"  value="">-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">所属章节</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<select name="chapter_id" lay-verify="chapter">-->
                        <!--<option value="">请选择章节</option>-->

                        <!--<?php if(is_array($chapter)): $i = 0; $__LIST__ = $chapter;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>-->
                            <!--<optgroup label="<?php echo ($vo["name"]); ?>">-->
                                <!--<?php if(is_array($vo["children"])): $i = 0; $__LIST__ = $vo["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?>-->
                                   <!--<option value="<?php echo ($vo2["id"]); ?>"  ><?php echo ($vo2["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            <!--</optgroup>-->
                        <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->

                    <!--</select>-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="layui-form-item">-->
                <!--<label class="layui-form-label">备注</label>-->
                <!--<div class="layui-input-block">-->
                    <!--<input type="text" name="comment" maxlength="25" lay-verify="title" autocomplete="off" placeholder="最多25字" class="layui-input" style="width:80%;" value="<?php echo ((isset($sysuser["remarks"]) && ($sysuser["remarks"] !== ""))?($sysuser["remarks"]):''); ?>">-->
                <!--</div>-->
            <!--</div>-->

            <!--<div class="layui-form-item">-->
                <!--<div class="layui-input-block">-->
                    <!--<button class="layui-btn" lay-submit="" lay-filter="demo3">保存</button>-->
                    <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                <!--</div>-->
            <!--</div>-->

        <!--</form>-->
<!--</div>-->
</body>
<div class="notice">
    <div class="" style="margin-top: 5%;margin-left: 12px;">
        <span>请点击课程或者章节，您点击的是学科哦！</span>
    </div>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script>
    var editurl = "<?php echo U('Home/KnowledgeMgr/editKnowledge');?>";
    var updateurl = "<?php echo U('Home/KnowledgeMgr/updateKnowledge');?>";
    var listurl = "<?php echo U('Home/KnowledgeMgr/knowledges');?>";
    var addurl = "<?php echo U('Home/KnowledgeMgr/addKnowledge');?>";
    var deleteurl = "<?php echo U('Home/KnowledgeMgr/deleteKnowledge');?>";
    var importurl = "<?php echo U('Home/KnowledgeMgr/showImportKnow');?>";
    var rooturl = "/";
</script>
<script type="text/javascript" src="/Public/static/js/knowledgeList.js"></script>
</html>