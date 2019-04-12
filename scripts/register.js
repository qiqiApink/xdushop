function checkName(){
    var val = document.getElementById("uname").value;
    //使用正则进行格式判断
    var exp = /^\w{1,15}$/;
    var p = document.getElementById("name_msg");
    if(exp.test(val)){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "用户名应在1-15个字符之间（只能包含字母,数字,下划线）";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkPwd(){
    var val = document.getElementById("passwd").value;
    var exp = /.{6,}/;
    var p = document.getElementById("pwd_msg");
    if(exp.test(val)){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "密码应在6-15个字符之间";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkAgain(){
    var val01 = document.getElementById("passwd").value;
    var val02 = document.getElementById("again").value;
    var p = document.getElementById("again_msg");
    if(val01==val02&&val02){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "请再次输入密码";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkEmail(){
    var val = document.getElementById("email").value;
    var exp = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
    var p = document.getElementById("email_msg");
    if(exp.test(val)){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "邮箱格式不正确或为空";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkVerify(){
    var val = document.getElementById("verify").value;
    var p = document.getElementById("ver_msg");
    if(val){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "验证码不能为空";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkForm(){
    var a = checkName();
    var b = checkPwd();
    var c = checkAgain();
    var d = checkEmail();
    var e = checkVerify();
    return a && b && c && d && e; 
}
function refresh()
{
    var img = document.getElementById("capture");
    now = new Date();
    img.src = "./admin/getVerify.php?code="+now.getTime();
}
