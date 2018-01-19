<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>学生主页</title>
	<link rel="stylesheet" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/student/css/common.css">
	<link href="/Public/student/css/index.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="/Public/student/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="/Public/student/css/htmleaf-demo.css">
	<link rel="stylesheet" type="text/css" href="/Public/student/css/insert.css">
	<script src="/Public/student/js/prefixfree.min.js"></script>

	<!--[if IE]>
		<script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<![endif]--><!-- -->
    <style type="text/css">
    	.layui-upload-button {
			position: relative;
			display: inline-block;
			vertical-align: middle;
			min-width: 60px;
			height: 38px;
			margin-left: 35%;
			line-height: 38px;
			border: 1px solid #DFDFDF;
			border-radius: 2px;
			overflow: hidden;
			background-color: #fff;
			color: #666;
}
    </style>
</head>
<body>
<div class="indexBox">
	<!--头文件-->
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


	<div class="bodyBox">
    	<div class="bodysidebar_Box">
        	<div class="sidebarIMGBox">
            	<div class="sidebarIMG"> <?php if(($person["photo"]) == ""): ?><img class="ui medium circular image" src="/Public/student/images/public.png" />
					<?php else: ?>
					<img class="ui medium circular image" src="http://cuitcheck.cn/<?php echo ($person["photo"]); ?>" /><?php endif; ?></div>
            </div>
        	<!--<div class="sidebarNAME"><?php echo ($person["name"]); ?></div>-->
            <div class="sidebarEDITBox">
            	<input type="file" name="photo" id="photo" lay-title="上传头像" class="layui-upload-file">
            </div>
			<div class="" style="margin-left: 20px;">
				<a class="ui teal image label" style="margin: 10px;">
					<i class="User icon middle aligned"></i>
					<?php echo ($person["name"]); ?>
					<div class="detail">student</div>
				</a>
				<a class="ui blue image label" style="margin: 10px;">
					<i class="Heterosexual icon middle aligned"></i>
					<?php if($person['sex'] == 1): ?>男
						<?php else: ?>
						女<?php endif; ?>
					<div class="detail">sex</div>
				</a>
				<a class="ui grey image label" style="margin: 10px;">
					<i class="phone icon middle aligned"></i>
					<?php echo ($person["phone"]); ?>
					<div class="detail">phone</div>
				</a>
			</div>

            <!--公告-->
				<div class="ui segment" style="margin-top: 31%;margin-left: 8px;margin-right: 8px;">
					<div class="ui top attached label">
						<div class="ui label">
							<h4 class="ui header"><i class="mail icon large middle aligned"></i> 信息公告</h4>
						</div>
					</div>
						<div class="ui relaxed divided list" style="padding-top: 30px;">
							<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="item">
								<i class="large Announcement middle aligned icon"></i>
								<div class="content">
									<a class="header" href="<?php echo U('student/FormMgr/gg_detail');?>?id=<?php echo ($vo["id"]); ?>"><?php echo ($vo["title"]); ?><i class="fa-fw"></i></a>
								</div>
								<div class="right floated content">
									<div class="description"><?php echo (date('Y-m-d',strtotime($vo["greatedate"]))); ?></div>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
				</div>
            <div class="sideNOTICEmore"><a href="<?php echo U('student/FormMgr/gonggao');?>">查看更多<i class="icon Angle Double Right"></i></a></div>

        </div>

        <div class="bodyMain_Box">
        <!--begin-->
		  <div class="tab-group">

		    <section id="tab1" title="考试记录" >
           		<div class="mianBodyshow">
   		<div class="testListBox">

        	<div class="testLheader">
				<h4 class="ui horizontal header divider">
				<i class="bar chart icon"></i>
					考试记录
				</h4>
			</div>

			<div class="nl-choice">
				<div class="ui form">
					<div class="field">
						<label>类型</label>
						<select class="ui dropdown" id='record_type' lay-filter="record_type">
							<option value="">选择类型</option>
							<option value="all">全部</option>
							<option value="1">课堂测试</option>
							<option value="2">正式考试</option>
						</select>
					</div>
				</div>
			</div>

			<div id='recordlist' class="ui cards" style="margin-left: 2%;">
				<!-- <div class="ui card" style="margin-left: 2%;">
					<div class="content">
						<div class="header">JAVA考试</div>
					</div>
					<div class="content">
						<h4 class="ui sub header">出题人：lxh</h4>
						<div class="ui small feed">
							<div class="event">
								<div class="content">
									<div class="summary">
										试卷总分：100
									</div>
								</div>
							</div>
							<div class="event">
								<div class="content">
									<div class="summary">
										及格分：60
									</div>
								</div>
							</div>
							<div class="event">
								<div class="content">
									<div class="summary">
										考试时间：2017-06-25
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="extra content" style="text-align: center;">
						<button id='record_detail' class="ui button">考试已经结束</button>
					</div>
				</div> -->
				
			</div>

				<div id="record_page" style="text-align: center;margin-top:20px;margin-bottom: 20px;"></div>
        </div>
   
   </div>
		    </section>

		    <section id="tab2" title="参加考试">
            
		  <div class="mianBodyshow">
			  <!--begin-->
