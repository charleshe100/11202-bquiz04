<h2 class="ct">商品分類</h2>
<div class="ct">
    新增大分類 <input type="text" name="big" id="big">
              <button onclick="addType('big')">新增</button>
</div>
<div class="ct">
    新增中分類 
    <select name="big" id="bigs"></select>
    <input type="text" name="mid" id="mid">
    <button onclick="addType('mid')">新增</button>
</div>
<table class="all">
<?php
$bigs=$Type->all(['big_id'=>0]);
foreach($bigs as $big){
?>
    <tr class="tt">
        <td><?=$big['name'];?></td>
        <td class="ct">
            <button onclick="edit(this,<?=$big['id'];?>)">修改</button>
            <button onclick="del('type',<?=$big['id'];?>)">刪除</button>
        </td>
    </tr>
<?php
    $mids=$Type->all(['big_id'=>$big['id']]);
    foreach($mids as $mid){
?>
    <tr class="pp ct">
        <td><?=$mid['name'];?></td>
        <td>
        <button onclick="edit(this,<?=$mid['id'];?>)">修改</button>
        <button onclick="del('type',<?=$mid['id'];?>)">刪除</button>
        </td>
    </tr>   
<?php
    }
}
?> 
</table>
<script>
// 0是大分類
getTypes(0)
// 因為上面用this，就是所在的dom，所以這裡用dom
function edit(dom,id) {
    let name=prompt("請輸入你要修改的分類名稱：",`${$(dom).parent().prev().text()}`)
    if(name!=null){
        $.post("./api/save_type.php",{name,id},()=>{
            // 可以從某個地方拿東西，就可以把它放回去，這是ajax的方法
            $(dom).parent().prev().text(name)
            //用reload，畫面會重整，畫面會往上跑
            // location.reload() 
        })
    }
}

function getTypes(big_id){
    $.get("./api/get_types.php",{big_id},(types)=>{
        $("#bigs").html(types)
    })
}

function addType(type) {
    let name
    let big_id
    switch(type){
        case 'big':
            name=$("#big").val()
            big_id=0
        break;
        case 'mid':
            name=$("#mid").val()
            big_id=$("#bigs").val()
        break;
    }
    $.post("./api/save_type.php",{name,big_id},()=>{
        location.reload()
    })
}
</script>

<h2 class="ct">商品管理</h2>
<div class="ct">
    <button onclick="location.href='?do=add_goods'">新增商品</button>
</div>
<table class="all">
    <tr class="tt ct">
        <td>編號</td>
        <td>商品名稱</td>
        <td>庫存量</td>
        <td>狀態</td>
        <td>操作</td>
    </tr>
    <tr class="pp">
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button>修改</button>
            <button>刪除</button>
            <button>上架</button>
            <button>下架</button>
        </td>
    </tr>
</table>