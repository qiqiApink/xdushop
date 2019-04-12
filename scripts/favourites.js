$(function(){

    $(".mask").hide();
    $("#s-hidden").hide();
    $("#manage-button").click(function(){
        if($(this).hasClass("normal")){
            $(".mask").show();
            $("#s-hidden").show();
            $(this).removeClass("normal");
            $(this).addClass("show");
            $(this).text("取消管理");
        }else{
            $(".mask").hide();
            $("#s-hidden").hide();
            $(this).removeClass("show");
            $(this).addClass("normal");
            $(this).text("批量管理");
        }
    });

    $(".mask").click(function(){
        var div = $(this).children("div");
        var className = div.attr("class");
        if(className=='unchecked fr'){
            div.attr("class","checked fr");
            div.children("img").attr("src","./images/myCollect/product_true_big.png");
            if($(".mask .unchecked").length==0){
                $("#all img").attr("src","./images/myCollect/product_true.png");
            }
        }else{
            div.attr("class","unchecked fr");
            div.children("img").attr("src","./images/myCollect/product_normal_big.png");
            $("#all img").attr("src","./images/myCollect/product_normal.png");
        }
    });

    $("#all").click(function(){
        var img = $(this).children("img");
        var src = img.attr("src");
        var div = $(".mask").children("div");
        if(src=="./images/myCollect/product_normal.png"){
            img.attr("src","./images/myCollect/product_true.png");
            div.attr("class","checked fr");
            div.children("img").attr("src","./images/myCollect/product_true_big.png");
        }else{
            img.attr("src","./images/myCollect/product_normal.png");
            div.attr("class","unchecked fr");
            div.children("img").attr("src","./images/myCollect/product_normal_big.png");
        }
    });

    $("#del").click(function(){
        if($(".mask .checked").length==0){
            $("#modalNo").removeClass("display-none");
        }else{
            $("#modal").removeClass("display-none");
        }
    });

    $("#add-to-cart").click(function(){
        if($(".mask .checked").length==0){
            $("#modalAdd").removeClass("display-none");
        }
        else{
            $("#modalYi").removeClass("display-none");
        }
    });

    $(".close").click(function(){
        $("#modal").addClass("display-none");
        $("#modalYi").addClass("display-none");
        $("#modalNo").addClass("display-none");
        $("#modalAdd").addClass("display-none");
    });

    $("#del-no").click(function(){
        $("#modal").addClass("display-none");
    });

    $("#cart-no").click(function(){
        $("#modalYi").addClass("display-none");
    });

/*
    $("#del-yes").click(function(){
        var arr = $(".checked");
        for(var i=0;i<arr.length;i++){
            arr[i].parent().parent().remove();
        }
    });


    $("#cart-yes").click(function(){
        var arr = $(".checked");
        for(var i=0;i<arr.length;i++){
            arr[i].parent().parent().remove();
        }
    });
*/
    function getId(){
        var arr = new Array();
        arr = $(".checked");
        var ids = new Array();
        var p;
        for(var i=0;i<arr.length;i++){
            p = arr[i];
            var id = $(p).parent().siblings(".pro-id").html();
            ids.push(id);
        }
        return ids;
    }

    
});
