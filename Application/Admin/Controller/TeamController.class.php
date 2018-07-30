<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 团队成员控制器
*/
class TeamController extends Controller
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
    $infoSql="SELECT * FROM team WHERE  state=1";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM team WHERE id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $name=$_POST['name'];
    $position=$_POST['position'];  //获取修改的信息
    $words=$_POST['words'];

    $updateSql="UPDATE team SET name='".$name."', position='".$position."',words='".$words."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();

    $name=$_POST['name'];
    $position=$_POST['position'];  //获取修改的信息
    $words=$_POST['words'];




    $addSql="INSERT INTO team(name,position,words) values ('".$name."','".$position."','".$words."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE team SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>