$(function(){ 
    $("#history-tag").parent().children("dd").hide();
    $("#info-tag").parent().children("dd").hide();


    $("#info-tag").click(function(){
        var className = $(this).attr("class");
        if(className=='close'){
            $(this).children("img").attr("src","./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        }else if(className=="open"){
            $(this).children("img").attr("src","./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $("#security-tag").click(function(){
        var className = $(this).attr("class");
        if(className=='close'){
            $(this).children("img").attr("src","./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        }else if(className=="open"){
            $(this).children("img").attr("src","./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $("#history-tag").click(function(){
        var className = $(this).attr("class");
        if(className=='close'){
            $(this).children("img").attr("src","./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        }else if(className=="open"){
            $(this).children("img").attr("src","./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $("#old-pwd").blur(function(){
        if($(this).val()==""){
            $(this).css("border",".5px solid red");
            $(this).siblings("#op-msg").text("此处不能为空");
        }else{
            $(this).css("border",".5px solid rgb(220,220,220)");
            $(this).siblings("#op-msg").text("");
        }
    });

    $("#new-pwd").blur(function(){
        var exp = /.{6,}/;
        if($(this).val()=="" || !exp.test($(this).val())){
            $(this).css("border",".5px solid red");
            $(this).siblings("#np-msg").text("密码为空或低于六个字符");
        }else{
            $(this).css("border",".5px solid rgb(220,220,220)");
            $(this).siblings("#np-msg").text("");
        }
    });

    $("#confirm-pwd").blur(function(){
        if($(this).val()=="" || $(this).val()!=$("#new-pwd").val()){
            $(this).css("border",".5px solid red");
            $(this).siblings("#cp-msg").text("请重新输入");
        }else{
            $(this).css("border",".5px solid rgb(220,220,220)");
            $(this).siblings("#cp-msg").text("");
        }
    });

    $("#save").click(function(){
        var exp = /.{6,}/;
        if($("#op-pwd").val()==""||$("#np-pwd").val()==""||$("#cp-pwd").val()==""||!exp.test($("#new-pwd").val())||$("#new-pwd").val()!=$("#confirm-pwd").val()){
            $(this).siblings("#save-msg").text("请继续完善以上信息");
            return false;
        }else{
            $(this).siblings("#save-msg").text("");
            return true;
        }
    });
});
