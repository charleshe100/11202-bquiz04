<?php include_once "db.php";
$table=$_POST['table'];
unset($_POST['table']); //因為sql資料表裡沒有table欄位，所以要先清掉
$db=new DB($table);
$chk=$db->count($_POST);

if($chk){
    echo $chk;
    $_SESSION[$table]=$_POST['acc'];
}else{
    echo $chk;
}
?>