<?php
// 用GD库做验证码
function verifyImage()
{
    session_start();

    // 创建画布
    $width = 120;
    $height = 33;
    $image = imagecreatetruecolor($width, $height);
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    // 用填充矩形填充画布
    imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);
    $type = mt_rand(1, 3);
    $length = mt_rand(4, 6);
    $chars = buildRandomString($type, $length);
    $sess_name = "verify";
    $_SESSION[$sess_name] = $chars;
    $fontfiles = array('Vera.ttf', 'VeraBd.ttf', 'VeraMoBI.ttf', 'VeraMoIt.ttf', 'VeraSe.ttf', 'VeraBI.ttf', 'VeraIt.ttf', 'VeraMoBd.ttf', 'VeraMono.ttf', 'VeraSeBd.ttf');
    for($i = 0; $i < $length; $i++)
    {
        $size = mt_rand(14, 18);
        $angle = mt_rand(-15, 15);
        $x = 5 + $i * $size;
        $y = mt_rand(20, 26);
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        $fontfile = "/var/www/html/xdushop/fonts/".$fontfiles[mt_rand(0, count($fontfiles)-1)];
        $text = substr($chars, $i, 1);
        imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
    }

    // 制作干扰
    for($i = 0; $i < mt_rand(40, 50); $i++)
    {
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        imagesetpixel($image, mt_rand(0, $width-1), mt_rand(0, $height-1), $color);
    }
    for($i = 0; $i < mt_rand(3, 5); $i++)
    {
        $color = imagecolorallocate($image, mt_rand(50, 90), mt_rand(80, 200), mt_rand(90, 180));
        imageline($image, mt_rand(0, $width-1), mt_rand(0, $height-1), mt_rand(0, $width-1), mt_rand(0, $height-1), $color);
    }

    // 显示并销毁画布
    header("content-type: image/gif");
    imagegif($image);
    imagedestroy($image);
}

// 生成缩略图
function thumb($filename, $destination=null, $dst_w=null, $dst_h=null, $isReservedSource=true, $scale=0.5)
{
    list($src_w, $src_h, $imagetype) = getimagesize($filename);
    if(is_null($dst_w) || is_null($dst_h))
    {
        $dst_w = ceil($src_w * $scale);
        $dst_h = ceil($src_h * $scale);
    }
    $mime = image_type_to_mime_type($imagetype);
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun = str_replace("/", null, $mime);
    $src_image = $createFun($filename);
    $dst_image = imagecreatetruecolor($dst_w, $dst_h);
    imagecopyresampled($dst_image, $src_image, 0, 0, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
    if($destination && !file_exists(dirname($destination)))
    {
        exit("请于当前目录下创建" . dirname($destination) . "目录");
    }
    $dstFilename = $destination == null ? getUniName() . "." . getExt($filename) : $destination;
    $outFun($dst_image, $dstFilename);
    imagedestroy($src_image);
    imagedestroy($dst_image);
    if(!$isReservedSource)
    {
        unlink($filename);
    }
    return $dstFilename;
}

// 添加文字水印
function waterText($filename, $text="xdushop", $fontfile="Vera.ttf")
{
    $fileInfo = getimagesize($filename);
    $mime = $fileInfo['mime'];
    $createFun = str_replace("/", "createfrom", $mime);
    $outFun = str_replace("/", null, $mime);
    $image = $createFun($filename);
    $color = imagecolorallocatealpha($image, 105, 105, 105, 50);
    $fontfile = "../fonts/{$fontfile}";
    imagettftext($image, 14, 0, 0, 14, $color, $fontfile, $text);
    $outFun($image, $filename);
    imagedestroy($image);
}

// 添加图片水印
function waterPic($dstFile,$srcFile="../images/logo.png",$pct=30)
{
    $srcFileInfo = getimagesize($srcFile);
    $src_w = $srcFileInfo[0];
    $src_h = $srcFileInfo[1];
    $dstFileInfo = getimagesize($dstFile);
    $srcMime = $srcFileInfo['mime'];
    $dstMime = $dstFileInfo['mime'];
    $createSrcFun = str_replace( "/", "createfrom", $srcMime);
    $createDstFun = str_replace( "/", "createfrom", $dstMime);
    $outDstFun = str_replace( "/", null, $dstMime);
    $dst_im = $createDstFun($dstFile);
    $src_im = $createSrcFun($srcFile);
    imagecopymerge($dst_im, $src_im, 0, 0, 0, 0, $src_w, $src_h, $pct);
    $outDstFun($dst_im, $dstFile);
    imagedestroy($src_im);
    imagedestroy($dst_im);
}
