<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 企业荣誉控制器
*/
class HonorController extends Controller
{

  public function index()
  {

    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************查询信息*************************/
    $infoSql="SELECT company_info.* FROM company_info   WHERE  type=5";
    $infoList=$model->query($infoSql);

    $this->assign("info",$infoList[0]);


    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];//获取要修改信息的id

    $title=$_POST['title'];
    $key_words=$_POST['key_words'];
    $content=$_POST['content'];




    $updateSql="UPDATE company_info SET title='".$title."', content='".$content."',key_words='".$key_words."' WHERE id=".$updateId;




     $model->execute($updateSql);


     $this->redirect('index');



  }







}

?>