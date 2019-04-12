function checkName(){
    var val = document.getElementById("uname").value;
    //使用正则进行格式判断
    var exp = /^\w{1,15}$/;
    var p = document.getElementById("name_msg");
    if(exp.test(val)){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "用户名不能为空或字数不符";
        p.style.color= "rgba(255,0,0,0.8)";
        return false;
    }
}
function checkPwd(){
    var val = document.getElementById("passwd").value;
    var exp = /.{1,}/;
    var p = document.getElementById("pwd_msg");
    if(exp.test(val)){
        p.innerHTML="";
        return true;
    }else{
        p.innerHTML = "密码不能为空或字数不符";
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
    var c = checkVerify();
    return a && b && c;
}
function refresh()
{
    var img = document.getElementById("capture");
    now = new Date(); 
    img.src = "./getVerify.php?code="+now.getTime();
}
