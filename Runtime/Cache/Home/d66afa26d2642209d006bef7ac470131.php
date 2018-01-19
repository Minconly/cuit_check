<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>行课班级详情</title>
            <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
  <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
  <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
  <style type="text/css">
    .site-table th, .site-table td {
    border: 1px solid #ddd;
    font-size: 14px;
    font-weight: 400;
    line-height: 20px;
    min-height: 20px;
    padding: 6px 95px;
}
  </style>
</head>
<body>
      <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small" id="addsinge" style="margin-left: 10px;" data-course="<?php echo ($courseid); ?>" >
          <i class="layui-icon">&#xe615;</i> 单个添加
        </a>
        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
          <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入姓名" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search" data-course="<?php echo ($courseid); ?>">
          <i class="layui-icon">&#xe615;</i> 查询
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll" data-course="<?php echo ($courseid); ?>">
          <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
         <a href="javascript:;" class="layui-btn layui-btn-normal layui-btn-small" id="leading_in" data-courseid="<?php echo ($courseid); ?>" style="float: left;">
          <i class="layui-icon">&#xe621;</i> 批量导入
        </a>
      </blockquote>
      <fieldset class="layui-elem-field">
        <legend>该班学生列表</legend>
        <div class="layui-field-box">
          <table class="site-table table-hover">
            <thead>
              <tr>
                <th>学号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php if(is_array($courseDetail)): $i = 0; $__LIST__ = $courseDetail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($vo["account"]); ?></td>
              <td><?php echo ($vo["name"]); ?></td>
              <td> <?php if($vo['sex'] == 0 ): ?>女
              <?php else: ?> 男<?php endif; ?></td>
             <td> <a href="javascript:;" data-id="<?php echo ($vo["account"]); ?>" data-course="<?php echo ($courseid); ?>" data-opt="del" class="layui-btn layui-btn-danger layui-btn-mini del"> 删除</a></td>
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
  var leading = "<?php echo U('Home/courseclassMgr/courseLeadingIn');?>";
  var addsinge = "<?php echo U('Home/courseclassMgr/addsinge');?>";
  var deleteurl="<?php echo U('Home/courseclassMgr/delstu');?>";
  var rooturl = "/";
  // var pages = <?php echo ($pages); ?>;
  // var curr = <?php echo ($requestPage); ?>;
</script>
</body>
</html>
<script type="text/javascript">
layui.use(['layer','form','jquery','laypage'],function(){
  var layer = layui.layer,
  form = layui.form(),
  laypage = layui.laypage,
  $ = layui.jquery;
   //点击搜索按钮的事件处理
  $('#search').on('click', function() {
     var id = $(this).data('course');
    var keyword = $("#keyword").val();
    var searchword = "";

    if (keyword == ""){
      layer.msg('请先输入内容', {time: 1000});
    }else{
        window.location.href="<?php echo U('Home/courseclassMgr/courseDetail');?>"+"?id="+id+"&keyword="+keyword+searchword;
      
    }
  });
  //所有查询事件处理
  $('#searchAll').on('click', function(){
     var id = $(this).data('course');
    window.location.href="<?php echo U('Home/courseclassMgr/courseDetail');?>"+"?id="+id;
  });
  //导入按钮事件处理
   $('#leading_in').on('click',function(){
    var id = $(this).data('courseid');
    layer.open({
      type: 2,
      title: ['批量导入'],
      content: leading+"?id="+id,
      area:['500px', '350px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });

   });

  //单个学生添加
  $('#addsinge').on('click', function(){ 
  var id = $(this).data('course'); 
    layer.open({
      type: 2,
      title: ['添加单个学生', 'text-align:center;'],
      content: addsinge+"?id="+id,
      area:['500px', '250px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });
  });

  $('.del').on('click', function(){

    var id = $(this).data('id');
    var courseid=$(this).data('course');
    layer.confirm('确定删除该学生?', {
      btn: ['确定', '取消']
    }, function(){
      $.ajax({
        url: deleteurl,
        type: 'POST',
        dataType: 'json',
        data: {'id': id,'courseid':courseid},
        error: function(request){
          layer.msg("请求服务器超时", {time: 1000, icon: 5});
        },
        success: function(data){
          if (data.success){
            layer.msg("删除成功！", {
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

  })
</script>