<style>
    .item{
        background-color: #F4C591;
        display: flex;
    }
    .info{
        vertical-align: middle; 
        width: 60%;       
    }
    .img,.box{
        border: white solid 1px;
    }
    .img{
        padding: 30px;      
        width: 40%;  
        text-align: center;
    }
    .box1{
        height: 15%;
    }
    .box2{
        height: 55%;
    }
</style>
<?php
$type=$_GET['type']??0;
$nav='';
$goods=null;
if($type==0){
    $nav="全部商品";
    $goods=$Goods->all(['sh'=>1]);
}else{
    $t=$Type->find($type);
    if($t['big_id']==0){
        $nav=$t['name'];
        $goods=$Goods->all(['sh'=>1, 'big'=>$t['id']]);
    }else{
        $b=$Type->find($t['big_id']);
        $nav=$b['name'] . " > " .$t['name'];
        $goods=$Goods->all(['sh'=>1, 'mid'=>$t['id']]);
    }
}
?>
<h2><?=$nav;?></h2>
<?php
foreach($goods as $good){
?>
<div class="item">
    <div class="img">
        <a href="?do=detail&id=<?=$good['id'];?>">
            <img src="./img/<?=$good['img'];?>" style="width:200px;height:150px">
        </a>
    </div>
    <div class="info">
        <div class="ct tt box box1"><?=$good['name'];?></div>
        <div class="box box1">
            價錢：<?=$good['price'];?>
            <img src="./icon/0402.jpg" style="float:right" onclick="buy(<?=$good['id'];?>,1)">
        </div>
        <div class="box box1">規格：<?=$good['spec'];?></div>
        <div class="box box2">簡介：<?=mb_substr($good['intro'],0,25);?>...</div>
    </div>
</div>
<?php
}
?>
<script>
function buy(id,qt){
    $.post("./api/buycart.php",{id,qt},(amount)=>{
        $("#amount").text(amount)
    })
}
</script>