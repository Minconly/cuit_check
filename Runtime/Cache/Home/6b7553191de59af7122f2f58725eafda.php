<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
	<meta name="renderer" content="webkit"> 
    <meta name="renderer" content="webkit"> 
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  
		<meta name="viewport" content="width=device-width, initial-scale=1, 	maximum-scale=1"> 
		<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
		<meta name="apple-mobile-web-app-capable" content="yes">  
		<meta name="format-detection" content="telephone=no"> 
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	       <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/Public/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/Public/static/css/main.css">
	<style type="text/css">
		.show {
			cursor: pointer;
		}
	</style>
</head>
<body>
	<div class="admin-main main-wrapper">
		<div class="container-fluid">
			<div class="row groupInfo">
				<div class="col-md-4">
					<section class="panel">
						<div class="formal color1">
							<i class="fa fa-group"></i>
						</div>
						<div class="value">
							<a href="#">
								<h1><?php echo ($teacher_count); ?></h1>
							</a>
							<p>入驻老师数量</p>
						</div>						
					</section>
				</div>
				<div class="col-md-4">
					<section class="panel">
						<div class="formal color3">
							<i class="fa fa-user"></i>
						</div>
						<div class="value">
							<a href="#">
								<h1><?php echo ($stu_count); ?></h1>
							</a>
							<p>入驻学生数量</p>
						</div>						
					</section>
				</div>
				<div class="col-md-4">
					<section class="panel">
						<div class="formal color2">
							<i class="fa fa-user"></i>
						</div>
						<div class="value">
							<a href="#">
								<h1>30658K</h1>
							</a>
							<p>测试数量</p>
						</div>						
					</section>
				</div>
				<div class="col-xs-6 col-sm-4 col-md-2"></div>
				<div class="col-xs-6 col-sm-4 col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<section class="panel">
						<div class="panel-heading"><i class="fa fa-bell-o"></i>
							通知公告<span class="badge" style="background-color:#FF3333;">new</span>
							 <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe619;</i></a>
						</div>
						<div class="panel-body">
							<?php if(is_array($informList)): $i = 0; $__LIST__ = $informList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$in): $mod = ($i % 2 );++$i;?><a class="show" data-id="<?php echo ($in["id"]); ?>"><p class="text-left"><h5><?php echo ($in["title"]); ?></h5></p></a>
								<p class="text-right"><small><?php echo (date('Y-m-d',strtotime($in["greatedate"]))); ?></small></p>
								<hr><?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</section>

					<section class="panel">
						<div class="panel-heading">
							系统信息
							 <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe619;</i></a>
						</div>
						<div class="panel-body">
							<table class="table table-hover personal-task">
								<tbody>
								<tr>
									<td>
										<strong>版本信息</strong>： 版本名称：能力考核系统 版本号: V1.0

									</td>
									<td>

									</td>
								</tr>
								<tr>
									<td>
										<strong>开发作者</strong>： Really 6 teams

									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>网站域名</strong>：暂未定义
									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>网站目录</strong>：未定义
									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>服务器IP</strong>：未定义
									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>服务器环境</strong>：CentOS+Apache
									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>数据库版本</strong>： Mysql5.7

									</td>
									<td></td>
								</tr>
								<tr>
									<td>
										<strong>最大上传限制</strong>： 未定义

									</td>
									<td></td>
								</tr>
								<tr>
									<td></td>
								</tr>
								</tbody>
							</table>
						</div>
					</section>
				</div>
				<div class="col-md-6">
					<section class="panel">
						<div class="panel-heading">
                        数据统计
                        <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe619;</i></a>
                    	</div>
                    	<div class="panel-body">
                       	<div class="admin-echarts" id="echarts-stats"></div>
                   		</div>
					</section>					
				</div>
				<div class="col-md-6">
					 <section class="panel">
						<div class="panel-heading">
                        日期
                        <a href="javascript:;" class="pull-right panel-toggle"><i class="layui-icon">&#xe619;</i></a>
                    	</div>
                    	<div class="panel-body">
                    	<div class="calendar" id="mycalendar" style="height: 200px;"></div>
                   		</div>
					</section>
				</div>
			</div>
		</div>
	</div>
	        <script src="/Public/static/layui/layui.js"></script>
	<script type="text/javascript" src="/Public/static/jsbar/echarts.min.js"></script>
	<script type="text/javascript" src="/Public/static/js/main.js"></script>
	
	<script type="text/javascript">
		layui.use(['jquery','layer','element'],function(){
		window.jQuery = window.$ = layui.jquery;
		window.layer = layui.layer;
        window.element = layui.element();

       $('.panel-toggle').click(function(){
       	   var obj = $(this).parent('.panel-heading').next('.panel-body');
            if (obj.css('display') == "none") {
                $(this).find('i').html('&#xe619;');
                obj.slideDown();
            } else {
                $(this).find('i').html('&#xe61a;');
                obj.slideUp();
            }
        });
       $('.show').on('click',function() {
	    var id = $(this).data('id');
	     layer.open({
	      type: 2,
	      title: ['最新通知'],
	      content: "<?php echo U('Home/InformMgr/informShow');?>"+"?id="+id,
	      area:['800px', '400px'],  //宽高
	      resize: false,    //是否允许拉伸
	      scrollbar: false,
	      maxmin: true,
	      end: function(){
	        
	      }
	    });

  });

	});

	</script>
	
</body>

</html>