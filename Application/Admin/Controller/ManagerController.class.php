<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 管理员控制器
*/
class ManagerController extends Controller
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
    $infoSql="SELECT purview.*,manager.name,manager.pwd  FROM purview JOIN manager ON purview.manager_id=manager.id   WHERE  manager.state=1 ";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT purview.*,manager.name,manager.pwd  FROM purview JOIN manager ON purview.manager_id=manager.id  WHERE manager.id=".$editInfoId." AND manager.state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $basic_set=$_POST['basic_set'];  //获取修改的信息
    if (!isset($basic_set)) {
      $basic_set=0;
    }


    $company_set=$_POST['company_set'];
    if (!isset($company_set)) {
      $company_set=0;
    }


    $business_set=$_POST['business_set'];
    if (!isset($business_set)) {
      $business_set=0;
    }

    $case_set=$_POST['case_set'];
    if (!isset($case_set)) {
      $case_set=0;
    }

    $news_set=$_POST['news_set'];
    if (!isset($news_set)) {
      $news_set=0;
    }

    $product_type_set=$_POST['product_type_set'];
    if (!isset($product_type_set)) {
      $product_type_set=0;
    }

    $product_set=$_POST['product_set'];
    if (!isset($product_set)) {
      $product_set=0;
    }

    $question_set=$_POST['question_set'];
    if (!isset($question_set)) {
      $question_set=0;
    }

    $recruit_set=$_POST['recruit_set'];
    if (!isset($recruit_set)) {
      $recruit_set=0;
    }

    $team_set=$_POST['team_set'];
    if (!isset($team_set)) {
      $team_set=0;
    }

    $message_set=$_POST['message_set'];
    if (!isset($message_set)) {
      $message_set=0;
    }

    $link_set=$_POST['link_set'];
    if (!isset($link_set)) {
      $link_set=0;
    }

    // echo "co=".$company_set."<br>";
    // echo "basic_set=".$basic_set."<br>";




     $updateSql="UPDATE purview SET basic_set=".$basic_set.", company_set=".$company_set.",business_set=".$business_set.", case_set=".$case_set.", news_set=".$news_set.", product_type_set=".$product_type_set.", product_set=".$product_set.", question_set=".$question_set.", recruit_set=".$recruit_set.", team_set=".$team_set.", message_set=".$message_set.", link_set=".$link_set." WHERE id=".$updateId;

    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();


    $name=$_POST['name'];
    $pwd=$_POST['pwd'];

    //$addTime=date('Y-m-d');
    //echo $updateTime."<br>";

    //添加管理员
    $addSql="INSERT INTO manager(name,pwd) VALUES ('".$name."','".$pwd."')";
    $model->execute($addSql);

    //查询新增管理员id
    $idSql="SELECT MAX(id) AS maxid FROM manager";
    $idList=$model->query($idSql);
    $managerId=$idList[0]['maxid'];

    //添加新增管理员权限：所有权限默认为0
    $purviewSql="INSERT INTO purview(manager_id) VALUES (".$managerId.")";
    $model->execute($purviewSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE manager SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>