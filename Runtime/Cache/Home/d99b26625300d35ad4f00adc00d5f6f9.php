<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
<title></title>
           <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
 <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
 <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
</head>
<body>
<center><h3 style="font-size: 20px;"><?php echo ($informShow["title"]); ?></h3></center>
<input type="hidden" name="id" id="id" value="<?php echo ($informShow["id"]); ?>">
<p style="float: left; margin-top: 20px; text-align: center;"><span style="margin-left: 120px;"></span>来源:<?php echo ($informShow["dept_name"]); ?><span style="margin-left: 20px;"></span>发布人:<?php echo ($informShow["greateby"]); ?><span style="margin-left: 20px;"></span>发布时间:<?php echo ($informShow["greatedate"]); ?></p><center>
<hr style="width: 80%;">
</center>
<br>
<p>
<pre>
<span style="margin-left: 20px;"><span style="margin-left: 120px;"></span><?php echo htmlspecialchars_decode($informShow['content']) ?></span>
</pre>
</p>
<p style="float: right; margin-right: 80px;"><a href="<?php echo U('Home/InformMgr/informdown');?>?id=<?php echo ($informShow["id"]); ?>" title="附件下载"><?php echo ($informShow["file_name"]); ?></a></p>
</body>
        <script src="/Public/static/layui/layui.js"></script>
</html>