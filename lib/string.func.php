<?php
function buildRandomString($type=1, $length=4)
{
    if($type == 1)
    {
        $chars = join("", range(0,9));
    }
    elseif($type == 2)
    {
        $chars = join("", array_merge(range('a', 'z')));
    }
    elseif($type == 3)
    {
        $chars = join("", array_merge(range('a', 'z'), range('A', 'Z')));
    }
    if($length > strlen($chars))
    {
        exit("length out of range");
    }
    $chars = str_shuffle($chars);
    return substr($chars, 0, $length);
}

function getUniName()
{
    return md5(uniqid(microtime(true), true));
}

function getExt($filename)
{
    $parts = explode(".", $filename);
    $file_ext = strtolower(end($parts));
    return $file_ext;
}
