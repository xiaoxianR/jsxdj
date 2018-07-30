<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 基本配置控制器
*/
class BasicController extends Controller
{

  public function index()
  {

    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************查询信息(头部信息、底部信息、联系我们)*************************/
    $infoSql="SELECT * FROM basic WHERE type=1 or type=2 or type=3";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id
    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM basic WHERE id=".$editInfoId;
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];
    $introduction=$_POST['introduction'];  //获取修改的信息

    $updateSql="UPDATE basic SET introduction='".$introduction."' WHERE id=".$updateId;
    $model->execute($updateSql);

    $this->redirect('index');

  }





}

?>