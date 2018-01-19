<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
</head>
<body>
<form class="layui-form" enctype="multipart/form-data">
<input type="hidden" name="id" id="id" value="<?php echo ($informedit["id"]); ?>">
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-block">
      <input type="text" style="width: 90%;" id="title" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input" value="<?php echo ($informedit["title"]); ?>">
    </div>
  </div>
  <div class="layui-form-item">
    <label class="layui-form-label">附件</label>
    <div class="layui-input-inline">
      <input type="file" id="filename" name="filename" value="" size="50" class="layui-upload-file">
    </div>
    </div>
  <div class="layui-form-item">
    <label class="layui-form-label">发送对象</label>
    <div class="layui-input-block">
      <input type="radio" id="sendtype" name="sendtype" value="1" title="学生" <?php if($informedit['sendtype'] == 1): ?>checked<?php endif; ?>>
      <input type="radio" id="sendtype" name="sendtype" value="2" title="老师" <?php if($informedit['sendtype'] == 2): ?>checked<?php endif; ?>>
      <input type="radio" id="sendtype" name="sendtype" value="3" title="全体师生" <?php if($informedit['sendtype'] == 3): ?>checked<?php endif; ?>>
    </div>
  </div>
  <div class="layui-form-item layui-form-text">
   <label class="layui-form-label">通知内容</label>
  <div class="layui-input-block">
    <textarea id="content" name="content" class="layui-textarea" style="width:900px;height:300px;"><?php echo ($informedit["content"]); ?></textarea>
  </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
    <center>
      <button class="layui-btn" lay-submit lay-filter="change_btn" style="margin-top: 40px;">修改</button>
      </center>
    </div>
  </div>
</form>
          <script src="/Public/static/layui/layui.js"></script>
</body>
</html>
<script charset="utf-8" src="/Public/static/kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="/Public/static/kindeditor/lang/zh_CN.js"></script>
<!-- <script>
        KindEditor.ready(function(K) {
                window.editor = K.create('#content',{
                cssPath : '/Public/static/kindeditor/plugins/code/prettify.css',
                uploadJson : '/Public/static/kindeditor/php/upload_json.php',
                fileManagerJson : '/Public/static/kindeditor/php/file_manager_json.php',
                allowFileManager : true,
          });
        });
</script> -->
    <!-- 配置文件 -->
<script type="text/javascript">
    KindEditor.ready(function(K) {
         window.editor = K.create('#content',{
           cssPath : '/Public/static/kindeditor/plugins/code/prettify.css',
            uploadJson : '/Public/static/kindeditor/php/upload_json.php',
            fileManagerJson : '/Public/static/kindeditor/php/file_manager_json.php',
           allowFileManager : true,
            afterCreate : function(){ 
              this.sync();   
           },
            afterChange: function(){ 
              this.sync();   
           },
           afterBlur : function(){this.sync();}
          });
  });
</script>
<script type="text/javascript">
  var fileurl="";
  var filename="";
 layui.use(['layer','form','jquery','upload'],function(){
  var layer = layui.layer,
  form = layui.form(),
  $ = layui.jquery;
   layui.upload({
      method:'post',
      url: "<?php echo U('Home/InformMgr/attachment');?>",
      ext: 'xls||xlsx|txt|doc|docx',
      title: '上传附件',
    success: function(res){
         if(res.code == 1){
            layer.msg(res.msg);
          }else {
            layer.msg(res.msg);
            filename=res.name.name;
            fileurl = res.data.src;
            // window.location.reload();
         }
      }
    });
  form.on('submit(change_btn)', function(data){

    $.ajax({
      url: "<?php echo U('Home/InformMgr/updateinform');?>",
      type: 'POST',
      data: {
        title:$("#title").val(),
        content:$("#content").val(),
        sendtype:$("#sendtype").val(),
        id:$("#id").val(),
        file_url:fileurl,
        file_name:filename,
     },

      error: function(request){
        layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success: function(data){
        if (data.success){
          layer.msg('修改成功', {
            time: 1000
          }, function(){
            parent.location.href="<?php echo U('Home/InformMgr/informList');?>";
          });
        }else{
          layer.msg(data.msg, {
            time: 1000
          });
        }
      }
    });
    
    return false;
  });
  });
</script>