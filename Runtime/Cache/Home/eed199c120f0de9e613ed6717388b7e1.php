<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>通知公告</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
	<link rel="stylesheet" href="/Public/static/css/collegeList.css" />
	<style type="text/css">
	.layui-input-inline{
      width: 100px;
      height: 30px;
      line-height: 30px;
    }
    .layui-input, .layui-select,
    .layui-textarea {
    background-color: #fff;
    border: 1px solid #e6e6e6;
    border-radius: 2px;
    height: 30px;
    line-height: 38px;
  }
	</style>
</head>
<body>
	<div class="admin-main">

			<blockquote class="layui-elem-quote">
			<form class="layui-form" style="display: inline-block;margin-left: 10px; min-height: inherit; vertical-align: bottom;">
				<a href="javascript:;" class="layui-btn layui-btn-small push">
					<i class="layui-icon">&#xe608;</i> 发布通知
				</a>
				<span style="margin-left: 20px;">学院:</span>
		        <div class="layui-input-inline long"  >
		        <select style="height:30px; line-height:30px;" name="college" lay-verify="" id="college">
		          <option value=""></option>
              <?php if(is_array($collgelst)): $i = 0; $__LIST__ = $collgelst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option id="collegekey" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
		        </select> 
		        </div>
		        <span style="margin-left: 20px;">发布对象:</span>
		        <div class="layui-input-inline long"  >
		        <select style="height:30px; line-height:30px;" name="duixiang" lay-verify="" id="duixiang">
		          <option value=""></option>
		          <option id="targetkey" value="1">学生</option>
		          <option id="targetkey" value="2">老师</option>
              <option id="targetkey" value="3">全体</option>

		        </select> 
		        </div>
				<div class="layui-input-block" style="display: inline-block;margin-left: 20px; min-height: inherit; vertical-align: bottom;">
					<div class="layui-form-pane">
					<label class="layui-form-label" style="padding: 4px 15px;">发布时间</label>
					<div class="layui-input-inline">
				      <input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" style="height:30px; line-height:30px;"  value="<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>" readonly="true">
				    </div>
				    <div class="layui-input-inline">
				      <input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" style="height:30px; line-height:30px;" value="<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>" readonly="true">
				    </div>
					</div>
				</div>
				<a href="javascript:;" class="layui-btn layui-btn-small" style="margin-left: 20px;" id="search">
					<i class="layui-icon">&#xe615;</i> 搜索
				</a>
				<a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
					<i class="layui-icon">&#xe615;</i> 查看全部
				</a>
				</form>
			</blockquote>
			<fieldset class="layui-elem-field">
				<legend>通知列表</legend>
          <div class="layui-field-box">              
          <table class="site-table table-hover">
						<thead>
							<tr>
								<th style="width: 36%;">标题</th>
								<th>发布时间</th>
                <th>发布对象</th>
								<th>来源</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($informlist)): $i = 0; $__LIST__ = $informlist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td><?php echo ($vo["title"]); ?></td>
								<td><?php echo ($vo["greatedate"]); ?></td>
                <td><?php if($vo['sendtype'] == 1): ?><span class="layui-btn layui-btn-warm layui-btn-mini">学生</span>
                  <?php elseif($vo['sendtype'] == 2): ?><span class="layui-btn layui-btn-mini layui-btn-danger">老师</span>
                  <?php else: ?> <span class="layui-btn layui-btn-normal layui-btn-mini">全体</span><?php endif; ?></td>
								<td><?php echo ($vo["dept_name"]); ?></td>
								<td>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-normal layui-btn-mini show">预览</a>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
									<a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
								</td>
							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</fieldset>
			<div  style="position: fixed;bottom: 0;width: 100%;border-bottom: 1px solid #ddd;left: 0px;">
				<div id="page" class="page">
			</div>
			</div>
	</div>
	        <script src="/Public/static/layui/layui.js"></script>
  <script type="text/javascript">
  var pages = <?php echo ($pages); ?>;
  var curr = <?php echo ($requestPage); ?>;
