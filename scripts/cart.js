
$(function(){

    $(".num-input").blur(function(){
        if(parseInt($(this).val())>100 || parseInt($(this).val())<=0){
            $(this).val("1");
            $(this).parent().siblings(".prod-money").children(".money").text($(this).parent().siblings(".prod-price").children(".price").html());
        }else{
            var n = parseInt($(this).val());
            var money = n*parseFloat($(this).parent().siblings(".prod-price").children(".price").html());
            $(this).parent().siblings(".prod-money").children(".money").text(parseFloat(money).toFixed(2));
        }
        total();
    });
    
    $(".plus").click(function(){
        var $p = $(this).parent().children(".num-input");
        var n = parseInt($p.val());
        if(n<100){
            n++;
            $p.val(n);
            var money = parseFloat($(this).parent().siblings(".prod-price").children(".price").html())*n;
            $(this).parent().siblings(".prod-money").children(".money").text(parseFloat(money).toFixed(2));
        }
        total();
    });

    $(".reduce").click(function(){
        var $p = $(this).parent().children(".num-input");
        var n = parseInt($p.val());
        if(n>1){
            n--;
            $p.val(n);
            var money = parseFloat($(this).parent().siblings(".prod-price").children(".price").html())*n;
            $(this).parent().siblings(".prod-money").children(".money").text(parseFloat(money).toFixed(2));
        }
        total();
    });

    $(".square").click(function(){
        if($(this).hasClass("normal")){
            $(this).removeClass("normal");
            $(this).addClass("selected");
            $(this).children("img").attr("src","./images/cart/product_true.png");
            if($(".normal").length==0){
                $(".buy-all").children("img").attr("src","./images/cart/product_true.png");
            }
        }else{
            $(this).removeClass("selected");
            $(this).addClass("normal");
            $(this).children("img").attr("src","./images/cart/product_normal.png");
            $(".buy-all").children("img").attr("src","./images/cart/product_normal.png");
        }
        total();
    });

    $(".buy-all").click(function(){
        if($(".buy-all").children("img").attr("src")=="./images/cart/product_normal.png"){
            $(".buy-all").children("img").attr("src","./images/cart/product_true.png");
            $(".square").children("img").attr("src","./images/cart/product_true.png");
            $(".square").attr("class","square selected");
        }else{
            $(".buy-all").children("img").attr("src","./images/cart/product_normal.png");
            $(".square").children("img").attr("src","./images/cart/product_normal.png");
            $(".square").attr("class","square normal");
        }
        total();
    });

    function total(){
        var items = $(".selected");
        var total = 0.00;
        var money;
        var p;
        if(items.length!=0){
            for(var i=0;i<items.length;i++){
                p = items[i];
                money = parseFloat($(p).parent().siblings(".prod-money").children(".money").text());
                total = total + money;
            }
            $(".c-money").text(parseFloat(total).toFixed(2));
            $(".c-count").text(items.length);
        }else{
            $(".c-money").text("0.00");
            $(".c-count").text("0");
        }
    }

});
