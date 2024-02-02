<?php include_once "db.php";
// 註冊功能
// $_POST['regdate']=date("Y-m-d");
// $Mem->save($_POST);

// 前台註冊功能 與 後台編輯功能
if(!isset($_POST['id'])){
    $_POST['regdate']=date("Y-m-d");
}
$Mem->save($_POST);

if(isset($_POST['id'])){
    to("../back.php?do=mem");
}