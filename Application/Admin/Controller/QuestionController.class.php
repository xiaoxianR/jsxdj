<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 新闻动态控制器
*/
class QuestionController extends Controller
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
    $infoSql="SELECT * FROM question WHERE  state=1 ORDER BY pub_time DESC,id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM question WHERE id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $title=$_POST['title'];  //获取修改的信息
    $key_words=$_POST['key_words'];
    $answer=$_POST['answer'];

    $updateTime=date('Y-m-d');
    //echo $updateTime."<br>";
    //


    $updateSql="UPDATE question SET title='".$title."', answer='".$answer."',pub_time='".$updateTime."',key_words='".$key_words."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();


   $title=$_POST['title'];  //获取修改的信息
   $key_words=$_POST['key_words'];
    $answer=$_POST['answer'];

    $addTime=date('Y-m-d');
    //echo $updateTime."<br>";
    //




    $addSql="INSERT INTO question(title,answer,pub_time,key_words) values ('".$title."','".$answer."','".$addTime."','".$key_words."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE question SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>