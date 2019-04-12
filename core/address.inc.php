<?php
function getAddressByUserId($link, $id)
{
    $sql = "select * from xdushop_address where userId={$id}";
    $rows = fetchAll($link, $sql);
    return $rows;
}
