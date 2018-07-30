<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 人才招聘控制器
*/
class RecruitController extends Controller
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
    $infoSql="SELECT * FROM recruit WHERE  state=1 ORDER BY pub_time DESC,id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM recruit WHERE id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $position=$_POST['position'];  //获取修改的信息
    $introduction=$_POST['introduction'];

    $time=date('Y-m-d');

    $updateSql="UPDATE recruit SET position='".$position."', introduction='".$introduction."',pub_time='".$time."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();

    $position=$_POST['position'];  //获取修改的信息
    $introduction=$_POST['introduction'];

    $time=date('Y-m-d');





    $addSql="INSERT INTO recruit(position,introduction,pub_time) values ('".$position."','".$introduction."','".$time."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE recruit SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>