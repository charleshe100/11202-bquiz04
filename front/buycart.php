<?php
if(isset($_GET['id'])){
    $_SESSION['cart'][$_GET['id']]=$_GET['qt'];
}
if(!isset($_SESSION['mem'])){
    to("?do=login");
}

echo "<h2 class='ct'>{$_SESSION['mem']}的購物車</h2>";

if(empty($_SESSION['cart'])){ //這裡改為empty
    echo "<h2 class='ct'>購物車中尚無商品</h2>";
}else{
// else{
    // 若以下這段在這裡，登入後，購物車要重選，
    // 若在最上面，選商品後再登入，購物車內容會留著
    // if(isset($_GET['id'])){
    //     $_SESSION['cart'][$_GET['id']]=$_GET['qt'];
    // }
    // dd($_SESSION['cart']);
// }
?>
<table class="all">
    <tr class="tt ct">
        <th>編號</th>
        <th>商品名稱</th>
        <th>數量</th>
        <th>庫存量</th>
        <th>單價</th>
        <th>小計</th>
        <th>刪除</th>
    </tr>
<?php
foreach($_SESSION['cart'] as $id => $qt) {
    $goods=$Goods->find($id);
?>
    <tr class="pp ct">
        <td><?=$goods['no'];?></td>
        <td><?=$goods['name'];?></td>
        <td><?=$qt;?></td>
        <td><?=$goods['stock'];?></td>
        <td><?=$goods['price'];?></td>
        <td><?=$goods['price'] * $qt;?></td>
        <td><img src="./icon/0415.jpg" onclick="delCart(<?=$id;?>)"></td>
    </tr>

<?php
}
?>
</table>
<div class="ct">
    <img src="./icon/0411.jpg" onclick="location.href='index.php'">
    <img src="./icon/0412.jpg" onclick="location.href='?do=checkout'">
</div>
<script>
function delCart(id){
    $.post("./api/del_cart.php",{id},()=>{
        location.href="?do=buycart";
    })
}
</script>
<?php
}
?>