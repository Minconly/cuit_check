<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>章节管理</title>
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
            width: 70%; /*     调整select的宽度*/
        }
        .add-titile {
            padding: 5px 0px;
            width: 80px;
        }
        .add-titile:after {
            padding: 5px 0px;
            width: 80px;
            border: dashed 1px red;
        }
        .layui-form-select {
            width: 200px;
        }
    </style>
</head>

<body>
<div class="admin-main layui-form">

    <form class="my-form" action="">
        <input type="hidden" value="<?php echo ($paper_id); ?>" name="paper_id">
        <blockquote class="layui-elem-quote">
            <div class=" layui-input-block" style="display: inline-block; margin-left: 10px; vertical-align: bottom;">
                <div class="layui-form-pane courseList">
                    <label class="layui-form-label" style="padding: 4px 1px;">选择题库</label>
                    <div class="layui-input-inline ">
                        <select name="database_id" id="database_id" class="database_id" lay-verify="" lay-filter="filter1">
                            <option value="" selected="">选择题库</option>
                            <?php if(is_array($DbList)): $i = 0; $__LIST__ = $DbList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$col): $mod = ($i % 2 );++$i;?><option value="<?php echo ($col["id"]); ?>"><?php echo ($col["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class=" layui-input-block" style="display: inline-block; margin-left: 10px; vertical-align: bottom;">
                <div class="layui-form-pane courseList">
                    <label class="layui-form-label" style="padding: 4px 1px;">选择章节</label>
                    <div class="layui-input-inline ">
                        <select id="filter3" name="chapter_id" multiple="multiple" class="chapter_id"  lay-verify="" lay-filter="filter3">
                            <option value="" >选择章节</option>
                        </select>
                    </div>
                </div>
            </div>

            <a href="javascript:;" class="layui-btn layui-btn-small" id="top-func" style="background-color: #1E9FFF;display: inline-block">
                高级
            </a>
            <!--<a href="javascript:;" style="display: inline-block; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" id="searchAll">-->
            <!--<i class="layui-icon">&#xe615;</i> 生成-->
            <!--</a>-->
        </blockquote>
    </form>

    <fieldset class="layui-elem-field">
        <legend>试卷详情</legend>
        <form class="" action="">
            <div>
                <div class="grid-1"> <label class="layui-form-label add-titile">选择题：</label></div>
                <div class="grid-11">
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">题量</label>
                            <div class="layui-input-inline ">
                                <input name="testNum" type="number" min="0" max="0" name="" value="0"  required lay-verify class="layui-input tipsMsg">
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">分值</label>
                            <div class="layui-input-inline ">
                                <input name="testVal" type="number" min="0" max="15" step="0.5" name="" value="0" required lay-verify class="layui-input">
                            </div>
                        </div>
                    </div>

                    <div class="hide-hard" style="display: inline-block">
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">易</label>
                                <div class="layui-input-inline ">
                                    <input name="testA" type="number" min="0" max="0" name="" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">中</label>
                                <div class="layui-input-inline ">
                                    <input name="testB" type="number" min="0" max="0" name="" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">难</label>
                                <div class="layui-input-inline ">
                                    <input name="testC" type="number" min="0" max="0" name="" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="grid-1"> <label class="layui-form-label add-titile">判断题：</label></div>
                <div class="grid-11">
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">题量</label>
                            <div class="layui-input-inline ">
                                <input name="testNum" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">分值</label>
                            <div class="layui-input-inline ">
                                <input name="testVal" type="number" min="0" max="15" step="0.5" value="0" required lay-verify class="layui-input">
                            </div>
                        </div>
                    </div>

                    <div class="hide-hard" style="display: inline-block">
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">易</label>
                                <div class="layui-input-inline ">
                                    <input name="testA" type="number" min="0" max="0"  value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">中</label>
                                <div class="layui-input-inline ">
                                    <input name="testB" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">难</label>
                                <div class="layui-input-inline ">
                                    <input name="testC" type="number" min="0" max="0" value="0"  required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div>
                <div class="grid-1"> <label class="layui-form-label add-titile">填空题：</label></div>
                <div class="grid-11">
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">题量</label>
                            <div class="layui-input-inline ">
                                <input  name="testNum" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">分值</label>
                            <div class="layui-input-inline ">
                                <input name="testVal" type="number" min="0" max="15" step="0.5" value="0" required lay-verify class="layui-input">
                            </div>
                        </div>
                    </div>

                    <div class="hide-hard" style="display: inline-block">
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">易</label>
                                <div class="layui-input-inline ">
                                    <input name="testA" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">中</label>
                                <div class="layui-input-inline ">
                                    <input name="testB" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">难</label>
                                <div class="layui-input-inline ">
                                    <input name="testC" type="number" min="0" max="0"  value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div>
                <div class="grid-1"> <label class="layui-form-label add-titile">编程题：</label></div>
                <div class="grid-11">
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">题量</label>
                            <div class="layui-input-inline ">
                                <input  name="testNum" type="number" min="0" max="0"  value="0" required lay-verify class="layui-input tipsMsg">
                            </div>
                        </div>
                    </div>
                    <div class="" style="display: inline-block;">
                        <div class="layui-form-pane">
                            <label class="layui-form-label" style="padding: 4px 1px;">分值</label>
                            <div class="layui-input-inline ">
                                <input name="testVal" type="number" min="0" max="15" step="0.5" value="0" required lay-verify class="layui-input">
                            </div>
                        </div>
                    </div>

                    <div class="hide-hard" style="display: inline-block">
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">易</label>
                                <div class="layui-input-inline ">
                                    <input name="testA" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">中</label>
                                <div class="layui-input-inline ">
                                    <input name="testB" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                        <div class="" style="display: inline-block;">
                            <div class="layui-form-pane">
                                <label class="layui-form-label" style="padding: 4px 1px;">难</label>
                                <div class="layui-input-inline ">
                                    <input name="testC" type="number" min="0" max="0" value="0" required lay-verify class="layui-input tipsMsg">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </fieldset>
    <a href="javascript:;" style="display: inline-block; float: right; margin-top: 5px; margin-left: 2px; min-height: inherit; vertical-align: bottom;" class="layui-btn layui-btn-small" lay-submit lay-filter="submit2" id="search">
        <i class="layui-icon" >&#xe615;</i> 点击生成
    </a>
</div>
</body>
        <script src="/Public/static/layui/layui.js"></script>
<script type="text/javascript" src="/Public/static/js/layui-mz-min.js"></script>
<script>
    var getbd ="<?php echo U('Home/AutoCreatePaperMgr/getList');?>";
    var getResidueSubjectNum ="<?php echo U('Home/AutoCreatePaperMgr/getResidueSubjectNum');?>";
    var autoCreatePaper = "<?php echo U('Home/AutoCreatePaperMgr/autoCreatePaper');?>";
</script>
<script>
    var isNotExpend = true;
    layui.use(['form','layer'], function() {
        var $ = layui.jquery,
            layer = layui.layer,
            form = layui.form();
        layui.selMeltiple($);
        var intervalFlag = "";

        var intervalName = null;

        $('.my-form').mouseover(function () {
            if(intervalName == null) {
                intervalName = setInterval(handle, 1000);
            }
        });


        //隐藏高级选项
        $(".hide-hard").hide(); //.style.display="none";

        //提醒剩余题量
        $('.tipsMsg').on('click', function(){
            var that = this;
            layer.tips('剩余<'+$(that).attr('max'), that); //在元素的事件回调体中，follow直接赋予this即可
        });

        //显示高级选项
        $('#top-func').on('click',function () {
            if(!isNotExpend){
                $(".hide-hard").hide();
                location.reload();  //重新加载页面
//                isNotExpend = true;
            }else {
                $(".hide-hard").show();
                isNotExpend = false;
            }
        });

        //对输入的数字进行检测，看是否小于max大于min
        $("input[type='number']").on('input propertychange',function () {
            if(parseInt(this.value) > parseInt(this.max)){
                this.value = this.max;
            }
            if(parseInt(this.value) < parseInt(this.min)){
                this.value = this.min;
            }
        });
        

        // 获取到选择的题库
        form.on('select(filter1)', function(data){
            var database_id= data.value;
            $.ajax({
                url:getbd,
                type:"POST",
                data: {'database_id':database_id},
                dataType:"json",
                success: function (data) {
                    /*清空隐藏域缓存值，和无效隐藏域*/
                    $("input[name='chapter_id']").val("");
                    $("input[name='undefined']").remove();

                    //将option框清空,避免for循环重复

                    $(".chapter_id").find("option").each(function(){
                        if(!$(this).val() == "")
                            $(this).remove();
                    });

                    var chs = data.dbs;
                    for (var i = chs.length - 1; i >= 0; i--) {
                        // alert(data[i]);
                        $(".chapter_id").append("<option value="+chs[i].id+">"+chs[i].name+"</option>");
                    }
                    // 更新选择框
                    form.render('select');
                    layui.selMeltiple($);
                }
            });
        });
        // 获取到选择的题库
//        $('select#filter2+div>div>input[type=\"text\"]').on('onpropertychange oninput',function(data){
//            var database_ids = data.value;
//            $.ajax({
//                url:getResidueSubjectNum,
//                type:"POST",
//                data: {'ids':database_ids},
//                dataType:"json",
//                success: function (data) {
//                    var arr = data;
//                    $('.tipsMsg').each(function(index,element){
//                        if((index+1)%4 == 1){
//                            $(this).attr('max',parseInt(arr[index][index])+parseInt(arr[index][index+1])+parseInt(arr[index][index+2]));
//                        }else {
//                            $(this).attr('max',arr[index/4][index%4-1]);
//                        }
//                    })
//                }
//            });
//        });


        //        $("input[name='database_id']").on('change',function(data){
//            var database_ids = data.value;
//            $.ajax({
//                url:getResidueSubjectNum,
//                type:"POST",
//                data: {'ids':database_ids},
//                dataType:"json",
//                success: function (data) {
//                    var arr = data;
//                    $('.tipsMsg').each(function(index,element){
//                        if((index+1)%4 == 1){
//                            $(this).attr('max',parseInt(arr[index][index])+parseInt(arr[index][index+1])+parseInt(arr[index][index+2]));
//                        }else {
//                            $(this).attr('max',arr[index/4][index%4-1]);
//                        }
//                    })
//                }
//            });
//        });
        //定时事件
        function handle() {
            var ids = document.getElementById("database_id").value;
            var chs = $("input[name='chapter_id']").val() != null ? $("input[name='chapter_id']").val():"";
            var nowVal = ids+chs;
            if(nowVal != intervalFlag){
                intervalFlag = nowVal;
                var index = layer.load(2, {
                    shade: [0.1,'#fff'] //0.1透明度的白色背景
                });
                $.ajax({
                    url:getResidueSubjectNum,
                    type:"POST",
                    data: {'ids':ids,'chs':chs},
                    dataType:"json",
                    success: function (data) {
                        clearInterval(intervalName);
                        intervalName = null;
//                        alert(data.toString());
                        if(!data.success){
                            layer.msg(data.msg);
                            layer.close(index);
                            return;
                        }
                        var arr = data.msg;
                        $('.tipsMsg').each(function(index,element){
                            if((index+1)%4 == 1){
                                $(this).attr('max',parseInt(arr[parseInt(index/4)][0])
                                    +parseInt(arr[parseInt(index/4)][1])
                                    +parseInt(arr[parseInt(index/4)][2]));
                            }else {
                                var num = arr[parseInt(index/4)][parseInt(index%4-1)];
//                                var num = arr[0][0];
                                $(this).attr('max',num);
                            }
                        });
                        layer.close(index);
                    }, error:function () {
                        layer.close(index);
                        layer.msg('数据加载失败！');
                    }
                });
            }
        }



        form.verify({
            title: function(value) {
                if(value.length < 5 || value == null) {
                    return '内容至少得5个字符啊';
                }
            }
        });

        //提交自动生成参数到后台
        form.on('submit(submit2)', function(data){
            if(document.getElementById("database_id").value == ""){
                layer.msg("请选择题库！");
                $('#filter1').focus();
                return;
            }
            var check = true;
            $(".tipsMsg").each(function () {
                if(parseInt($(this).attr('min')) > parseInt($(this).val()) || parseInt($(this).attr('max')) < parseInt($(this).val())){
                    layer.tips('0< 值 <'+$(this).attr('max'), this);
                    check = false;
                    return check;
                }
            });
            if(!check){
                return false;
            }
            var data = {};
            //序列化值，生成数组
            $("form").serializeArray().map(function(x){
                if (data[x.name] !== undefined) {
                    if (!data[x.name].push) {
                        data[x.name] = [data[x.name]];
                    }
                    data[x.name].push(x.value || '');
                } else {
                    data[x.name] = x.value || '';
                }
            });


            if(!isNotExpend){           //判断是否高级生成
                for(var i = 0;i < 4;i++){
                    //判断分类选择总数是否等于题量
                    if(parseInt(data.testA[i])+parseInt(data.testB[i])+parseInt(data.testC[i]) != parseInt(data.testNum[i])){
                        $(".add-titile").each(function (index,that) {
                            if(index == i){
                                layer.tips('分类选择总数应该与题量相同!', that, {
                                    tips: [1, '#3595CC']
                                });
                            }
                        });
                        return false;
                    }
                }
            }
            //加载等待
            var index = layer.load(2, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });

            $.ajax({
                url:autoCreatePaper,
                type:"POST",
                data: data,
                dataType:"json",
                success: function (data) {
                    if(!data.success){
                        layer.msg(data.msg);
                        layer.close(index);
                        return;
                    }
                    var msg = data.msg;
                    layer.alert(msg,{time:4000},function(index){
                        //do something
                        var index = parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index); //再执行关闭

                    });

                    layer.close(index);
                }, error:function () {
                    layer.close(index);
                    layer.msg('生成失败！');
                }
            });

            console.log(data);
            return false;
        });
    });
</script>

</html>