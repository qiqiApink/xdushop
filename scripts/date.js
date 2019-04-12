$(document).ready(function () {
    var date = new Date();//创建日期对象
    var year = date.getFullYear();//获取当前年份
    for (var i = year; i >= (year - 100); i--) {//在id为year的selector附加option选项
        $("#year").append("<option value=\"" + i + "\">" + i + "</option>");//append函数附加html到元素结尾处
    }
    for (var i = 1; i <= 12; i++) {
        $("#month").append("<option value=\"" + i + "\">" + i + "</option>");//为Id为month的selector附加option选项
    }
    getDays($("#month").val(), $("#year").val());


});
function getDaysInMonth(month, year) {  //年月对应的日数算法
    var days;
    if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
        days = 31;//固定31
    } else if (month == 4 || month == 6 || month == 9 || month == 11) {
        days = 30;//固定30
    } else {
        if ((year % 4 == 0 && year % 100 != 0) || (year % 400 == 0)) {     //排除百年，每四年一闰；每四百年一闰；
            days = 29; //闰年29
        } else {
            days = 28; //平年28
        }
    }
    return days;//返回该年月的日数
}
function getDays() {
    var year = $("#year").val();//year selector onchange="getDays()"动态获取用户选择的year值
    var month = $("#month").val();//month selector onchange="getDays()"动态获取用户选择的month值
    var days = getDaysInMonth(month, year);//调用算法函数计算对应年月的日数
    $("#day").empty();//调用empty()函数清空day selector options，然后再append函数往day selector添加options
    for (var i = 1; i <= days; i++) {
        $("#day").append("<option value=\"" + i + "\">" + i + "</option>");
    }
}