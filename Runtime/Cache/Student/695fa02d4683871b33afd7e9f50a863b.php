<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>能力考查系统</title>
<meta name="description" content="针对java考试和c语言考核、学生平时练习和评测、收集学生成绩以及学习情况的收集和分析的一个在线考核系统">
<meta name="keywords" content="个人主页,编程练习">
<link rel="stylesheet" href="/Public/student/css/gg_detail.css">
<link rel="stylesheet" href="/Public/student/css/common.css">
<link rel="stylesheet" href="/Public/static/layui/css/layui.css">
<style type="text/css">
    .layui-btn {
    background-color:#00b188;
    border: medium none;
    border-radius: 2px;
    color: #fff;
    cursor: pointer;
    display: inline-block;
    height: 38px;
    line-height: 38px;
    opacity: 0.9;
    padding: 0 18px;
    text-align: center;
    white-space: nowrap;
}
</style>
</head>
<body>
<div class="container">
    <div class="content">
    	<div class="gg_header">
        	<h3><?php echo ($inform["title"]); ?></h3>
        </div>
        <span><?php echo ($inform["greatedate"]); ?></span>
        <div class="gg_body">
            <p><?php echo htmlspecialchars_decode($inform['content']) ?></p>
            <p style="float: right; margin-right: 80px;"><a href="<?php echo U('student/FormMgr/formdown');?>?id=<?php echo ($inform["id"]); ?>" title="附件下载"><?php echo ($inform["file_name"]); ?></a></p>
        </div>
    </div>
     <button class="layui-btn" id="back" name="back" style="margin-left: 48%;margin-top: 20px;" onclick="javascript:history.go(-1);">返回</button> 
</div>
</body>
</html>