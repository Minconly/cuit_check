<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>试卷管理</title>
              <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <!--<link rel="stylesheet" href="/Public/static/css/main.css" />-->
    <link rel="stylesheet" href="/Public/static/css/rwdgrid.min.css">
    <link rel="stylesheet" href="/Public/static/css/collegeList.css" />
    <link rel="stylesheet" href="/Public/static/css/global.css" media="all">
    <style>
        .layui-input{
            height: 30px;
        }
        .my-input .layui-input{
            height: 38px;
        }
        .my-input .layui-form-label{
            width: 90px;
        }
        .courseList{
            margin-top: 10px;
        }
        .layui-form-select{
            width: 80%; /*     调整select的宽度*/
        }
    </style>
</head>

<body>
<div class="admin-main">
    <form class="layui-form" method="POST" id="submit" action="<?php echo U('Home/ClassPapersCreateMgr/ClassPapersList');?>">
        <blockquote class="layui-elem-quote">
            <a href="javascript:;" class="layui-btn layui-btn-small add">
                <i class="layui-icon">&#xe608;</i> 添加试卷
            </a>
            <?php if($role == 1): ?><div class=" layui-input-block" style="display: inline-block; margin-left: 15px; vertical-align: bottom;">
                    <div class="layui-form-pane courseList">
                        <label class="layui-form-label" style="padding: 4px 1px;">选择学院</label>
                        <div class="layui-input-inline ">
                            <select name="college_id" lay-verify>
                                <option value="" selected="">选择学院</option>
                                <?php if(is_array($collegeList)): $i = 0; $__LIST__ = $collegeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>" <?php if(($col["id"]) == $college_id): ?>selected="selected"<?php endif; ?> ><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                            </select>
                        </div>
                    </div>
                </div><?php endif; ?>
            <div class=" layui-input-block" style="display: inline-block; margin-left: 15px; vertical-align: bottom;">
                <div class="layui-form-pane courseList">
                    <label class="layui-form-label" style="padding: 4px 1px;">试卷类型</label>
                    <div class="layui-input-inline ">
                        <select name="type" lay-verify>
                            <option value="" selected="">选择类型</option>
                            <?php if(is_array($paperTypeList)): $i = 0; $__LIST__ = $paperTypeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ptl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($ptl["value"]); ?>" <?php if(($ptl["value"]) == $type): ?>selected="selected"<?php endif; ?> ><?php echo ($ptl["label"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="layui-input-block" style="display: inline-block; margin-left: 2px; min-height: inherit; vertical-align: bottom;">
                <input type="text" name="keyword" id="keyword"  lay-verify class="layui-input" autocomplete="off" placeholder="请输入搜索关键词" style="height: 30px; line-height: 30px;">
            </div>
            <a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" lay-submit lay-filter="submit2">
                <i class="layui-icon" >&#xe615;</i> 搜索
            </a>
            <a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" id="searchAll">
                <i class="layui-icon">&#xe615;</i> 查看全部
            </a>

        </blockquote>
    </form>

    <fieldset class="layui-elem-field">
        <!--<legend>学院列表</legend>-->
        <div class="layui-field-box">
            <table class="site-table table-hover">
                <thead>
                <tr>
                    <th>id</th>
                    <th>试卷名</th>
                    <th>类型</th>
                    <th>所属学院</th>
                    <th>所属课程</th>
                    <th>试卷总分</th>
                    <th>及格成绩</th>
                    <th>题量</th>
                    <th>生成时间</th>
                    <th>生成用户</th>
                    <th>是否启用</th>
                    <th>操作</th>
                </tr>
                </thead>
                <?php if(is_array($papersList)): $i = 0; $__LIST__ = $papersList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tbody>
                <tr>
                    <td><?php echo ($vo["id"]); ?></td>
                    <td><?php echo ($vo["name"]); ?></td>
                    <td><?php echo ($vo["typename"]); ?></td>
                    <td><?php echo ($vo["collegename"]); ?></td>
                    <td><?php echo ($vo["lessionname"]); ?></td>
                    <td><?php echo ($vo["full_score"]); ?></td>
                    <td><?php echo ($vo["pass_score"]); ?></td>
                    <td><?php echo ($vo["number"]); ?></td>
                    <td><div style="width:100%;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo ($vo["create_date"]); ?></div>
                    </td>
                    <td><?php echo ($vo["create_by"]); ?></td>
                    <td><?php if($vo['is_use'] == 0): ?>禁用<?php endif; ?>
                        <?php if($vo['is_use'] == 1): ?>激活<?php endif; ?></td>
                    <td>
                        <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" data-course="<?php echo ($vo["college_id"]); ?>" data-typeid="<?php echo ($vo["type_id"]); ?>"  data-lession="<?php echo ($vo["lession_id"]); ?>" class="layui-btn layui-btn-normal layui-btn-mini see">查看</a>
                        <a href="javascript:;" data-id="<?php echo ($vo["id"]); ?>" class="layui-btn layui-btn-mini edit">编辑</a>
                    </td>
                </tr>
                </tbody><?php endforeach; endif; else: echo "" ;endif; ?>
            </table>

        </div>
    </fieldset>

    <div class="admin-table-page">
        <div id="page" class="page">
        </div>
    </div>

