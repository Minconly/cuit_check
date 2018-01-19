<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <link rel="stylesheet" href="/Public/static/layui/css/layui.css" media="all">
  <style type="text/css">
  .lable-box{
    font-family: '微软雅黑';
    font-size: 10;
  }
   .inputbox{
    padding: 15px; 
 }

.layui-table {
    background-color: #fff;
    margin: 10px 0;
    width: 60%;
}
.oldtest{
  float: left;
  margin-left: 10px;
  width: 30%;
}
</style>
</head>
<body>
<div style="margin: 20px;">
<div style="float: left; width: 68%;">
  <form class="layui-form" style="padding: 0px;">
<input type="hidden" name="courserclass_id" id="courserclass_id" value="<?php echo ($courseclassid); ?>">
  <label class="layui-form-label  lable-box">测试时间:</label>
      <div class="layui-form-pane">
       <div class="layui-input-inline">
         <input class="layui-input" placeholder="开始时间" id="start_time" name="start_time" style="height:30px; line-height:30px;"  readonly="true">
         </div>
         <div class="layui-input-inline">
          <input class="layui-input" placeholder="结束时间" id="end_time" name="end_time" style="height:30px; line-height:30px;" readonly="true">
        </div>
   </div>
  <div class="layui-form-item">
    <label class="layui-form-label  lable-box">试卷选择:</label>
    <?php if($ber2 == 1): ?><p>暂无可分配试卷,请先出卷！</p>
    <?php else: ?>
  <table class="layui-table" width="500px;">
  <thead>
    <tr>
      <th width="40%">试卷名</th>
      <th width="20%">试卷总分</th>
      <th width="20%">及格成绩</th>
      <th width="20%">选择</th>
    </tr> 
  </thead>
  <tbody>
    <?php if(is_array($papersList)): $i = 0; $__LIST__ = $papersList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
      <td><?php echo ($vo["name"]); ?></td>
      <td><?php echo ($vo["full_score"]); ?></td>
      <td><?php echo ($vo["pass_score"]); ?></td>
      <td> 
      <input type="radio" name="testpaper_id" id="testpaper_id" value="<?php echo ($vo["id"]); ?>" title="勾选">
      </td>
    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
  </tbody>
</table><?php endif; ?>
   </div>
  <div class="layui-form-item btn">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="test_btn">提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
</div>
<div class="oldtest">
<fieldset class="layui-elem-field">
  <legend>该班已分配试卷</legend>
  <div class="layui-field-box">
    <blockquote class="layui-elem-quote">已测试试卷 <span style="font-size: 0.8em;color: #2795e9">*小提示：只展示最近测试的卷子</span></blockquote>
    <?php if($ber == 1): ?><p>暂无数据！</p>
    <?php else: ?>
     <table class="layui-table" style="width: 300px;">
      <thead>
        <tr>
          <th width="40%">试卷名称</th>
          <th width="30%">考试时间</th>
          <th width="30%">结束时间</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($oldtest)): $i = 0; $__LIST__ = $oldtest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo["paper_name"]); ?></td>
          <td><?php echo ($vo["start_time"]); ?></td>
          <td><?php echo ($vo["end_time"]); ?></td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table><?php endif; ?>
    <hr class="layui-bg-blue">
    <blockquote class="layui-elem-quote">还未测试试卷</blockquote>
      <?php if($ber3 == 1): ?><p>暂无数据！</p>
    <?php else: ?>
      <table class="layui-table" style="width: 300px;">
      <thead>
        <tr>
          <th width="25%">试卷名称</th>
          <th width="20%">考试时间</th>
          <th width="40%">操作</th>
        </tr> 
      </thead>
      <tbody>
        <?php if(is_array($nowtest)): $i = 0; $__LIST__ = $nowtest;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
          <td><?php echo ($vo["paper_name"]); ?></td>
          <td><?php echo ($vo["start_time"]); ?></td>
          <td> <a href="javascript:;" data-id="<?php echo ($vo["testpaper_id"]); ?>" data-course_id="<?php echo ($vo["courserclass_id"]); ?>" data-time="<?php echo ($vo["start_time"]); ?>" class="layui-btn layui-btn-mini nowedit">编辑</a>
               <a href="javascript:;" data-id="<?php echo ($vo["testpaper_id"]); ?>" data-course_id="<?php echo ($vo["courserclass_id"]); ?>" data-time="<?php echo ($vo["start_time"]); ?>" class="layui-btn layui-btn-danger layui-btn-mini nowdel">删除</a>
          </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
      </tbody>
    </table><?php endif; ?>
  </div>