<div class="testListBox">
    <div class="testLheader">
        <h4 class="ui horizontal header divider">
            <i class="newspaper icon"></i>
            试卷选择
        </h4>
    </div>
    <!--begin-->
    <div class="nl-choice">
        <div class="ui form">
            <div class="field">
                <label>类型</label>
                <select class="ui fluid selection dropdown" id="paperListType">
                    <option value="">选择类型</option>
                    <option value="0">全部</option>
                    <option value="1">课堂测试</option>
                    <option value="2">正式考试</option>
                </select>
            </div>
        </div>
    </div>
    <div id="canjia_test">

    </div>
    <!--end-->
    <!--分页begging-->
    <div id="nl-page2" style="text-align: center;margin-top:20px;margin-bottom: 20px;"></div>
</div>
<!--end-->



          	
          </div>
            
		    </section>
		    <section id="tab3" title="课程信息">
            
		     <div class="mianBodyshow">
             <!--课程信息begin-->
             <div class="testListBox">
             <div class="testLheader">
				 <h4 class="ui horizontal header divider">
					 <i class="Checkmark Box icon"></i>
					 已选课程
				 </h4>
			 </div>
             <!--begin-->
				 <div style="margin-top: 20%;">
					 <div class="testList">
						 <div class="testListLeft">
							 <div class="classNameBorder"><div class="className1">C语言程序设计</div></div>

						 </div>
						 <div class="testListRight">
							 <div class="classInTmp"></div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;任课教师：张星星</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课时间：周三下午7,8节</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课地点：1108</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;课程内容：了解程序基础</div>



						 </div>
					 </div>
					 <!--end-->
					 <!--begin-->
					 <div class="testList">
						 <div class="testListLeft">
							 <div class="classNameBorder"><div class="className2">形势与政策</div></div>

						 </div>
						 <div class="testListRight">
							 <div class="classInTmp"></div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;任课教师：泡菜鱼</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课时间：周二下午7,8节</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课地点：1106</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;课程内容：分析专业发展前景</div>



						 </div>
					 </div>
					 <!--end-->
					 <!--begin-->
					 <div class="testList">
						 <div class="testListLeft">
							 <div class="classNameBorder"><div class="className1">大学英语4</div></div>

						 </div>
						 <div class="testListRight">
							 <div class="classInTmp"></div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;任课教师：吴诗心</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课时间：周一下午7,8节</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;上课地点：1208</div>
							 <div class="testMessage"><font color="#666">●</font>&nbsp;课程内容：英语</div>



						 </div>
					 </div>
					 <!--end-->
				 </div>
                   <!--分页begging-->
                   <div id="page-show3" style="text-align: center;margin-top:20px;margin-bottom: 20px;"></div>
                 </div>
             <!--课程信息end--->
             
             </div>
              
		    </section>
		    <section id="tab4" title="个人信息">
		     <div class="mianBodyshow">
             
             <!--begin-->
             
             <div class="at-container">
			<div class="at-main">
			
	<div class="at-content">
				<div class="module-box">
					
					<div class="module-body">
						<div class="info-box">
							<div class="profile-caption">
								<h4 class="ui horizontal header divider">
									<i class="edit icon"></i>
									个人信息
								</h4>
							</div>
						</div>
						<!--<div class="nl-personType">-->
							<!--<div class="blue ui buttons">-->
								<!--<div class="ui button">基本信息</div>-->
								<!--<div class="ui button">密码信息</div>-->
							<!--</div>-->
						<!--</div>-->

						<form>
						<input type="hidden" name="id" id="id" value="<?php echo ($person["id"]); ?>">
							<div class="info-edit">
								<div class="nl-personInfoform">
									<dl>
										<dt><i class="fa fa-user fa-fw"></i>&nbsp;姓名</dt>
										<dd>
											<input type="text" id="name" name="name" disabled="true" value="<?php echo ($person["name"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-venus-mars fa-fw"></i>&nbsp;性别</dt>
											<dd>
										<?php if($person['sex'] == 1): ?><input class="gender-edit" type="radio" name="sex" id="sex" value="1" disabled="true" checked > 男
											<input class="gender-edit" type="radio" name="sex" id="sex" disabled="true" value="0" > 女
									    <?php else: ?>
											<input class="gender-edit" type="radio" name="sex" id="sex" disabled="true" value="1"> 男
											<input class="gender-edit" type="radio" name="sex" id="sex" disabled="true" value="0" checked> 女<?php endif; ?>
											</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-building-o fa-fw"></i>&nbsp;学院</dt>
										<dd>
											<input type="text" id="account" name="dept" disabled="true" value="<?php echo ($person["college_name"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-Map Signs fa-fw"></i>&nbsp;专业</dt>
										<dd>
											<input type="text" id="major" name="major" disabled="true" value="<?php echo ($person["major_name"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-database fa-fw"></i>&nbsp;年级</dt>
										<dd>
											<input type="text" id="2" name="grade" disabled="true" value="<?php echo ($person["grade_name"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-home fa-fw"></i>&nbsp;班级</dt>
										<dd>
											<input type="text" id="1" name="class" disabled="true" value="<?php echo ($person["class_name"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-mobile fa-fw"></i>&nbsp;联系方式</dt>
										<dd>
											<input type="text" id="phone" name="phone" value="<?php echo ($person["phone"]); ?>">
										</dd>
									</dl>
									<dl>
										<dt><i class="fa fa-envelope-open-o fa-fw"></i>&nbsp;邮箱</dt>
										<dd>
											<input type="text" id="email" name="email" value="<?php echo ($person["email"]); ?>">
										</dd>
									</dl>
								</div>

								<button class="edit_btn" id="btn">保存</button>
							</div>

						</form>
					</div>

				</div>
			</div>


			</div>
			</div>
             <!--end-->
		 </div>
