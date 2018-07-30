/**
 * 验证input是否为空
 */
function checkinput(){   
   var name = document.getElementById("name").value;
   var content = document.getElementById("content").value;
   if(name ==  null || name == ''){
      alert("姓名不能为空!");
      return false;
  }

  if(content ==  null || content == ''){
      alert("留言内容不能为空!");
      return false;
  }  


  return true;
}