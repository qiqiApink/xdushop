<?php
// 数据库连接
function connect($username, $password, $host='localhost')
{
    $link = mysqli_connect($host, $username, $password, DB_NAME) or die("Cannot connect to the database. Error: " . mysqli_errno($link) . ":" . mysqli_error($link));
    mysqli_set_charset($link, DB_CHARSET);
    return $link;
}

// 数据库插入
function insert($link, $table, $array)
{
    $keys = join(",", array_keys($array));
    $vals = "'" . join("','", array_values($array)) . "'";
    $sql = "insert into {$table}({$keys}) values({$vals})";
    $result = mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}

// 数据库更新
function update($link, $table, $array, $where=null)
{
    foreach($array as $key => $val)
    {
        if($str == null)
        {
            $sep = '';
        }
        else
        {
            $sep = ',';
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
    $sql = "update {$table} set {$str}" . ($where==null ? null : " where {$where}");
    $result = mysqli_query($link, $sql);
    if($result)
    {
        return mysqli_affected_rows($link);
    }
    else
    {
        return false;
    }
}

// 删除数据
function delete($link, $table, $where=null)
{
    $where = $where==null ? null : " where {$where}";
    $sql = "delete from {$table} {$where}";
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}

// 查询一条记录
function fetchOne($link, $sql)
{
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}

// 查询多条记录
function fetchAll($link, $sql)
{
    $result = mysqli_query($link, $sql);
    while(@$row = mysqli_fetch_assoc($result))
    {
        $rows[] = $row;
    }
    return $rows;
}

// 得到结果集中的记录条数
function getResultNum($link, $sql)
{
    $result = mysqli_query($link, $sql);
    return mysqli_num_rows($result);
}

// 得到上一部插入记录的id号
function getInsertId($link)
{
    return mysqli_insert_id($link);
}
