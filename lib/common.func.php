<?php
// 弹出提示信息，并跳转
function alertMes($mes, $url)
{
    echo "<script>alert('{$mes}');</script>";
    echo "<script>window.location='{$url}';</script>";
}
