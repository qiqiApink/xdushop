<?php
function addCate($link)
{
    $arr = $_POST;
    if(insert($link, "xdushop_cate", $arr))
    {
        $mes = "分类添加成功!<br/><a href='addCate.php'>继续添加</a> | <a href='listCate.php'>查看分类列表</a>";
    }
    else
    {
        $mes = "分类添加失败!<br/><a href='addCate.php'>重新添加</a>";
    }
    return $mes;
}

function editCate($link, $id)
{
    $arr = $_POST;
    if(update($link, "xdushop_cate", $arr, "id={$id}"))
    {
        $mes = "编辑成功!<br/><a href='listCate.php'>查看分类列表</a>";
    }
    else
    {
        $mes = "编辑失败!<br/><a href='listCate.php'>重新编辑</a>";
    }
    return $mes;
}

function delCate($link, $id)
{
    $res = checkProExist($link, $id);
    if(!$res)
    {
        if(delete($link, "xdushop_cate", "id={$id}"))
        {
            $mes = "删除成功!<br/><a href='listCate.php'>查看分类列表</a>";
        }
        else
        {
            $mes = "删除失败!<br/><a href='listCate.php'>重新删除</a>";
        }
        return $mes;
    }
    else
    {
        alertMes("不能删除分类，请先删除该分类下的商品", "listPro.php");
    }
}

function getAllCate($link)
{
    $sql = "select id,cName from xdushop_cate order by id";
    $rows = fetchAll($link, $sql);
    return $rows;
}
