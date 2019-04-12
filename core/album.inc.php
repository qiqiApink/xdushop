<?php
function addAlbum($link, $arr)
{
    insert($link, "xdushop_album", $arr);
}

function getProImgById($link, $id)
{
    $sql = "select albumPath from xdushop_album where pid={$id} limit 1";
    $row = fetchOne($link, $sql);
    return $row;
}

function getProImgsById($link, $id)
{
    $sql = "select albumPath from xdushop_album where pid={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function doWaterText($link, $id)
{
    $rows = getProImgsById($link, $id);
    foreach($rows as $row)
    {
        $filename = "../image_350/" . $row['albumPath'];
        waterText($filename);
    }
    $mes = "添加成功</br><a href='listProImages.php'>查看图片列表</a>";
    return $mes;
}

function doWaterPic($link, $id)
{
    $rows = getProImgsById($link, $id);
    foreach($rows as $row)
    {
        $filename = "../image_350/" . $row['albumPath'];
        waterPic($filename);
    }
    $mes = "添加成功</br><a href='listProImages.php'>查看图片列表</a>";
    return $mes;
}
