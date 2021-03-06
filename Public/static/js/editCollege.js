layui.config({
	base: rooturl+'Public/static/js/'
}).use(['form'], function() {
	var form = layui.form(),
		layer = layui.layer,
		$ = layui.jquery;

	//自定义验证规则
	form.verify({
		name: function(value) {
			if(value == "") {
				return '学院名称不能为空';
			}
		},
		leadername: function(value){
			if (value == ""){
				return '负责人姓名不能为空';
			}
		}
	});

	//监听提交
	form.on('submit(demo1)', function(data) {
		// layer.alert(JSON.stringify(data.field), {
		// 	title: '最终的提交信息'
		// });
		// var index = parent.layer.getFrameIndex(window.name);
		// parent.layer.close(index);
		$.ajax({
			url: editurl,
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
						var index = parent.layer.getFrameIndex(window.name);
						parent.layer.close(index);
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