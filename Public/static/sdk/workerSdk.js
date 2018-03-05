/**
 * worker
 **/
(function (w,d) {
    "use strict";

    /**

     */
    var worker_msg = {

    };
    var _websocket;
    var Worker = {
        /**
         * 建立连接时发起的请求
         * @param type  请求类型 0为学生端，1为后台
         * @param account
         * @param exam_num
         */
        'connect':function(request_type,account,exam_num){
            var params = {
                'type':'login',
                'account':account,
                'exam_num':exam_num,
            };
            _websocket = new WebSocket("ws://"+domain+":"+port);
            _websocket.onopen = Tools.whenOpen(params);
            if(request_type){
                _websocket.onmessage = Tools.onMsg2Stu;
            }else{
                _websocket.onmessage = Tools.onMsg2Sys;
            }
        }
    };

    var Tools = {
        'whenOpen':function(params){
            // 登录
            var login_data = JSON.stringify(params);
            ws.send(login_data);
        },
        //服务端返回到学生端
        'onMsg2Stu':function () {
            
        },
        //服务端返回到后台
        'onMsg2Sys':function () {

        },

    };

    window.worker = window._worker = Worker;
})(window,document);
