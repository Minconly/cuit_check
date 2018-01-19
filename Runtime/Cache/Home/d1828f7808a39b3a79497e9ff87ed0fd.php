<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>行课班级管理</title>
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
          <form class="layui-form" style="display: inline-block;margin-left: 20px; min-height: inherit; vertical-align: bottom;">
        <a href="javascript:;" class="layui-btn layui-btn-small add">
          <i class="layui-icon">&#xe608;</i> 添加班级
        </a>
        <span>年级:</span>
        <div class="layui-input-inline long"  >
        <select  name="grade" lay-verify="" id="grade">
          <option value=""></option>
          <?php if(is_array($gradelst)): $i = 0; $__LIST__ = $gradelst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option id="gradename" value="<?php echo ($vo["id"]); ?>"><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select> 
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="find">
          <i class="layui-icon">&#xe615;</i> 查询
        </a>
        <div class="layui-input-block" style="display: inline-block;margin-left: 30px; min-height: inherit; vertical-align: bottom;">
          <div class="layui-form-pane">
          <label class="layui-form-label" style="padding: 4px 15px;">时间范围</label>
          <div class="layui-input-inline">
              <input class="layui-input" placeholder="开始日期" id="beginDate" name="beginDate" style="height:30px; line-height:30px;"  value="<?php echo ((isset($beginDate) && ($beginDate !== ""))?($beginDate):''); ?>" readonly="true">
            </div>
            <div class="layui-input-inline">
              <input class="layui-input" placeholder="结束日期" id="endDate" name="endDate" style="height:30px; line-height:30px;" value="<?php echo ((isset($endDate) && ($endDate !== ""))?($endDate):''); ?>" readonly="true">
            </div>
          </div>
        </div>
        <div class="layui-input-block" style="display: inline-block; margin-left: 30px; min-height: inherit; vertical-align: bottom;">
          <input type="text" name="keyword" id="keyword" required lay-verify="keyword" class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;" value="<?php echo ((isset($keyword) && ($keyword !== ""))?($keyword):''); ?>">
        </div>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="search">
          <i class="layui-icon">&#xe615;</i> 搜索
        </a>
        <a href="javascript:;" class="layui-btn layui-btn-small" id="searchAll">
          <i class="layui-icon">&#xe615;</i> 查看全部
        </a>
        </form>
      </blockquote>
      <fieldset class="layui-elem-field">
        <legend>行课班级列表</legend>
        <div class="layui-field-box">
          <table class="site-table table-hover">
            <thead>
              <tr>
                <th>班级名称</th>
                <th>年级名称</th>
                <th>所属课程</th>
                <th>学院名称</th>
                <th>任课老师</th>
                <th>开课状态</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              <?php if(is_array($courseclasslst)): $i = 0; $__LIST__ = $courseclasslst;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
              <td><?php echo ($vo["name"]); ?></td>
              <td><?php echo ($vo["grade_name"]); ?></td>
              <td><?php echo ($vo["lession_name"]); ?></td>
              <td><?php echo ($vo["college_name"]); ?></td>
              <td><?php echo ($vo["teacher_name"]); ?></td>
              <td><?php if((strtotime($vo['end_time']) > $ptime ) AND (strtotime($vo['start_time']) < $ptime)): ?><span class="layui-btn layui-btn-warm layui-btn-mini">行课中</span>
                  <?php elseif((strtotime($vo['start_time']) > $ptime) OR (strtotime($vo['end_time']) > $ptime)): ?><span class="layui-btn layui-btn-mini layui-btn-danger"> 未开课</span>
                  <?php else: ?> <span class="layui-btn layui-btn-disabled layui-btn-mini">已结束</span><?php endif; ?>
                  </td>
                <td>
                   <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-college="<?php echo ($vo["college_id"]); ?>" data-lession="<?php echo ($vo["lession_id"]); ?>" class="layui-btn layui-btn-mini test">课堂测试</a>
                  <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-name="<?php echo ($vo["name"]); ?>" class="layui-btn layui-btn-mini layui-btn-normal detail">详情</a> 
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
  var editurl = "<?php echo U('Home/courseclassMgr/editcourseclass');?>";
  var listurl = "<?php echo U('Home/courseclassMgr/courseclassList');?>";
  var deleteurl = "<?php echo U('Home/courseclassMgr/deletecourseclass');?>";
  var detailurl = "<?php echo U('Home/courseclassMgr/courseDetail');?>";
  var testurl = "<?php echo U('Home/courseclassMgr/corsetest');?>";
  var rooturl = "/";
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
  // alert(gradekey);
  $('.add').on('click', function(){  
    layer.open({
      type: 2,
      title: ['添加行课班级', 'text-align:center;'],
      content: editurl+"?type=add_class",
      area:['550px', '450px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });
  });
//课堂测试页面
 $('.test').on('click', function(){  
     var id = $(this).data('id');
     var college_id = $(this).data('college');
     var lession_id=$(this).data('lession');
   var index = layer.open({
      type: 2,
      title: ['课堂测试', 'text-align:center;'],
      content: testurl+"?corseclassid="+id+"&college_id="+college_id+"&lession_id="+lession_id,
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });
    layer.full(index);
  });
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
        window.location.href=listurl+"?requestPage="+curr;
      }
    }
  });
  //年级查询按钮的事件处理
  $('#find').on('click',function(event) {
   var gradekey= document.getElementById('grade').value; 
     if (gradekey=="") {
          layer.msg('请先选择年级',{time:1000});
       }else{
          window.location.href=listurl+"?gradekey="+gradekey;
       }    
  });
  //点击搜索按钮的事件处理
  $('#search').on('click', function() {
    var keyword = $("#keyword").val();
    var beginDate = $('#beginDate').val();
    var endDate = $('#endDate').val();
    var bd = new Date(beginDate);
    var ed = new Date(endDate);
    var searchword = "";

    if (keyword == ""){
      layer.msg('请先输入内容', {time: 1000});
    }else{
        window.location.href=listurl+"?keyword="+keyword+searchword;
      
    }
  });

  $('#searchAll').on('click', function(){

    window.location.href="<?php echo U('Home/courseclassMgr/courseclassList');?>";
  });

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
  //详情按钮功能
  $('.detail').on('click',function() {
    var id = $(this).data('id');
    var name=$(this).data('name');
     var index =layer.open({
      type: 2,
      title: [name+'班级详情', 'text-align:center;'],
      content: detailurl+"?id="+id,
      area:['1100px', '500px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });
       layer.full(index);
  });
  //编辑按钮功能
  $('.edit').on('click', function(){
    var id = $(this).data('id');
    
    layer.open({
      type: 2,
      title: ['修改班级信息', 'text-align:center;'],
      content: editurl+"?type=update&id="+id,
      area:['550px', '450px'],  //宽高
      resize: false,    //是否允许拉伸
      scrollbar: false,
      end: function(){
        location.reload();
      }
    });
    
  });
  //删除功能
 $('.del').on('click', function(){

    var id = $(this).data('id');
    layer.confirm('确定删除该班级?', {
      btn: ['确定', '取消']
    }, function(){
      $.ajax({
        url: deleteurl,
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

})
</script>