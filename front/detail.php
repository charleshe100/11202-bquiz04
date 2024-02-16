<?php
$goods=$Goods->find($_GET['id']);
?>
<style>
    .item{
        background-color: #F4C591;
        display: flex;
    }
    .info{
        vertical-align: middle; 
        width: 40%;       
    }
    .img,.box{
        border: white solid 1px;
    }
    .img{
        padding: 5px;        
        width: 60%;       
    }
    .box1{
        height: 10%;
    }
    .box2{
        height: 56%;
    }
    
</style>
<h2 class="ct"><?=$goods['name'];?></h2>
<div class="item">
    <div class="img">
     <a href="?id=<?=$goods['id'];?>">
        <img src="./img/<?=$goods['img'];?>" style="width:400px;height:300px">
     </a>
    </div>
    <div class="info">
        <div class="box box1">分類：<?=$Type->find($goods['big'])['name'];?> > <?=$Type->find($goods['mid'])['name'];?></div>
        <div class="box box1">編號：<?=$goods['no'];?></div>
        <div class="box box1">價錢：<?=$goods['price'];?></div>
        <div class="box box2">詳細說明：<?=$goods['intro'];?></div>
        <div class="box box1">庫存量：<?=$goods['stock'];?></div>
    </div>
</div>
<div class="tt ct">
    購買數量：
    <input type="number" id="qt" value="1" style="width:50px">
    <img src="./icon/0402.jpg" onclick="buy()">
</div>
<script>
function buy(){
    let id=<?=$_GET['id'];?>;
    let qt=$("#qt").val()
    location.href=`?do=buycart&id=${id}&qt=${qt}`
}
</script>