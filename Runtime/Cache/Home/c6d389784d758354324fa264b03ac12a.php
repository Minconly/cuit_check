<?php if (!defined('THINK_PATH')) exit();?>          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
<div>
	<form class="layui-form" action="">
	<input type="hidden" name="id" id="id" value="<?php echo ($group_data['id']); ?>">
		<div class="layui-form-item">
		<table class="layui-table">
		 <tbody>
		  <?php if(is_array($rule_data)): foreach($rule_data as $key=>$v): ?><tr>	
		      <td width="15%;">
		      <input type="checkbox" class="cb_all" name="rules<?php echo ($v['id']); ?>" title="<?php echo ($v['title']); ?>" value="<?php echo ($v['id']); ?>" <?php if(in_array($v['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?>>
		      </td>
		      <td class="111">
		      <?php if(is_array($v['children'])): foreach($v['children'] as $key=>$n): ?><input type="checkbox" class="cb_other" name="rules<?php echo ($n['id']); ?>" title="<?php echo ($n['title']); ?>" value="<?php echo ($n['id']); ?>" <?php if(in_array($n['id'],$group_data['rules'])): ?>checked="checked"<?php endif; ?>><?php endforeach; endif; ?>
	      	  </td>
		    </tr><?php endforeach; endif; ?>
		   </tbody>
		</table>
	  </div>
	  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="pushRule">提交</button>
    </div>
  	</div>
	</form>
</div>
        <script src="/Public/static/layui/layui.js"></script>
<script src="/Public/student/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
</script>
<script type="text/javascript">
layui.use(['form','jquery'], function() {
    var form = layui.form();
  form.on('submit(pushRule)', function(data) {
  	$.ajax({

      url: "<?php echo U('Home/SysuserGroup/changerule');?>",
      type: 'POST',
      data: data.field,
      error: function(request){
        layer.msg("请求服务器超时", {time: 1000, icon: 5});
      },
      success: function(data){
        if (data.status){
          layer.msg('分配成功', {
            time: 1000
          }, function(){
            parent.location.href="<?php echo U('Home/SysuserGroup/sysGroupList');?>";
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