</div>
</body>
<script>
    var editurl = "<?php echo U('Home/ClassPapersCreateMgr/showEditPaper');?>";
    var listurl = "<?php echo U('Home/ClassPapersCreateMgr/ClassPapersList');?>";
    var addurl = "<?php echo U('Home/ClassPapersCreateMgr/showAddPaper');?>";
    var detialurl = "<?php echo U('Home/ClassPapersDetialMgr/paperDetial');?>";
    var rooturl = "/";
    var pages = '<?php echo ($pages); ?>';
    var curr = '<?php echo ($requestPage); ?>';
    var keyword = "<?php echo ($keyword); ?>";
    var college_id = "<?php echo ($college_id); ?>";
    var type = "<?php echo ($type); ?>";
</script>
        <script src="/Public/static/layui/layui.js"></script>
<script>
    layui.use(['tree','form','layer','laypage'], function() {
        var $ = layui.jquery,
            layer = layui.layer,
            form = layui.form();

        var index2;

        layui.laypage({
            cont: $('#page'),
            pages: pages, //总页数
            groups: 5, //连续显示分页数
            curr: curr,//获得当前页码
            jump: function(obj, first) {
                //得到了当前页，用于向服务端请求对应数据
                var curr = obj.curr;
                if(!first) {
                    window.location.href=listurl+"?requestPage="+curr+"&keyword="+keyword+"&college_id="+college_id
                        +"&type="+type;
                }
            }
        });

        $('.add').on('click',function () {
            index2 = layer.open({
                type: 2,
                title:"添加试卷",
                skin: 'layui-layer-rim', //加上边框
                area: ['400px', '500px'], //宽高
                content:addurl,
                end: function (){
                    window.location.reload();
                }
            });
        });

        $('.del').on('click',function () {
            layer.confirm('确认删除？', {
                btn: ['确认','取消'] //按钮
            }, function(){
                layer.msg('ok', {icon: 1});
            }, function(){
                layer.msg('已取消', {
                    time: 1000, //1s后自动关闭
                });
            });
        });

        $('.edit').on('click',function () {
            var id = $(this).data('id');
            layer.open({
                type: 2,
                title:"修改试卷基本信息",
                skin: 'layui-layer-rim', //加上边框
                area: ['400px', '500px'], //宽高
                content:editurl+'?id='+id,
                end: function (){
                    window.location.reload();
                }
            });
        });


        $('.see').on('click',function () {
            var id = $(this).data('id');
            var college_id=$(this).data('course');
            var lession_id=$(this).data('lession');
            var type_id=$(this).data('typeid');
            // alert(lession_id);
            var index = layer.open({
                type: 2,
                title: ['试卷查看', 'text-align:center;'],
                content: detialurl+'?id='+id+'&college_id='+college_id+'&lession_id='+lession_id+'&type_id='+type_id,
                resize: false,      //是否允许拉伸
                maxmin: true,
                end: function (){
                    window.location.reload();
                }
            });
            layer.full(index);
        });

        $('#searchAll').on('click',function () {
            window.location.href=listurl;
        });

        form.verify({
            title: function(value) {
                if(value.length < 5 || value == null) {
                    return '内容至少得5个字符啊';
                }
            }
        });

        form.on('submit(submit2)', function(data) {
            console.log(data.field) //当前容器的全部表单字段，名值对形式：{name: value}
            $('#submit').submit();
        });
    });
</script>

</html>