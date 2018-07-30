/**
 * 验证input是否为空
 */
function checkinput(){
   //alert("check");
   var name = document.getElementById("name").value;

   var pwd = document.getElementById("pwd").value;
   if(name ==  null || name == ''){
      alert("请输入用户名!");
      document.getElementById("name").focus();
      return false;
  }

  if(pwd ==  null || pwd == ''){
      alert("请输入密码!");
      document.getElementById("pwd").focus();
      return false;
  }


  return true;
}