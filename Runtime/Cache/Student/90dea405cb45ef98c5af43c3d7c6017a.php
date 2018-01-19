<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>能力考查系统</title>
<meta name="description" content="针对java考试和c语言考核、学生平时练习和评测、收集学生成绩以及学习情况的收集和分析的一个在线考核系统">
<meta name="keywords" content="个人主页,编程练习">
<link rel="stylesheet" href="/Public/student/css/gonggao.css">
<link rel="stylesheet" href="/Public/student/css/common.css">
<link rel="stylesheet" href="/Public/student/css/minepage.css">
<link rel="stylesheet" href="/Public/static/layui/css/layui.css">
<style type="text/css">
    .layui-btn {
    background-color: #00b188;
    border: medium none;
    border-radius: 2px;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    font-size: 14px;
    height: 38px;
    line-height: 38px;
    opacity: 0.9;
    padding: 0 18px;
    text-align: center;
    white-space: nowrap;
}
    .bodyBox{
        height: 99%;
    }
</style>
</head>
<body>
<head>
    <link rel="stylesheet" href="/Public/student/css/header_foot.css">
    <link rel="stylesheet" href="/Public/student/SemanticUI/semantic.min.css">
    <link href="/Public/student/font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>
<div class="headerBox">
    <img src="/Public/student/images/logo.png" alt="logo">
    <a href="#" class="nl-sign">NLKH &nbsp;&nbsp;&nbsp;能力考核系统（学生）</a>
    <div class="nl-logout">
        <button class="ui teal button" id="loginout" name="loginout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;退出</button> 
    </div>
</div>


<div class="container bodyBox">
	<!--<header class="nav-bar">-->
    	<!--<div class="nav">-->
        	<!--<img src="/Public/student/images/111.png" alt="logo">-->
            <!--<a href="#">N&nbsp;L&nbsp;K&nbsp;C</a>-->
        <!--</div>-->
    <!--</header>-->

       <button class="layui-btn" id="back" name="back" style="margin-top: 20px; float: left; margin-bottom: 20px;" onclick="javascrtpt:window.location.href='<?php echo U('student/indexMgr/index');?>'"><i class="layui-icon">&#xe603;</i>返回主页</button> 
    <div class="content">
    	<div class="ggs_box">
        	<div class="gg_header">
            	<!--<h3>公&nbsp;告&nbsp;栏</h3>-->
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
  <legend>公告栏</legend>
</fieldset>
            </div>
            <div class="gg_body">
            	<div id="demo8"></div>
            	<ul id="biuuu_city_list">
                <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                    	<h3><a href="<?php echo U('student/FormMgr/gg_detail');?>?id=<?php echo ($vo["id"]); ?>" title="点击查看详情"><?php echo ($vo["title"]); ?></a></h3>
               			<span><?php echo ($vo["greatedate"]); ?></span>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>
                 <div class="pages" style="text-align: center; margin-top:20px;  margin-bottom: 20px;"><?php echo ($page); ?></div>
    </div>
</div>
<div class="footBox">
    <div class="nl-foot-sign">
        <p>
            @&nbsp;BY CUIT <br>
            <span style="font-size: 15px;margin-top: 5px;">四川成都&nbsp;|&nbsp;成都信息工程大学版权所有</span>
        </p>
    </div>
</div>
</body>
</html>