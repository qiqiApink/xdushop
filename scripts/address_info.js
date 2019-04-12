$(function(){

    $("#rname").blur(function(){
        if($(this).val()==""){
            $(this).css("border",".5px solid rgb(253, 18, 18)");
            $(this).css("box-shadow","0 0 2px .5px rgb(253, 18, 18)");
            $("#recv-msg").text("收货人姓名不能为空");
        }else{
            $(this).css("border",".5px solid rgb(168, 168, 168)");
            $(this).css("box-shadow","0 0 0px 0px rgb(253, 18, 18)");
            $("#recv-msg").text("");
        }
    });

    $("#specific-addr").blur(function(){
        if($(this).val()==""){
            $(this).css("border",".5px solid rgb(253, 18, 18)");
            $(this).css("box-shadow","0 0 2px .5px rgb(253, 18, 18)");
            $("#detail-msg").text("详细地址信息不能为空");
        }else{
            $(this).css("border",".5px solid rgb(168, 168, 168)");
            $(this).css("box-shadow","0 0 0px 0px rgb(253, 18, 18)");
            $("#detail-msg").text("");
        }
    });

    $("#r-tel").blur(function(){
        if($(this).val()==""){
            $(this).css("border",".5px solid rgb(253, 18, 18)");
            $(this).css("box-shadow","0 0 2px .5px rgb(253, 18, 18)");
            $("#tel-msg").text("联系电话不能为空");
        }else{
            $(this).css("border",".5px solid rgb(168, 168, 168)");
            $(this).css("box-shadow","0 0 0px 0px rgb(253, 18, 18)");
            $("#tel-msg").text("");
        }
    });

    $("#add-addr").click(function(){
        if($("#rname").val()=="" || $("#specific-addr").val()=="" || $("#r-tel").val()=="" || $("#city option:selected").text()=="" || $("#area option:selected").text()==""){
            $("#add-msg").text("请继续完善以上加星号的信息");
            return false;
        }else{
            return true;
        }
    });

    $(".c-button").click(function(){
        var text = $(this).text();
        $("#category").val(text);
    });

    $(".cancel").click(function(){
        if($(this).text()=="取消默认"){
            $(this).parent().removeClass("selected");
            $(this).parent().children(".classify").removeClass("default");
            $(this).text("设为默认");
        }else{
            $(this).parent().addClass("selected");
            $(this).parent().children(".classify").addClass("default");
            $(this).text("取消默认");
            $(this).parent().siblings(".selected").children(".classify").removeClass("default");
            $(this).parent().siblings(".selected").children(".cancel").text("设为默认");
            $(this).parent().siblings(".selected").removeClass("selected");
        }        
    });
});