<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>系统用户管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

</head>
<body>

<div class="admin-main">

    <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small add">
            <i class="layui-icon">&#xe608;</i> 添加系统用户
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small batchadd">
            <i class="layui-icon">&#xe60a;</i> 批量导入
        </a>    
        <!--<div class="layui-input-block" style="display: inline-block;margin-left: 30px; min-height: inherit; vertical-align: bottom;">-->
            <!--<div class="layui-form-pane">-->
                <!--<label class="layui-form-label" style="padding: 4px 15px;">时间范围</label>-->
                <!--<div class="layui-input-inline">-->
                    <!--<input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" style="height:30px; line-height:30px;" readonly="true">-->
                <!--</div>-->
                <!--<div class="layui-input-inline">-->
                    <!--<input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" style="height:30px; line-height:30px;"  readonly="true">-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->
        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
            <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;">
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
            <i class="layui-icon">&#xe615;</i> 搜索
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
            <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
    </blockquote>
    <fieldset class="layui-elem-field">
        <legend>系统用户列表</legend>
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>账号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>手机号</th>
                    <th>角色</th>
                    <th>是否启用</th>
                    <th>所属学院</th>
                    <th >备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($sysUserList)): $i = 0; $__LIST__ = $sysUserList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                        <td><?php echo ($vo["account"]); ?></td>
                        <td><?php echo ($vo["name"]); ?></td>
                        <td><?php if(($vo["sex"]) == "1"): ?>男<?php else: ?>女<?php endif; ?></td>
                        <!--<td><img src="<?php echo ($vo["photo"]); ?>" alt="<?php echo ($vo["photo"]); ?>" style="height:45px;width:45px;"></td>-->
                        <td><?php echo ((isset($vo["phone"]) && ($vo["phone"] !== ""))?($vo["phone"]):'无'); ?></td>
                        <td><?php echo ($vo["role"]); ?></td>
                        <td><?php if(($vo["status"]) == "1"): ?>是<?php else: ?>否<?php endif; ?></td>
                        <td><?php echo ($vo["dept_id"]); ?></td>
                        <td style="max-width: 100px">
                            <div style="width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo ((isset($vo["remarks"]) && ($vo["remarks"] !== ""))?($vo["remarks"]):'无'); ?></div>
                        </td>
                        <td>
                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                            <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="" class="layui-btn layui-btn-normal layui-btn-mini resetps">重置密码</a>
                        </td>
                    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>

        </div>
    </fieldset>
    <div class="admin-table-page">
        <div id="page" class="page">
        </div>
    </div>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript">
    var editurl = "<?php echo U('Home/SysuserManage/editSysUser');?>";
    var addurl = "<?php echo U('Home/SysuserManage/addSysUser');?>";
    var listurl = "<?php echo U('Home/SysuserManage/sysUserList');?>";
    var deleteurl = "<?php echo U('Home/SysuserManage/deleteSysUser');?>";
    var batchurl="<?php echo U('Home/SysuserManage/importSysUserhtml');?>";
    var resetpsurl = "<?php echo U('Home/SysuserManage/resetpwd');?>";
    var rooturl = "/";

    var pages = "<?php echo ((isset($pages) && ($pages !== ""))?($pages):''); ?>";
    var curr = "<?php echo ((isset($requestPage) && ($requestPage !== ""))?($requestPage):''); ?>";
    var keyword_l = "<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>";
    var beginDate_l = "<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>";
    var endDate_l = "<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>";

</script>
<script type="text/javascript" src="/Public/static/js/sysUserList.js"></script>

</body>
</html>