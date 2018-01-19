<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>能力考查系统</title>
<meta name="description" content="针对java考试和c语言考核、学生平时练习和评测、收集学生成绩以及学习情况的收集和分析的一个在线考核系统">
<meta name="keywords" content="个人主页,编程练习">
<link rel="stylesheet" href="/Public/student/css/Recorddetail.css">
<link rel="stylesheet" href="/Public/static/css/bootstrap.min.css">
          <link rel="stylesheet" type="text/css" href="/Public/static/layui/css/layui.css">
    <style>
        .layui-unselect {
            font-size: 15px;
        }
    </style>
</head>
<body>
	<head>
    <link rel="stylesheet" href="/Public/student/css/header_foot.css">
    <link rel="stylesheet" href="/Public/student/SemanticUI/semantic.min.css">
    <link href="/Public/student/font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>
<div class="headerBox">
    <img src="/Public/student/images/logo.png" alt="logo">
    <a href="#" class="nl-sign">NLKH &nbsp;&nbsp;&nbsp;能力考核系统（学生）</a>
    <div class="nl-logout">
        <button class="ui teal button" id="loginout" name="loginout"><i class="fa fa-sign-out fa-fw"></i>&nbsp;退出</button> 
    </div>
</div>


    <button class="layui-btn" id="back" name="back" style="margin-top: -16px; float: left; " onclick="javascrtpt:window.location.href='<?php echo U('student/indexMgr/index');?>'"><i class="layui-icon">&#xe603;</i>返回主页</button>
<div class="paper_container">
    <div class="content">
        <div class="info">
            <fieldset>
                <legend>试卷详情</legend>
            </fieldset>
        </div>

        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-left: 40px;width: 95%;font-size: 18px;">
        <form class="layui-form">
            <div class="layui-inline">
                <label style="font-size: 16px;">选择类型:</label>
                 <div class="layui-input-inline" style="width: 160px;margin-left: 20px;">
                     <select class="choice" lay-filter="choice">
                      <option value="all">全部题目</option>
                      <option value="0">错误的题</option>
                      <option value="1">正确的题</option>
                    </select> 
                </div>
            </div>
            <div class="layui-inline" style="float: right;">
                 <label style="font-weight: unset;font-size: 16px">填空及判断题只有正确答案。</label>
                <label style="font-weight: unset;width: 20px;height:20px;background-color: #5cb85c;text-align: center;position: inherit;
    top: 8px;"></label>
                <label style="font-weight: unset; padding-right: 20px;">正确</label>
                <label style="font-weight: unset;width: 20px;height:20px;background-color: #d9534f;text-align: center;position: inherit;
    top: 8px;"></label>
                <label>错误</label>
                
            </div>
        </form>
        </blockquote>
        

        <div class="paper_detail">
            <div class="border_paper">
                <div class="paper_img">
                    <img src="/Public/student/images/note.png">
                </div>
                <div class="paper_description">
                    <div class="paper_header paper_line">
                        <b>试卷名称:</b>
                        <span class="label label-info paper_name"></span>
                    </div>
                    <div class="paper_type paper_line">
                        <b>试卷类型:</b>
                        <span class="label label-info type_name"></span>
                    </div>
                    <div class="paper_author paper_line">
                        <b>试卷作者:</b>
                        <span class="label label-info author"></span>
                    </div>
                    <div class="paper_full_score paper_line">
                        <b>试卷满分:</b>
                        <span class="label label-success full_score"></span>
                    </div>
                    <div class="paper_pass_score paper_line">
                        <b>及格分数:</b>
                        <span class="label label-danger pass_score"></span>
                    </div>
                    <div class="paper_people_score paper_line">
                         <b>您的分数:</b>
                        <span class="label label-danger your_score"></span>
                    </div>
                </div>
            </div>
        </div>  

        <div class="answer_detail">
        </div>

        <div style="clear: both;"></div>
       <div class="admin-table-page" style="text-align: center;">
            <div id="page" class="page">
          </div>
      </div>
    </div>

</div>
    <div class="footBox">
    <div class="nl-foot-sign">
        <p>
            @&nbsp;BY CUIT <br>
            <span style="font-size: 15px;margin-top: 5px;">四川成都&nbsp;|&nbsp;成都信息工程大学版权所有</span>
        </p>
    </div>