</section>
		    <section id="tab5" title="修改密码">
		       <div class="mianBodyshow">
                   <div class="testListBox">
    <div class="somepanel">
        <div class="testLheader">
            <h4 class="ui horizontal header divider">
                <i class="eyedropper icon"></i>
                修改密码
            </h4>
        </div>
        <div class="modify-form">
            <form class="ui form" id="pswForm">
                <input type="hidden" name="id" id="id" value="<?php echo ($person["id"]); ?>">
                <div class="field">
                    <label>原密码：</label>
                    <input type="password" name="oldPassword" placeholder="请输入原密码" id="old">
                </div>
                <div class="field">
                    <label>新密码：</label>
                    <input type="password" name="newPassword" placeholder="请输入新密码,6-16个字符" id="new" name="new">
                </div>
                <div class="field">
                    <label>再次输入密码：</label>
                    <input type="password" name="renewPassword" placeholder="请再次输入原密码" id="renew">
                </div>
                <button class="ui blue button" id="savePsw" style="margin-top: 20px;">保存</button>
            </form>
        </div>
    </div>
</div>
               </div>
		    </section>
             
		 </div>
		
        
        <!--end-->

        
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


</div>



	<script src="/Public/student/js/jquery-3.1.1.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="/Public/student/js/jquery-tab.js"></script>
	<script src="/Public/student/SemanticUI/semantic.min.js"></script>

	<script>
		//这里统一写接口地址
		var canjia_testUrl = "<?php echo U('Student/TestPaper/paperList');?>";
		var detailInfoUrl = "<?php echo U('Student/TestPaper/getThePaper_info');?>";
		var guoduUrl = "<?php echo U('Student/TestPaper/detailInfo');?>";
		var recordlist = "<?php echo U('Student/TestRecord/getRecord');?>";	// 考试记录
		var recordDetail = "<?php echo U('Student/TestRecord/detail');?>";		// 记录详情
	</script>
	<script src="/Public/static/layui/layui.js"></script>
	<!--将每个json接口与js交互分装到单独的js里，注意id或类名-->
	<script src="/Public/student/js/canjia_test.js"></script>
	<script src="/Public/student/js/record.js"></script>
	<script type="text/javascript">
		$(function(){
			// Calling the plugin
			$('.tab-group').tabify();
			$('.ui.dropdown').dropdown();

		})
	</script>