</fieldset>
</div>
</div>
<!-- <script src="/Public/static/layui/layui.js"></script> -->
<script type="text/javascript">
    var editurl = "<?php echo U('Home/courseclassMgr/edittest');?>";
    var isurl = "<?php echo U('Home/courseclassMgr/istest');?>";
    var deleteurl = "<?php echo U('Home/courseclassMgr/deletetest');?>";
</script>
        <script src="/Public/static/layui/layui.js"></script>
</body>
</html>
<script type="text/javascript">
layui.use(['form','laydate','laypage','layer'], function(){
  var form = layui.form(),
   laydate = layui.laydate,
   laypage=layui.laypage,
   layer=layui.layer,
  $ = layui.jquery;
  form.render(); //更新全部
  form.render('select');
 //监听提交
  var start = {
    istime: true, 
    format: 'YYYY-MM-DD hh:mm:ss', 
    festival: false,
      choose: function(datas){
        end.min = datas; //开始日选好后，重置结束日的最小日期
        end.start = datas //将结束日的初始值设定为开始日
      }
    };
    
    var end = {
      istime: true, 
    format: 'YYYY-MM-DD hh:mm:ss', 
    festival: false,
      choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
      }
    };

    document.getElementById('start_time').onclick = function(){
      start.elem = this;
      laydate(start);
    }
    document.getElementById('end_time').onclick = function(){
      end.elem = this
      laydate(end);
    }

  form.on('submit(test_btn)', function(data) {
    var courseid = $("#id").val();
    var start_time = $("#start_time").val();
    var end_time = $("#end_time").val();
     var val=$('input:radio[name="testpaper_id"]:checked').val();
    // alert(paperid); 
    if (start_time==''||end_time=='') {
        layer.msg('请选择测试时间',{icon:5});
          return false;
    }else if(val==null) {
          layer.msg('请选择测试试卷',{icon:5});
          return false;
    }
    else{
    $.ajax({

      url:"<?php echo U('Home/courseclassMgr/coursepaper');?>",
      type: 'POST',
      data: data.field,
      error: function(request){
        layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success: function(data){
        if (data.success){
          layer.msg('提交成功', {
            time: 1000
          }, function(){
            parent.location.href="<?php echo U('Home/courseclassMgr/courseclassList');?>";
          });
        }else{
          layer.msg(data.msg, {
            time: 1000,icon:5
          });
        }
      }
    });
      return false;
 }
  });

$('.nowdel').on('click', function(){
    var id = $(this).data('id');
    var time = $(this).data('time');
    var courseclassid=$(this).data('course_id');
 $.ajax({
      url: isurl,
      type: 'POST',
      data: {'id': id,'time':time},
      error: function(request){
          layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success:function(data){
          if(data.success){
               layer.confirm('确定删除该试卷?', {
                  btn: ['确定', '取消']
                }, function(){
                  $.ajax({
                    url: deleteurl,
                    type: 'POST',
                    data: {'id': id,'courseclassid':courseclassid},
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
          }else{
            layer.msg(data.msg, {
              time: 1000,icon:5
            });
          }     
      }
    });
  });


 //编辑按钮功能
  $('.nowedit').on('click', function(){
    var id = $(this).data('id');
    var time = $(this).data('time');
    var courseclassid=$(this).data('course_id');
    $.ajax({
      url: isurl,
      type: 'POST',
      data: {'id': id,'time':time},
      error: function(request){
          layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success:function(data){
          if(data.success){
               layer.open({
                  type: 2,
                  title: ['编辑试卷信息', 'text-align:center;'],
                  content: editurl+"?id="+id+"&courseclassid="+courseclassid,
                  area:['550px', '200px'],  //宽高
                  resize: false,    //是否允许拉伸
                  scrollbar: false,
                  end: function(){
                    location.reload();
                  }
                });
          }else{
            layer.msg(data.msg, {
              time: 1000,icon:5
            });
          }     
      }
    });
    
  });

});
</script>