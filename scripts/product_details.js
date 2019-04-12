$(function(){
    $(".plus").click(function(){
        var n = parseInt($("#num-input").val());
        if(n<100){
            n++;
            $("#num-input").val(n);
        }
    });

    $(".reduce").click(function(){
        var n = parseInt($("#num-input").val());
        if(n>1){
            n--;
            $("#num-input").val(n);
        }
    });

    $("#num-input").blur(function(){
        var n = parseInt($("#num-input").val());
        if(n>100){
            $("#num-input").val("100");
        }else if(n<1){
            $("#num-input").val("1");
        }
    });
});