</div>
</body>
</html>

        <script src="/Public/static/layui/layui.js"></script>
<script> 
 var testpaper_id = "<?php echo ($testpaper_id); ?>";
 var jsonData = "<?php echo U('Student/TestRecord/getDetails');?>";
 var pages = "";
 var curr = "";
</script>
<script type="text/javascript">

layui.use(['layer','form','jquery','laypage'],function(){
  var layer = layui.layer,
  form = layui.form(),
  laypage = layui.laypage,
  $ = layui.jquery;

  var type = $(".choice").val();

  $(function(){
    getDetails();
  });


  // 获取接口信息
  // paper_id, student_id, type, page
  function getDetails(type='all',page = 1){
     $.ajax({
        url:jsonData+"?testpaper_id="+testpaper_id+"&type="+type+"&requestPage="+page,
        type:'get',
        dataType:'json',
        timeout:3000,
        beforeSend:function(){
            layer.msg('加载中...');
        },
        success:function(data){
            if(data.status === false){
                layer.msg(data.msg, {time: 3000,icon: 2});
            }else{
                //分页相关
                pages = data.pages;
                curr = data.requestPage;

                // 试卷相关信息
               var paper = eval(data.paper);
               $(".paper_name").html(paper.name);
               $(".type_name").html(paper.type_name);
               $(".author").html(paper.create_by);
               $(".full_score").html(paper.full_score);
               $(".pass_score").html(paper.pass_score);
               $(".your_score").html(paper.your_score);

                // 问题相关信息
                var question = eval(data.question);
                $(".answer_detail").html("");      //清空html用于分页
                $.each(question, function(index,value){
                        var head = '<div class="question_detail">';
                        var number =   '<div class="question_number paper_line"><b>当前题号:</b><span>'+value.question_id+'</span></div>';
                        var content = '<div class="question_title paper_line"><b>题目内容:</b><span>'+value.question_content+'</span></div>';
                        var answer = '<div class="question_answer paper_line"><b>题目答案:</b>';
                        var knowledges = '<div class="question_knowledge paper_line"><b>相关知识点:</b>'

                        var select = "";
                        var knowledge = "";
                        // 添加答案
                        $.each(value.answer, function(index1, value1){
                            value1 = value1.split(":");
                            // 正确答案样式
                            if(value1[1] == 1){
                                select += '<span class="label label-success">'+value1[0]+'</span>';
                            }
                            // 学生选择了错误答案后的样式
                            else if(index1 == value.answer_id && value1[1] == 0){
                                select += '<span class="label label-danger">'+value1[0]+'</span>';
                            }
                            // 通用样式
                            else{
                                select += '<span>'+value1[0]+'</span>';   
                            }
                            // 如果为最后一个数,则封闭div
                            if(index1 == value.answer[value.answer.length - 1]){
                                select += '</div>';
                            }
                        });
                        answer = answer+select;
                        // 添加知识点
                        $.each(value.knowledges, function(index2, value2){
                            knowledge += '<span class="label label-default" style="margin:0 3px;">'+value2+'</span>';
                            // 如果为最后一个数,则封闭div
                            if(index2 == value.knowledges[value.knowledges.length - 1]){
                                knowledge += "</div>";
                            }
                        });
                        knowledges = knowledges+knowledge;
                        // 封闭整体div
                        var foot = '</div>';
                        // 添加答案框
                        var html = head+number+content+answer+knowledges+foot;
                        $(".answer_detail").append(html);    
                });

            }
        },
        // 方法完成后调用分页函数
        complete:function(){
            // 分页
            laypage({
                cont: 'page',
                pages: pages, //总页数
                groups: 5, //连续显示分页数
                curr: curr,//获得当前页码
                jump: function(obj, first) {
                    //得到了当前页，用于向服务端请求对应数据
                    var curr = obj.curr;
                    if(!first) {
                       getDetails(type, curr);
                    }
                }
            });
        }
      });
  }


// 下拉框联动
form.on('select(choice)',function(data){
    getDetails(data.value);
})


});

</script>