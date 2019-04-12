<?php
function buildInfo()
{
    if(!$_FILES)
    {
        return;
    }
    $i = 0;
    foreach($_FILES as $file)
    {
        if(is_string($file['name']))
        {
            $files[$i] = $file;
            $i++;
        }
        else
        {
            foreach($file['name'] as $key => $val)
            {
                $files[$i]['name'] = $val;
                $files[$i]['size'] = $file['size'][$key];
                $files[$i]['tmp_name'] = $file['tmp_name'][$key];
                $files[$i]['error'] = $file['error'][$key];
                $files[$i]['type'] = $file['type'][$key];
                $i++;
            }
        }
    }
    return $files;
}

function uploadFile($path="uploads", $allowExt=array("gif", "jpeg", "jpg", "png", "wbmp"), $maxSize=2097152, $imgFlag=1)
{
    if(!file_exists($path))
    {
        exit("请先于当前目录下创建{$path}目录");
    }
    $i = 0;
    $files = buildInfo();
    if(!($files && is_array($files)))
    {
        return;
    }
    foreach($files as $file)
    {
        if($file['error'] === UPLOAD_ERR_OK)
        {
            $ext = getExt($file['name']);
            if(!in_array($ext, $allowExt))
            {
                exit("非法文件类型");
            }
            if($imgFlag)
            {
                if(!getimagesize($file['tmp_name']))
                {
                    exit("不是真正的图片类型");
                }
            }
            if($file['size'] > $maxSize)
            {
                exit("上传文件过大");
            }
            if(!is_uploaded_file($file['tmp_name']))
            {
                exit("不是通过HTTP POST方式上传的");
            }
            $filename = getUniName() . "." . $ext;
            $destination = $path . "/" . $filename;
            if(move_uploaded_file($file['tmp_name'], $destination))
            {
                $file['name'] = $filename;
                unset($file['tmp_name'], $file['size'], $file['type']);
                $uploadedFiles[$i] = $file;
                $i++;
            }
        }
        else
        {
            switch($file['error'])
            {
            case 1:
                exit("超过了配置文件上传文件的大小");
            case 2:
                exit("超过了表单设置上传文件的大小");
            case 3:
                exit("文件部分被上传");
            case 4:
                exit("没有文件被上传");
            case 5:
                exit("没有找到临时目录");
            case 6:
                exit("文件不可写");
            case 7:
                exit("PHP的拓展程序中断了文件上传");
            }
        }
    }
    return $uploadedFiles;
}
