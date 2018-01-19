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
            成绩检索
        </h4>
    </div>
    <div class="main-content">
        <fieldset class="layui-elem-field" style="min-height: 430px;">
            <legend>面板</legend>
            <div class="searchInput">
                <form class="layui-form" id="searchForm" method="POST" action="<?php echo U('ScoreAnalysis/findTheData');?>">
                    <div class="layui-form-item">
                        <label class="layui-form-label">学院：</label>
                        <div class="layui-input-block" style="width: 240px;">
                            <select name="dept_id" id="college" lay-filter="collegeS" required  lay-verify="required">
                                <option value="">请选择学院</option>
                                <?php if(is_array($college_list)): $i = 0; $__LIST__ = $college_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><option value="<?php echo ($co['id']); ?>"><?php echo ($co["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">学科：</label>
                        <div class="layui-input-block" style="width: 240px;">
                            <select name="course_id" id="course" lay-filter="courseS" lay-search required  lay-verify="required">
                                <option value="">请选择学科</option>
                                <!--<?php if(is_array($major_list)): $i = 0; $__LIST__ = $major_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ma): $mod = ($i % 2 );++$i;?>-->
                                <!--<option value="<?php echo ($ma['id']); ?>"><?php echo ($ma["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">课程：</label>
                        <div class="layui-input-block" style="width: 240px;">
                            <select name="lession_id" id="lession" lay-filter="lessionS" lay-search required  lay-verify="required">
                                <option value="">请选择课程</option>
                                <!--<?php if(is_array($grade_list)): $i = 0; $__LIST__ = $grade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gr): $mod = ($i % 2 );++$i;?>-->
                                <!--<option value="<?php echo ($gr['id']); ?>"><?php echo ($gr["name"]); ?></option>-->
                                <!--<?php endforeach; endif; else: echo "" ;endif; ?>-->
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">年级：</label>
                        <div class="layui-input-block" style="width: 240px;">
                            <select name="grade_id" id="grade" lay-filter="gradeS" lay-search required  lay-verify="required">
                                <option value="">请选择年级</option>
                                <?php if(is_array($grade_list)): $i = 0; $__LIST__ = $grade_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$gr): $mod = ($i % 2 );++$i;?><option value="<?php echo ($gr['id']); ?>"><?php echo ($gr["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item">
                        <label class="layui-form-label">试卷：</label>
                        <div class="layui-input-block" style="width: 240px;">
                            <select name="paper_id" id="paper" lay-search>
                                <option value="">请选择试卷</option>
                            </select>
                        </div>
                    </div>
                    <div class="layui-form-item duoxuan">
                        <label class="layui-form-label">行课班级：</label>
                        <div class="layui-input-block" style="width: 500px;" id="courseclass_ids">

                            <!--<input type="checkbox" name="" title="发呆" lay-skin="primary">-->
                            <!--&lt;!&ndash;<select multiple="multiple" lay-verify="required" name="courseclass_ids" id="courseclass">&ndash;&gt;-->
                                <!--&lt;!&ndash;<option value="">请选择行课班级</option>&ndash;&gt;-->
                            <!--&lt;!&ndash;</select>&ndash;&gt;-->
                        </div>
                    </div>
                    <div class="layui-form-item" style="margin-top: 100px;">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="searchNext">搜索</button>
                            <!--<button type="reset" class="layui-btn layui-btn-primary">重置</button>-->
                        </div>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>

</div>
        <script src="/Public/static/layui/layui.js"></script>
<script>
    var rooturl = "";
    var linkselecturl = "<?php echo U('ScoreAnalysis/linkSearch');?>";
    var searchUrl = "<?php echo U('ScoreAnalysis/findTheData');?>";
</script>
<script src="/Public/static/js/layui-mz-min.js" charset="utf-8"></script>
<script src="/Public/static/js/scoreSearch.js"></script>
</body>
</html>