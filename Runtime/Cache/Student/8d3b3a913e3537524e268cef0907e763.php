<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>能力考核系统</title>
<meta name="description" content="针对java考试和c语言考核、学生平时练习和评测、收集学生成绩以及学习情况的收集和分析的一个在线考核系统">
<meta name="keywords" content="个人主页,编程练习">
    <link rel="stylesheet" href="/Public/student/css/common.css">
    <link rel="stylesheet" href="/Public/student/css/login.css">
    <link href="/Public/student/css/tab.css">
    <link href="/Public/student/css/platform-1.css">
    <link href="/Public/student/css/easyform.css">
    <link href="/Public/student/font-awesome/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
	<header class="nav-bar">
    	<div class="nav">
        	<img src="/Public/student/images/logo.png" alt="logo">
            <a href="#" class="nl-sign">NLKH &nbsp;&nbsp;&nbsp;能力考核系统（学生）</a>
        </div>
    </header>
    <div class="content">
    	<div class="pic_show">
        	<img src="/Public/student/images/compu2.png">
        </div>
     	
            <div class="login_box">
                <div class="form">
                    <div id="landing" ><i class="fa fa-user-o fa-fw"></i>&nbsp;登录</div>
                    <div class="fix"></div>
                    <form action="" method="" id="login_frm">
                    <div id="landing-content">
                        <div class="inp" style="margin-top: 50px;">
                            <input type="text" placeholder="请输入账号" name="login_account" id="login_account" style="padding-left: 0px;font-size: 14px;"/>
                        </div>
                        <div class="inp">
                            <input type="password" placeholder="请输入密码" name="login_password" id="login_password" style="padding-left: 0px;font-size: 14px;"/>
                        </div>
                        <div class="inp">
                             <div><img src="/Student/LoginMgr/verify" onclick="changecode()" id="change2" style="width: 118px;  height: 31px; cursor:pointer; float: left; " title="点击刷新"></div>
                              <input type="text" placeholder="验证码" name="code" id="code" style="float: right; font-size: 14px; width: 76px; padding-left: 0px;"/>
                        </div>
                        <div class="login" id="login_btn">登录</div>
                    </form>
                </div>
            </div>
        
    </div>
    
</div> 
</body>
</html>
<script src="/Public/student/js/jquery-3.1.1.min.js"></script>
<script src="/Public/student/js/easyform.js"></script>
<script src="/Public/static/layui/layui.js"></script>
<script>
			$(document).ready(function() {
				
				$(".form").slideDown(500);
				
				$("#landing").addClass("border-btn");
			});
</script>
<script>

    $(document).ready(function ()
    {
        var v = $('#login_frm').easyform();

        $('#login_frm').easyform();

        v.is_submit = false;

        v.error = function (ef, i, r)
        {
            //console.log("Error事件：" + i.id + "对象的值不符合" + r + "规则");
        };

        v.success = function (ef)
        {
            //console.log("成功");
        };

        v.complete = function (ef)
        {
            console.log("完成");
        };
    });
layui.use('layer',function(){
   var layer = layui.layer;
    
    $('#login_btn').click(function(event) {
        var account = $("#login_account").val();
        var password = $("#login_password").val();
        var code= $("#code").val();
        if (account==""||password=="") {
            layer.msg('用户名或密码不能为空!',{icon:5},function(){
               changecode();
            });
        }else{
            if (code=="") {
              layer.msg('请输入验证码!',{icon:5},function(){
                    changecode(); 
              });  
            }
            else{

             $.ajax({
                  url: "<?php echo U('Student/LoginMgr/checklogin');?>",
                  type: 'POST',
                  data: {
                            account: account,
                            password:password,
                            code:code,
                         },
                  error: function(request){
                    layer.msg("请求服务器超时", {time: 1000, icon: 5});
                  },
                  success: function(data){
                    if (data.status){
                      layer.msg('登陆成功', {time: 1000},function(){
                        parent.location.href="<?php echo U('indexMgr/index');?>";
                      });
                    }else{
                      layer.msg(data.msg, {time: 1000,icon:5},function(){
                        changecode();
                      });
                    }
                  }
                });
                
            }
        }
    });
    });
function changecode(){
        var code  =document.getElementById("change2");
        code.src=code.src+'/Student/LoginMgr/verify';
}
</script>