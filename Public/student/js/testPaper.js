    
//  考试试卷
	

	// show the time
    $(".showTime").click(function(){
        $(".Countdown").transition('slide left');
    });

    $(".showTime").hover(function(){
        $('.showTime').transition('jiggle');   
    })





    // init answer (when refresh the page)
    $(function(){


        $.ajax({
            type: "POST",
            url: getAnswerUrl,
            data: {
                "paper_id":paper_id,
                "course_id":course_id,
            },
            dataType: "json",
        success: function(data){
            console.log(data);

                if(!data.status){

                    for(var k in data){
                        var value = data[k];
                        if(value === "空+"){
                            continue;
                        }
                        var key = 'question_'+k;
                        // console.log(key + "=" + value);
                        var _this = $("input[name='"+key+"']");     // gain the select
                        var type = _this.attr('type');              // gain the type
                        // console.log(type);
                        if(type === 'radio') {                       // if type is 'radio' add the 'checked' property
                            _this.each(function(){                  // it has many inputs
                                var _thisValue = $(this);
                                if(_thisValue.val() == value){
                                    _thisValue = $("input[value='"+value+"']");
                                    _thisValue.attr('checked',true);
                                }

                            });
                        } else if(type === 'text'){                  // if type is 'text' make its value equels key
                            _this.val(value);
                        }
                        $("#"+key).addClass('positive');            // add class 'positive' to answer_sheet
                    }
                    Progress();
                }
            },
            error: function(){

            }
        });

        // // get data when reflash
        // var storage = window.localStorage;
        // for(var i=0, len = storage.length; i  <  len; i++){
        //     var key = storage.key(i);
        //     var value = storage.getItem(key);
        //     // console.log(key + "=" + value);
        //     var _this = $("input[name='"+key+"']");     // gain the select
        //     var type = _this.attr('type');              // gain the type
        //     // console.log(type);
        //     if(type == 'radio') {                       // if type is 'radio' add the 'checked' property
        //         _this.each(function(){                  // it has many inputs
        //             var _thisValue = $(this);
        //             if(_thisValue.val() == value){
        //                 _thisValue = $("input[value='"+value+"']");
        //                 _thisValue.attr('checked',true);
        //             }
        //
        //         });
        //     } else if(type == 'text'){                  // if type is 'text' make its value equels key
        //         _this.val(value);
        //     }
        //     $("#"+key).addClass('positive');            // add class 'positive' to answer_sheet
        // }
        //
        // // get percent when reflash
        // Progress();

    });








    // answer_sheet change color(radio)
    $("input[type='radio']").on('click',function(){
        var question_id = $(this).attr('name');
        var answer = $(this).val();
        var qId = $(this).data("qid");
        var anId = $(this).data("anid");
        var type = $(this).data("type");

        if(answer !== ""){
            //判断是否是选择题，选择题存储id，判断题存储值
            if(type === '1'){
                setRedisAnswer(paper_id,course_id,qId,anId);
            }else {
                setRedisAnswer(paper_id,course_id,qId,answer);
            }
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

        setRedisAnswer(paper_id,course_id,qId,answer);
        if(answer !== "空+"){
            $("#"+question_id).addClass('positive');        // add class 'positive' to answer_sheet
            localStorage.setItem(question_id, answer);    // store the item by name
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
            $('.ui.basic.modal')
                .modal({
                     // post ahead
                     onApprove : function(){
                        postAnswer("提前提交试卷成功!")
                    }
                })
                .modal('show')
            ;
        }else {
            postAnswer("提交试卷成功!");
        }
    });

 

    // count down
    // month 0-11 
    var Utime = new Date(untilTime);
    $(".count_down").countdown({until: Utime, serverSync:serverTime, onExpiry : postAnswer, compact: true});       // 直到规定时间, 时间到期调用提交函数(后期可增加时间到期,自动填充未参加学生,成绩为0的情况)

    //获得服务器时间
    function serverTime() {
        var time = null;
        $.ajax({url: serverTimeUrl,
            async: false, dataType: 'text',
            success: function(text) {
                time = new Date(text);
            }, error: function(http, message, exc) {
                time = new Date();
            }});
        return time;
    }

    // post the answer
    function postAnswer(str="时间已到,试卷已经提交!"){
        var storage = window.localStorage;
        $('#alert_text').html(str);
        $.post(CheckAnswer, {'answer':JSON.stringify(storage), 'testpaper_id':paper_id}, function(data){
            if(data === true){
                $('.small.modal')
                .modal({
                    onApprove : function(){
                        window.location.href = index;   
                    },
                })
                .modal('show')
                ;
            }else{
                alert("成绩已经存在!");
                window.location.href = index;
            }
        });

        storage.clear();
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


    //redis 存储答案
    function setRedisAnswer(paper_id,course_id,question_id,answer) {
        $.ajax({
            type: "POST",
            url: setRedisUrl,
            data: {
                "paper_id":paper_id,
                "course_id":course_id,
                "question_id":question_id,
                "answer":answer
            },
            dataType: "json",
            success: function(data){
                if(data.status !== 1){
                    $("#alert_msg").html(data.msg);
                    $('.mini.modal')
                        .modal({
                            onApprove(){

                            },
                            deny(){

                            }
                        })
                        .modal('show');
                }
                console.log(data);
                $.countdown.resync();
                $(".count_down").countdown('option','until',data.time);

            },
            error: function(){
                $("#alert_msg").html("网络故障");
                $('.mini.modal')
                    .modal({
                        onApprove(){

                        },
                        deny(){

                        }
                    })
                    .modal('show');
            }
        });
    }







    