</body>
<script type="text/javascript">
	// function loginout(){
	//  if(confirm("确认退出吗？")){  
 //        return true;  
 //    }  
 //   		 return false;
	// }
	$('#loginout').click(function(event) {
		layer.confirm('确定退出吗？',{ title:false,icon:3,
		   btn:['确定','取消'] 
		   		},function(){ 
			$.get("<?php echo U('Student/loginMgr/loginout');?>",function(){
				 parent.location.href = "<?php echo U('loginMgr/login');?>";
			});
		},function(){

		});
	});
	 // href="<?php echo U('Student/loginMgr/loginout');?>" 
</script>
<script type="text/javascript">
layui.use(['layer','upload'],function(){
   var layer = layui.layer;
	   layui.upload({
		  url: "<?php echo U('Student/indexMgr/upimage');?>"
		  ,before: function(input){
 			$('.layui-upload-file').after( '<input type="hidden" name="userid" value="<?php echo ($person["id"]); ?>"/>' );
 			layer.msg('正在上传中!',{time: 1000});
 		 }
		  ,success: function(res){
				if(res.code==1){
					layer.msg('头像上传失败!',{time:1000,icon:3},function(){
						location.reload();
					});
				}else{
					layer.msg('头像上传成功!',{time:1000,icon:6},function(){
						location.reload();
					});
				}
		  }
	});      
	$('#btn').click(function(event) {
	    var id = $("#id").val();
	    var phone = $("#phone").val();
	    var email = $("#email").val();
	    if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(phone))){ 
       		layer.msg('手机号码格式不正确!',{icon:5});
       		    return false;
    	}else if(!(/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email))){
    		layer.msg('邮箱格式不正确!',{icon:5});
    		    return false;
    	}else{
  		 $.ajax({
                 url :"<?php echo U('Student/indexMgr/editPersonInfo');?>",
                 type: 'POST',
                 data: {
                 		   studentid:id,
                           phone: phone,
                           email:email,
                         },
                  error: function(request){
                    layer.msg("请求服务器超时", {time: 1000, icon: 5});
                  },
                  success: function(data){
                    if (data.status){
                      layer.msg('保存成功', {time: 1000});
                    }else{
                      layer.msg(data.msg, {time: 1000});
                    }
                  }
           });
  		 }
    return false;
});

	$('#savePsw').click(function(event) {
		var id = $("#id").val();
	    var oldPassword = $("#old").val();
	    var newPassword = $("#new").val();
	    var renewPassword = $("#renew").val();
	    if(oldPassword==""){
	    	layer.msg('原密码不能为空',{icon:5});
	    	return false;
	    }else if((newPassword=="")||(renewPassword=="")){
	    	layer.msg('新密码不能为空',{icon:5});
	    	return false;
	    }else{
	    	if(!(/^[\S]{6,16}$/.test(newPassword))){
	    		layer.msg('密码必须6到16位，且不能出现空格!',{icon:5});
       		    return false;
       		}else{
	    	 $.ajax({
                 url :"<?php echo U('Student/indexMgr/chengepsw');?>",
                 type: 'POST',
                 data: {
                 			studentid:id,
                 		   oldPassword:oldPassword,
                           newPassword:newPassword,
                           renewPassword:renewPassword,
                         },
                  error: function(request){
                    layer.msg("请求服务器超时", {time: 1000, icon: 5});
                  },
                  success: function(data){
                    if (data.status){
                      layer.msg('修改成功', {time: 1000},function(){
						location.reload();
					});
                    }else{
                      layer.msg(data.msg, {time: 1000});
                    }
                  }
           });
	    }
	    	  return false;
	    }
});

});
</script>

</html>