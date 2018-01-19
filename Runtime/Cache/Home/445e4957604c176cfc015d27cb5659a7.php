<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>菜单管理</title>
	          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
	<link rel="stylesheet" href="/Public/static/css/global.css" media="all">
</head>
<body>
	<div class="admin-main">
      <blockquote class="layui-elem-quote">
        <a href="javascript:;" class="layui-btn layui-btn-small add" data-type='root'>
          <i class="layui-icon">&#xe61f;</i> 新建根菜单
        </a>
      </blockquote>
			<fieldset class="layui-elem-field">
				<legend>菜单列表</legend>
          <div class="layui-field-box">              
          <table class="site-table table-hover">
						<thead>
							<tr>
								<th>菜单名称</th>
								<th>Url</th>
								<th>图标代码</th>
                <th>排序</th>
                <th>操作</th>
							</tr>
						</thead>
						<tbody>
							<?php if(is_array($menuList)): $i = 0; $__LIST__ = $menuList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
								<td style="width: 20%;font-size: 15px;font-weight: bold;"><?php echo ($vo["name"]); ?></td>
                <input type="hidden" name="name_<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["name"]); ?>">
                <input type="hidden" name="url_<?php echo ($vo["id"]); ?>" value="">
                <td style="width: 30%">
                </td>
                <td style="width: 15%">
                  <input type="text" name="icon_<?php echo ($vo["id"]); ?>" class="layui-input" value="<?php echo ($vo["icon"]); ?>">
                </td>
                <td style="width: 5%">
                   <input type="number" name="sort_<?php echo ($vo["id"]); ?>" class="layui-input" value="<?php echo ($vo["sort"]); ?>"
                   onkeyup="value=value.replace(/[^\d]/g,'')">
                </td>
                <td>
                    <a  data-id="<?php echo ($vo["id"]); ?>"  class="layui-btn layui-btn-normal layui-btn-mini edit">保存</a>
                    <a  data-id="<?php echo ($vo["id"]); ?>" data-type='root' class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                    <a  data-id="<?php echo ($vo["id"]); ?>" class="layui-btn  layui-btn-mini add" data-type='son'>添加子菜单</a>
                </td>
                <?php if(is_array($vo["sonList"])): $i = 0; $__LIST__ = $vo["sonList"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vs): $mod = ($i % 2 );++$i;?><tr style="background-color: #DFEAFA">
                    <td style="width: 20%;text-align: left;">╠-----------<?php echo ($vs["name"]); ?></td>
                    <td style="width: 30%">
                    <input type="hidden" name="name_<?php echo ($vs["id"]); ?>" value="<?php echo ($vs["name"]); ?>">
                    <input type="text" name='url_<?php echo ($vs["id"]); ?>' autocomplete="off" class="layui-input" value="<?php echo ($vs["url"]); ?>">
                    </td>

                    <td style="width: 15%">
                    <input type="text" name='icon_<?php echo ($vs["id"]); ?>' autocomplete="off" class="layui-input" value="<?php echo ($vs["icon"]); ?>">
                    </td>
                    <td style="width: 5%">
                     <input type="number" name='sort_<?php echo ($vs["id"]); ?>' autocomplete="off" class="layui-input" value="<?php echo ($vs["sort"]); ?>" onkeyup="value=value.replace(/[^\d]/g,'')">
                    </td>
                    <th>
                       <button data-id="<?php echo ($vs["id"]); ?>"  class="layui-btn layui-btn-normal layui-btn-mini edit" lay-submit lay-filter="edit">保存</button>
                       <a  data-id="<?php echo ($vs["id"]); ?>"  data-type='son' class="layui-btn layui-btn-danger layui-btn-mini del">删除</a>
                    </th>
                  </tr><?php endforeach; endif; else: echo "" ;endif; ?>

							</tr><?php endforeach; endif; else: echo "" ;endif; ?>
						</tbody>
					</table>
				</div>
			</fieldset>
			</div>
			</div>
	</div>
	        <script src="/Public/static/layui/layui.js"></script>
  <script type="text/javascript" src="/Public/static/js/menuManage.js"></script>
  <script type="text/javascript">
    layui.use(['layer','form','jquery','laypage','laydate'],function(){
      var layer = layui.layer,
      form = layui.form(),
      $ = layui.jquery;
      //URL模块
      var URL = {
        delete :function(){
          return "<?php echo U('Home/System/deleteMenu');?>";
        },
        edit : function (){
          return "<?php echo U('Home/System/editMenu');?>";
        },
        root : function(){
          return "<?php echo U('Home/System/menu');?>";
        },
        add : function(){
          return "<?php echo U('Home/System/addView');?>";
        },
      }

      $('.del').on('click', function() {
          var _this = $(this);
          var type = _this.data('type');
          var id = _this.data('id');
          var warningMsg = "";
          if(type=="root"){
            warningMsg = "该节点是根节点，将会删除它以及它的所有子节点，是否确认?";
          }else{
            warningMsg = "确认删除这个节点吗?";
          }
          layer.confirm(warningMsg,{ 
            btn:['确认','返回'] 
          },function(){ 
            $.post(URL.delete(), {type:type,id:id}, function(rec) {
              layer.msg(rec.msg);
              if(!rec.status){
                window.location.href = URL.root();
              }
            });
          });
      });

      $('.edit').on('click',function(){
        var _this = $(this);
        var id = _this.data('id');
        var name = $(":input[name='name_"+id+"']").val();
        var url = $(":input[name='url_"+id+"']").val();
        var sort = $(":input[name='sort_"+id+"']").val();
        var icon = $(":input[name='icon_"+id+"']").val();
        $.post(URL.edit(), {id:id,name:name,url:url,sort:sort,icon:icon}, function(rec) {
           layer.msg(rec.msg);
           if(!rec.status){
            window.location.href = URL.root();
           }
        });
      })
     
      $('.add').on('click',function(){
        var _this = $(this);
        var type = _this.data('type');
        var title = "";
        var content = "";
        if(type=='son'){
          var id = _this.data('id');
          var fname = $(":input[name='name_"+id+"']").val();
          title = "添加子菜单";
          content = URL.add()+"?type=son&fid="+id+"&fname="+fname;
        }else{
          title = "添加根菜单";
          content = URL.add()+"?type=root";
        }
        layer.open({
            type: 2,
            title: [title, 'text-align:center;'],
            content: content,
            area:['500px', '400px'],  //宽高
            resize: false,      //是否允许拉伸
            scrollbar: false,
            maxmin: true,
            end:function(){
              window.location.href = URL.root();
            }
        });
      })
    })
  </script>
</body>
</html>