</script>
</body>
</html>
<script type="text/javascript">
layui.use(['layer','form','jquery','laypage','laydate'],function(){
  var layer = layui.layer,
  form = layui.form(),
  laypage = layui.laypage,
  laydate = layui.laydate,
  $ = layui.jquery;
  var start = {
    istime: true, 
    format: 'YYYY-MM-DD', 
    festival: false,
      choose: function(datas){
        end.min = datas; //开始日选好后，重置结束日的最小日期
        end.start = datas //将结束日的初始值设定为开始日
      }
    }; 
    var end = {
      istime: true, 
    format: 'YYYY-MM-DD', 
    festival: false,
      choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
      }
    };
    
    document.getElementById('beginDate').onclick = function(){
      start.elem = this;
      laydate(start);
    }
    document.getElementById('endDate').onclick = function(){
      end.elem = this
      laydate(end);
    }
    laypage({
    cont: 'page',
    pages: pages ,//总页数
    // skin:'#AF0000',
    skip:true, //显示跳页
    groups: 5, //连续显示分页数
    curr: curr,//获得当前页码
    jump: function(obj, first) {
      //得到了当前页，用于向服务端请求对应数据
      var curr = obj.curr;
      if(!first) {
        window.location.href="<?php echo U('Home/InformMgr/informList');?>"+"?requestPage="+curr;
      }
    }
  });
    //通知发布功能
     $('.push').on('click',function(){
    layer.open({
      type: 2,
      title: ['通知发布'],
      content: "<?php echo U('Home/InformMgr/informPush');?>",
      area:['80%','90%'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      maxmin: true,
      end: function(){
        location.reload();
      }
    });
       });
     //通知搜索功能
  $('#search').on('click',function(event) {

   var collegekey= document.getElementById('college').value; 
   var targetkey=document.getElementById('duixiang').value;
   var beginDate = $('#beginDate').val();
   var endDate = $('#endDate').val();
   // var bd = new Date(beginDate);
   // var ed = new Date(endDate);
   var searchword = "";
     if (collegekey=="" && targetkey=="" && beginDate=="" &&endDate=="") {
          layer.msg('请先选择',{time:1000});
       }
       else{
        searchword = searchword+"?collegekey="+collegekey+"&targetkey="+targetkey+"&beginDate="+beginDate+"&endDate="+endDate;
          window.location.href="<?php echo U('Home/InformMgr/informList');?>"+searchword;
       }    
  });
     //查看全部通知
$('#searchAll').on('click', function(){

    window.location.href="<?php echo U('Home/InformMgr/informList');?>";
  });

    //编辑按钮功能
  $('.edit').on('click', function(){
    var id = $(this).data('id');
    layer.open({
      type: 2,
      title: ['编辑通知信息', 'text-align:center;'],
      content: "<?php echo U('Home/InformMgr/informEdit');?>"+"?id="+id,
      area:['80%','90%'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      maxmin: true,
      end: function(){
        location.reload();
      }
    });
    
  });
  //删除功能
 $('.del').on('click', function(){
    var id = $(this).data('id');
    layer.confirm('确定删除该通知?', {
      btn: ['确定', '取消']
    }, function(){
      $.ajax({
        url: "<?php echo U('Home/InformMgr/informdelete');?>",
        type: 'POST',
        dataType: 'json',
        data: {'id': id},
        error: function(request){
          layer.msg("请求服务器超时", {time: 1000, icon: 5});
        },
        success: function(data){
          if (data.success){
            layer.msg(data.msg, {
              time: 1000
            }, function(){
              location.reload();
            });
          }else{
            layer.msg(data.msg, {
              time: 1000
            });
          }
        }
      });
      
    });
  });
 //通知预览
  $('.show').on('click',function() {
    var id = $(this).data('id');
     layer.open({
      type: 2,
      title: [name+'最新通知'],
      content: "<?php echo U('Home/InformMgr/informShow');?>"+"?id="+id,
      area:['800px', '400px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      maxmin: true,
      end: function(){
        location.reload();
      }
    });

  });

})
</script>