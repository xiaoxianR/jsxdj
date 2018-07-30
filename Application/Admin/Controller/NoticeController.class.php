<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 公告信息控制器
*/
class NoticeController extends Controller
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
    $infoSql="SELECT * FROM notice WHERE state=1 ORDER BY pub_time DESC,id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM notice WHERE id=".$editInfoId." and state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $introduction=$_POST['introduction'];  //获取修改的信息

    $updateTime=date('Y-m-d');
    //echo $updateTime."<br>";



    $updateSql="UPDATE notice SET introduction='".$introduction."', pub_time='".$updateTime."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();



    $introduction=$_POST['introduction'];

    $addTime=date('Y-m-d');

    $addSql="INSERT INTO notice(introduction,pub_time) values ('".$introduction."','".$addTime."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE notice SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>