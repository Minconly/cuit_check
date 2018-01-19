<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>编辑题目</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
           <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
       <link href="//at.alicdn.com/t/font_1uad1y953bfyldi.css" rel="stylesheet">

</head>
<body>

<style type="text/css">


/*.left{
 padding-top: 50px;
 float: left;
 clear: both;
}
.right{
  float: right;
  clear: both;
  padding-top: 50px;
  padding-right: 160px;
}*/
.layui-form-item::after {
    /*clear: none;*/
}
.layui-form-item {
    width: 30%;
    clear: none;
    margin-bottom: 15px;
}

.input_narrow{
      margin-left: 0;
}
/*.layui-input-block, .layui-input-inline {
    display: inline-block;
}*/


</style>

<div class="admin-main">

    <form class="layui-form">


            <input type="hidden" name="testdb_id" value="<?php echo ($testdb_id); ?>" />
            <input type="hidden" name="del_flag" value="1">
            <input type="hidden" name="id" value="<?php echo ($id); ?>">


            <div class="layui-input-block" style="display: inline-block; margin-left:20px;">
            <label class="layui-form-label">题目类型</label>
              <div class="layui-input-inline">
                <select id="type" name="type" lay-verify='required' lay-filter="type">
                    <option value="" selected=""></option>
                    <option value="1" <?php if(($question["type"]) != "1"): ?>disabled<?php endif; ?> <?php if(($question["type"]) == "1"): ?>selected<?php endif; ?> >选择</option>
                    <option value="2" <?php if(($question["type"]) != "2"): ?>disabled<?php endif; ?> <?php if(($question["type"]) == "2"): ?>selected<?php endif; ?> >判断</option>
                    <option value="3" <?php if(($question["type"]) != "3"): ?>disabled<?php endif; ?> <?php if(($question["type"]) == "3"): ?>selected<?php endif; ?> >填空</option>
                </select>
              </div>
            </div>
            

            <div class="layui-input-block input_narrow" style="display: inline-block;">
            <label class="layui-form-label">题目难度</label>
             <div class="layui-input-inline">
                <select id="level" name="level" lay-verify='required'>
                    <option value="" selected=""></option>
                    <option value="1" <?php if(($question["level"]) == "1"): ?>selected<?php endif; ?> >简单</option>
                    <option value="2" <?php if(($question["level"]) == "2"): ?>selected<?php endif; ?> >普通</option>
                    <option value="3" <?php if(($question["level"]) == "3"): ?>selected<?php endif; ?> >困难</option>
                </select>
              </div>
            </div>
    


            <div class="layui-input-block input_narrow" style="display: inline-block;">
            <label class="layui-form-label">相关知识点</label>
            <div class="layui-input-inline">
                  <select id="knowledge" name="knowledgeIds" multiple="multiple">
                      <option value="" selected=""></option>
                      <?php if(is_array($knowledge)): $i = 0; $__LIST__ = $knowledge;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"  <?php if(in_array(($vo["id"]), is_array($question["knowledge_ids"])?$question["knowledge_ids"]:explode(',',$question["knowledge_ids"]))): ?>selected<?php endif; ?> ><?php echo ($vo["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                  </select>
            </div>
            </div>




            <div class="layui-form-item" style="width: 100%; padding-top: 150px;">
                <label class="layui-form-label">题干</label>
                <div class="layui-input-block">
                    <textarea id="content" style="display: none;"><?php echo ($question["content"]); ?></textarea>
                    <input type="hidden" value="" name="content" id="getContent" />
                </div>
            </div>

            <!-- 选择题 -->
          <div class="type_1" style="display: none">
            <div class="layui-form-item">
               <label class="layui-form-label">答案A</label>
                <div class="layui-input-block">
                    <input type="text" name="answer1" placeholder="请输入A答案" autocomplete="off" class="answer1 layui-input" <?php if(($question["type"]) == "1"): ?>value="<?php echo ($answer['0']['content']); ?>"<?php endif; ?> >
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">答案B</label>
                <div class="layui-input-block">
                    <input type="text" name="answer2" placeholder="请输入B答案" autocomplete="off" class="answer2 layui-input" <?php if(($question["type"]) == "1"): ?>value="<?php echo ($answer['1']['content']); ?>"<?php endif; ?> >
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">答案C</label>
                <div class="layui-input-block">
                    <input type="text" name="answer3" placeholder="请输入C答案" autocomplete="off" class="answer3 layui-input" <?php if(($question["type"]) == "1"): ?>value="<?php echo ($answer['2']['content']); ?>"<?php endif; ?> >
                </div>
            </div>

            <div class="layui-form-item">
              <label class="layui-form-label">答案D</label>
                <div class="layui-input-block">
                    <input type="text" name="answer4" placeholder="请输入D答案" autocomplete="off" class="answer4 layui-input" <?php if(($question["type"]) == "1"): ?>value="<?php echo ($answer['3']['content']); ?>"<?php endif; ?> >
                </div>
            </div>

              <div class="layui-form-item">
                <label class="layui-form-label">选择正确答案</label>
                <div class="layui-input-block">
                  <input type="radio" name="select" value="1" title="A" <?php if(($question["type"]) == "1"): if(($answer[0]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                  <input type="radio" name="select" value="2" title="B" <?php if(($question["type"]) == "1"): if(($answer[1]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                  <input type="radio" name="select" value="3" title="C" <?php if(($question["type"]) == "1"): if(($answer[2]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                  <input type="radio" name="select" value="4" title="D" <?php if(($question["type"]) == "1"): if(($answer[3]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                </div>
              </div>
          </div>

            <!-- 判断题 -->
            <div class="type_2" style="display: none">
              
              <div class="layui-form-item">
                <label class="layui-form-label">该答案是否正确</label>
                <div class="layui-input-block">
                  <input type="radio" name="answerjudge" value="true"  title="正确" <?php if(($question["type"]) == "2"): if(($answer[0]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                  <input type="radio" name="answerjudge" value="false" title="错误" <?php if(($question["type"]) == "2"): if(($answer[1]['is_true']) == "1"): ?>checked<?php endif; endif; ?> >
                </div>
              </div>

            </div>

            <!-- 填空题 -->
            <div class="type_3" style="display: none">
              <div class="layui-form-item">
                <label class="layui-form-label">答案</label>
                  <div class="layui-input-block">
                      <input type="text" name="answertian" placeholder="请输入答案" autocomplete="off" class="answer layui-input" <?php if(($question["type"]) == "3"): ?>value="<?php echo ($answer[0]['content']); ?>"<?php endif; ?> >
                      <div class="layui-form-mid layui-word-aux">多个答案请用 "()" 隔开.如"(java)(c++)"</div>
                  </div>
              </div>
            </div>

            <div class="layui-form-item">
              <div class="layui-input-block">
                  <button class="layui-btn addOne" data-type="content" lay-submit lay-filter="addOne">修改</button>
                  <button type="reset" class="layui-btn layui-btn-primary reset">重置</button>
              </div>
            </div>

            
          
    </form>
    


</div>
        <script src="/Public/static/layui/layui.js"></script>
<script src="/Public/static/js/layui-mz-min.js"></script>
<script type="text/javascript">

  var rooturl = "/";
  var uploads = "<?php echo U('Home/DetailTestDBMgr/uploads');?>";
  var editAction = "<?php echo U('Home/DetailTestDBMgr/editAction');?>";

  var testdb_id = "<?php echo ($testdb_id); ?>";
  var init_type = "<?php echo ($question["type"]); ?>";

</script>
<script type="text/javascript">

layui.use([ 'layer','layedit','form','element'], function() {
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        element = layui.element();
        // 多选项
        layui.selMeltiple($);
        // 编辑器
        var layedit = layui.layedit;

        var index = layedit.build('content',{
          height:250,
          tool: ['strong','italic','del','underline','|','left', 'center', 'right', '|', 'image'],
            uploadImage: {
               url: uploads //接口url
              ,type: 'post' //默认post
            }
        });;
        // 获得文本内容
        var active = {
          content: function(){
            // alert(layedit.getContent(index)); //获取编辑器内容
            // 将文本赋给hidden进行表单提交
            $("#getContent").val(layedit.getContent(index));
          }
        };

        $('.addOne').on('click', function(){
          var type = $(this).data('type');
          active[type] ? active[type].call(this) : '';
        });


        // 答案内容显示
        $(".type_"+init_type).css('display', '');
        $('.type_'+init_type+" :text").attr("lay-verify","required");
       

        // 题目类型联动
        form.on('select(type)', function(data){
          var type_id = data.value;

          for (var i = 1; i <= 3; i++) {
            // 初始化
            $(".type_"+i).css('display', 'none');

            // 当前选择的类型
            if(type_id == i) {
              $(".type_"+type_id).css('display', '');
              $('.type_'+type_id+" :text").attr("lay-verify","required");
            } else {
              // 其他类型
              $(".type_"+i).css('display', 'none');
              $('.type_'+i+" :text").attr("lay-verify","none");
              $('.type_'+i+" :text").val("");
              $('.type_'+i+" :radio").removeAttr("checked");

            }
          }
        });

        // 表单提交
        form.on('submit(addOne)', function(data){
          var da = data.field;
          console.log(da);
          

            layer.confirm('确定修改该题目?', {
                btn: ['确定', '取消']
            }, function(){
                $.ajax({
                    url:editAction,
                    type:"POST",
                    data:data.field,
                    beforeSend: function(){
                        //
                    },
                    success:function(data2)
                    {
                        if(data2.status){
                            // 关闭当前窗口
                            layer.msg(data2.msg, {time: 3000,icon: 1},function(){
                              var index = parent.layer.getFrameIndex(window.name);
                              parent.layer.close(index);
                            });
                        }else {
                            layer.msg(data2.msg, {time: 3000,icon: 2});
                        }
                    },
                    error: function(){
                        layer.msg('请求服务器超时', {time: 3000,icon: 2});
                    }
                });
            },function(){});


          return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });


        // 重置按钮
        $(".reset").click(function(){
          location.reload();
        });







});
</script>


</body>
</html>