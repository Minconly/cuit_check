// answer_sheet change color(radio)
$("input[type='radio']").on('click',function(){
    var question_id = $(this).attr('name');
    var answer = $(this).val();
    var qId = $(this).data("qid");
    var anId = $(this).data("anid");
    var type = $(this).data("type");

    if(answer !== ""){
        //判断是否是选择题，选择题存储id，判断题存储值

        $("#"+question_id).addClass('positive');        // add class 'positive' to answer_sheet
        localStorage.setItem(question_id, answer);    // store the item by name
    }
    Progress();
});
// answer_sheet change color(text)
$("input[type='text']").on('blur',function(){
    var question_id = $(this).attr('name');
    var answer = $(this).val()===""?"空+":$(this).val();
    var qId = $(this).data("qid");
    var anId = $(this).data("anid");
    var type = $(this).data("type");

    if(answer !== "空+"){
        $("#"+question_id).addClass('positive');        // add class 'positive' to answer_sheet
        localStorage.setItem(question_id, answer);    // store the item by name
        // localStorage.removeItem(question_id);    // store the item by name
    }else{
        $("#"+question_id).removeClass('positive');        // add class 'positive' to answer_sheet
        localStorage.removeItem(question_id);    // store the item by name
    }
    Progress();

});


$(".goToTheSheet").click(function(){
    var question_id = $(this).attr('id');
    // alert(question_id);
    var target_top = $("input[name='"+question_id+"']").offset().top-300;
    $("html,body").animate({scrollTop: target_top}, 500);
});



// post the answer
$(".confirm").click(function(){
    var str = IsAnswerAll();
    // did not answer all
    if(!str){
        swal({
            title: "提醒?",
            text: "确认提前交卷，只会记录做了的题目!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
                if (willDelete) {
                    postAnswer("提前提交试卷成功!")
                }
            });
    }else {
        swal({
            title: "提交试卷？",
            text: "",
            icon: "info",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                postAnswer("提交试卷!")
            }
        });
    }
});




function postAnswer(str="时间已到,试卷已经提交!"){
    // var storage = window.localStorage;
    // $('#alert_text').html(str);
    var postData = JSON.parse(JSON.stringify(localStorage));
    postData['lession_id'] = lession_id;
    postData['college_id'] = college_id;
    postData['questionIds'] = questionIds;
    postData['type'] = type;
    console.log(postData);
    $.post(commitAnswer, postData, function(data){
        // $('#alert_text').html(data["msg"]);
        if(data.success === true){
            swal({
                text:data.msg+'\n正确率为： '+(data['rate']*100)+'%',
                closeOnClickOutside: false,
                icon: "success",
            }).then((value) => {
                console.log(data);
                let errList = data.errList;
                let arrErrList = errList.split(",");
                for(let i = 0; i < arrErrList.length; i++){
                    var item = arrErrList[i];
                    $('#question_'+item).removeClass('positive');
                    $('#question_'+item).addClass('red');
                    $('#question_content_'+item).css('background-color','red');
                    $('.subject_action').remove();
                }
            });
        }else{
            swal({
                text:data["msg"],
                closeOnClickOutside: false,
                icon: "error",
            }).then((value) => {
                console.log(data);
            });
        }
    });
}


// check by answersheet class
function IsAnswerAll() {
    var str=true;
    $(".goToTheSheet").each(function(){
        var _this = $(this);
        var status = _this.hasClass('positive');
        if(!status) {
            str = false;
        }
    });
    return str;
}

// progress
function Progress() {
    var sheet = $(".goToTheSheet").length;
    var p = $(".positive").length;
    $('#subject_progress')
        .progress({
            total : sheet,
            percent : (p/sheet)*100
        });
}


// 扩展post提交数据, 并进行跳转
$.extend({
    StandardPost: function (url, args) {
        var body = $(document.body),
            form = $("<form method='post'></form>"),
            input;
        form.attr({"action": url});
        $.each(args, function (key, value) {
            input = $("<input type='hidden'>");
            input.attr({"name": key});
            input.val(value);
            form.append(input);
        });

        form.appendTo(document.body);
        form.submit();
        document.body.removeChild(form[0]);
    }
});










