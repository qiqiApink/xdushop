<?php
function addPro($link)
{
    $arr = $_POST;
    $arr['pubTime'] = time();
    $path = "./uploads";
    $uploadFiles = uploadFile($path);
    if(is_array($uploadFiles) && $uploadFiles)
    {
        foreach($uploadFiles as $key => $uploadFile)
        {
            thumb($path . "/" . $uploadFile['name'], "../image_50/" . $uploadFile['name'], 50, 50);
            thumb($path . "/" . $uploadFile['name'], "../image_220/" . $uploadFile['name'], 220, 220);
            thumb($path . "/" . $uploadFile['name'], "../image_350/" . $uploadFile['name'], 350, 350);
            thumb($path . "/" . $uploadFile['name'], "../image_800/" . $uploadFile['name'], 800, 800);
        }
    }
    $res = insert($link, "xdushop_pro", $arr);
    $pid = getInsertId($link);
    if($res && $pid)
    {
        foreach($uploadFiles as $uploadFile)
        {
            $arr1['pid'] = $pid;
            $arr1['albumPath'] = $uploadFile['name'];
            addAlbum($link, $arr1);
        }
        $mes = "添加成功<br/><a href='addPro.php'>继续添加</a> | <a href='listPro.php'>查看商品列表</a>";
    }
    else
    {
        foreach($uploadFiles as $uploadFile)
        {
            if(file_exists("uploads/" . $uploadFile['name']))
            {
                unlink("uploads/" . $uploadFile['name']);
            }
            if(file_exists("../image_50/" . $uploadFile['name']))
            {
                unlink("../image_50/" . $uploadFile['name']);
            }
            if(file_exists("../image_220/" . $uploadFile['name']))
            {
                unlink("../image_220/" . $uploadFile['name']);
            }
            if(file_exists("../image_350/" . $uploadFile['name']))
            {
                unlink("../image_350/" . $uploadFile['name']);
            }
            if(file_exists("../image_800/" . $uploadFile['name']))
            {
                unlink("../image_800/" . $uploadFile['name']);
            }
        }
        $mes = "添加失败<br/><a href='addPro.php'>重新添加</a>";
    }
    return $mes;
}

function getAllProByAdmin($link)
{
    $sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.xduPrice, p.pDesc, p.pubTime, p.isShow, p.isHot, c.cName from xdushop_pro as p join xdushop_cate c on p.cId = c.id";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getAllImgByProId($link, $id)
{
    $sql = "select albumPath from xdushop_album where pid={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getProById($link, $id)
{
    $sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.xduPrice, p.pDesc, p.pubTime, p.isShow, p.isHot, p.cId, c.cName from xdushop_pro as p join xdushop_cate c on p.cId = c.id where p.id={$id}";
    $row = fetchOne($link, $sql);
    return $row;
}

function editPro($link, $id)
{
    $arr = $_POST;
    $path = "./uploads";
    $uploadFiles = uploadFile($path);
    if(is_array($uploadFiles) && $uploadFiles)
    {
        foreach($uploadFiles as $key => $uploadFile)
        {
            thumb($path . "/" . $uploadFile['name'], "../image_50/" . $uploadFile['name'], 50, 50);
            thumb($path . "/" . $uploadFile['name'], "../image_220/" . $uploadFile['name'], 220, 220);
            thumb($path . "/" . $uploadFile['name'], "../image_350/" . $uploadFile['name'], 350, 350);
            thumb($path . "/" . $uploadFile['name'], "../image_800/" . $uploadFile['name'], 800, 800);
        }
    }
    $res = update($link, "xdushop_pro", $arr, "id={$id}");
    $pid = $id;
    if($res && $pid)
    {
        if(is_array($uploadFiles) && $uploadFiles)
        {
            foreach($uploadFiles as $uploadFile)
            {
                $arr1['pid'] = $pid;
                $arr1['albumPath'] = $uploadFile['name'];
                addAlbum($link, $arr1);
            }
        }
        $mes = "编辑成功<br/><a href='listPro.php'>查看商品列表</a>";
    }
    else
    {
        if(is_array($uploadFiles) && $uploadFiles)
        {
            foreach($uploadFiles as $uploadFile)
            {
                if(file_exists("uploads/" . $uploadFile['name']))
                {
                    unlink("uploads/" . $uploadFile['name']);
                }
                if(file_exists("../image_50/" . $uploadFile['name']))
                {
                    unlink("../image_50/" . $uploadFile['name']);
                }
                if(file_exists("../image_220/" . $uploadFile['name']))
                {
                    unlink("../image_220/" . $uploadFile['name']);
                }
                if(file_exists("../image_350/" . $uploadFile['name']))
                {
                    unlink("../image_350/" . $uploadFile['name']);
                }
                if(file_exists("../image_800/" . $uploadFile['name']))
                {
                    unlink("../image_800/" . $uploadFile['name']);
                }
            }
        }
        $mes = "编辑失败<br/><a href='listPro.php'>重新编辑</a>";
    }
    return $mes;
}

function delPro($link, $id)
{
    $res = delete($link, "xdushop_pro", "id={$id}");
    $proImgs = getAllImgByProId($link, $id);
    if($proImgs && is_array($proImgs))
    {
        foreach($proImgs as $proImg)
        {
            if(file_exists("uploads/" . $proImg['albumPath']))
            {
                unlink("uploads/" . $proImg['albumPath']);
            }
            if(file_exists("../image_50/" . $proImg['albumPath']))
            {
                unlink("../image_50/" . $proImg['albumPath']);
            }
            if(file_exists("../image_220/" . $proImg['albumPath']))
            {
                unlink("../image_220/" . $proImg['albumPath']);
            }
            if(file_exists("../image_350/" . $proImg['albumPath']))
            {
                unlink("../image_350/" . $proImg['albumPath']);
            }
            if(file_exists("../image_800/" . $proImg['albumPath']))
            {
                unlink("../image_800/" . $proImg['albumPath']);
            }
        }
    }
    $res1 = delete($link, "xdushop_album", "pid={$id}");
    if($res && $res1)
    {
        $mes = "删除成功<br/><a href='listPro.php'>查看商品列表</a>";
    }
    else
    {
        $mes = "删除失败<br/><a href='listPro.php'>重新删除</a>";
    }
    return $mes;
}

function checkProExist($link, $cid)
{
    $sql = "select * from xdushop_pro where cId={$cid}";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getAllPros($link)
{
    $sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.xduPrice, p.pDesc, p.pubTime, p.isShow, p.isHot, p.cId, c.cName from xdushop_pro as p join xdushop_cate c on p.cId=c.id";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getProsByCid($link, $cid)
{
    $sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.xduPrice, p.pDesc, p.pubTime, p.isShow, p.isHot, p.cId, c.cName from xdushop_pro as p join xdushop_cate c on p.cId=c.id where p.cId={$cid} limit 2";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getSmallProsByCid($link, $cid)
{
    $sql = "select p.id, p.pName, p.pSn, p.pNum, p.mPrice, p.xduPrice, p.pDesc, p.pubTime, p.isShow, p.isHot, p.cId, c.cName from xdushop_pro as p join xdushop_cate c on p.cId=c.id where p.cId={$cid} limit 2,3";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getProInfo($link)
{
    $sql = "select id, pName from xdushop_pro order by id asc";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getFavouriteByUserId($link, $id)
{
    $sql = "select id,proId from xdushop_favourite where userId={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getCartByUserId($link, $id)
{
    $sql = "select id, proId from xdushop_cart where userId={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}

function getOrdersByUserId($link, $id)
{
    $sql = "select id,proId,time,num from xdushop_order where userId={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}
