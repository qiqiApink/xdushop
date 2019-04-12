$(function () {
    $("#new-nickname").hide();
    $("#edit-g").hide();
    $("#edit-h").hide();
    $("#edit-b").hide();
    $("#save").hide();
    $(".change-portrait").hide();
    $("#history-tag").parent().children("dd").hide();
    $("#security-tag").parent().children("dd").hide();


    $("#info-tag").click(function () {
        var className = $(this).attr("class");
        if (className == 'close') {
            $(this).children("img").attr("src", "./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        } else if (className == "open") {
            $(this).children("img").attr("src", "./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $("#security-tag").click(function () {
        var className = $(this).attr("class");
        if (className == 'close') {
            $(this).children("img").attr("src", "./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        } else if (className == "open") {
            $(this).children("img").attr("src", "./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $("#history-tag").click(function () {
        var className = $(this).attr("class");
        if (className == 'close') {
            $(this).children("img").attr("src", "./images/myOrder/myOrder2.png");
            $(this).removeClass("close");
            $(this).addClass("open");
        } else if (className == "open") {
            $(this).children("img").attr("src", "./images/myOrder/myOrder1.png");
            $(this).removeClass("open");
            $(this).addClass("close");
        }
        $(this).parent().children("dd").slideToggle();
    });

    $(".edit").click(function () {
        if ($(this).text() == "编辑") {
            $(this).text("取消编辑");

            $(".ur-nickname").hide();
            $("#new-nickname").show();

            $(".ur-gender").hide();
            $(".ur-birthday").hide();
            $(".ur-hometown").hide();
            $(".change-portrait").show();
            $("#edit-g").show();
            $("#edit-b").show();
            $("#edit-h").show();
            $("#save").show();
        }else{
            $(this).text("编辑");

            $(".ur-nickname").show();
            $("#new-nickname").hide();

            $(".ur-gender").show();
            $(".ur-birthday").show();
            $(".ur-hometown").show();
            $("#edit-g").hide();
            $("#edit-b").hide();
            $("#edit-h").hide();
            $("#save").hide();
            $(".change-portrait").hide();
        }

    });
});
