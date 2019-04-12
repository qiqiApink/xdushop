$(function(){ 
    var i = $(".order-item").length;
    var str = ''+i;
    $("#all-count").text(str);

    $("#coupon-tag").parent().children("dd").hide();

    $("#all-tag").click(function(){
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

    $("#coupon-tag").click(function(){
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
});
