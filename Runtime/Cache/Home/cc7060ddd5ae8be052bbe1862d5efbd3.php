<?php if (!defined('THINK_PATH')) exit();?><!--delete？？？-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>成绩查看并分析</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <style>
        .layui-input{
            height: 30px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }

    </style>
</head>
<body>
<div class="admin-main">
    <blockquote class="layui-elem-quote">
        <form class="layui-form" style="height:30px;display: inline-block;margin-left: 6px; min-height: inherit; vertical-align: bottom;">
            <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                <div class="layui-form-pane">
                    <label class="layui-form-label" style="padding: 4px 1px;">所属学院</label>
                    <div class="layui-input-inline">
                        <select name="col"  required lay-filter="" id="colid">
                            <option value=""></option>
                            <?php if(is_array($college)): $i = 0; $__LIST__ = $college;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$co): $mod = ($i % 2 );++$i;?><option value="<?php echo ($co["id"]); ?>" <?php if(($co["id"]) == $college_id): ?>selected="selected"<?php endif; ?>><?php echo ($co["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class=" layui-input-block" style="display: inline-block; margin-left: 5px; vertical-align: bottom;">
                <div class="layui-form-pane">
                    <label class="layui-form-label" style="padding: 4px 1px;">试卷类型</label>
                    <div class="layui-input-inline">
                        <select class="select_paper" name="type" required lay-filter="" id="typeid">
                            <option value=""></option>
                            <?php if(is_array($testType)): $i = 0; $__LIST__ = $testType;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tt): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tt["value"]); ?>" <?php if(($tt["value"]) == $type_id): ?>selected="selected"<?php endif; ?>><?php echo ($tt["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit;vertical-align: top;">
                <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
            </div>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="search" style="vertical-align: top;">
                <i class="layui-icon">&#xe615;</i> 搜索
            </a>
            <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll" style="margin-left: 2px;vertical-align: top;">
                <i class="layui-icon">&#xe615;</i> 查看全部
            </a>
        </form>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>成绩查询</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>序号</th>
                    <th>试卷名称</th>
                    <th>类型</th>
                    <th>所属学院</th>
                    <th>考试时间</th>
                    <th>使用班级（行课班级）</th>
                    <th>参考人数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($paperList)): if(is_array($paperList)): $k = 0; $__LIST__ = $paperList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pl): $mod = ($k % 2 );++$k;?><tr>
                        <td><?php echo ($k); ?></td>
                        <td><?php echo ($pl["name"]); ?></td>
                        <td><?php echo ($pl["typename"]); ?></td>
                        <td><?php echo ($pl["collegename"]); ?></td>
                        <td><?php echo ($pl["testtime"]); ?></td>
                        <td><?php echo ($pl["coursename"]); ?></td>
                        <td><?php echo ($pl["factstu"]); ?></td>
                        <td><a href="javascript:;" data-courseid="<?php echo ($pl["courserclass_id"]); ?>" data-id="<?php echo ($pl["id"]); ?>" class="layui-btn layui-btn-mini detail">查看详情</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                <?php else: ?>
                <tr><td colspan="6">暂时未找到数据！</td></tr><?php endif; ?>
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
    var rooturl = "/";
    var listurl = "<?php echo U('Home/ScoreAnalysis/paperScoreList');?>";
    var keyword = "<?php echo ($keyword); ?>";
    var pages = "<?php echo ($pages); ?>";
    var curr = "<?php echo ($requestPage); ?>";
    var college_id = "<?php echo ($college_id); ?>";
    var type_id = "<?php echo ($type_id); ?>";
    var detailurl = "<?php echo U('Home/ScoreAnalysis/detailScore');?>";
</script>
<script type="text/javascript" src="/Public/static/js/scoreClassList.js"></script>
</body>
</html>