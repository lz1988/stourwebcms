<?php
/**
 *  缩略图
 *  url   /image/index.php?/uploads/20150715/img/789/201325645_200x200.jpg
 *  cache /cache/200x200/md5(url)
 */
$query = $_SERVER['QUERY_STRING'];
if (strlen($query) < 1 && !preg_match('~_\d{2,}x\d{2,}\.(jpg|gif|png)$~', $query)) {
    exit;
}
preg_match('~^.*?(_(\d+)x(\d+))(\..*?)$~', $query, $file);
list($file, $clean, $width, $height, $ext) = $file;
$file = str_replace($clean, '', $file);
$cache = dirname(dirname(__FILE__)) . "/cache/" . ltrim($clean, '_') . '/' . md5($file) . $ext;
$file = realpath(dirname(dirname(__FILE__)) . $file);
switch ($ext) {
    case '.gif':
        $mime = 'image/gif';
        break;

    case '.png':
        $mime = 'image/jpeg';
        break;
    case '.jpg':
        $mime = 'image/jpeg';
        break;
}
header("Content-type: {$mime}");
//缩略图存在加载
if (file_exists($cache)) {
    echo file_get_contents($cache);
    exit();
}
//文件不存在
if (!file_exists($file)) {echo $file;
    exit();
}
$info = getimagesize($file);
list ($orgiWidth, $orgiHeight, $type) = $info;
//缩略图尺寸大于原图尺寸 加载原始图片
if ($orgiWidth < $width || $orgiHeight < $height) {
    echo file_get_contents($file);
    exit();
}
$percent=$width / $orgiWidth;
while(true){
    if($percent*$orgiHeight>=$height && $percent*$orgiWidth>=$width){
       break;
    }
    $percent += 0.001;
}
$thumWidth=floor($orgiWidth * $percent);
$thumHeight=floor($orgiHeight * $percent);
//生成缩率图缓存目录
if (!file_exists(dirname($cache))) {
    mkdir(dirname($cache), 0777, true);
}
//生成缩率图
$ext = ltrim($ext, '.');
$func = 'imagecreatefrom' . ($ext == 'jpg' ? 'jpeg' : $ext);
$resource = $func($file);
imagesavealpha($resource,true);
$thumbnail = imagecreatetruecolor($thumWidth, $thumHeight);
$image = imagecreatetruecolor($width, $height);
imagealphablending($thumbnail,false);
imagesavealpha($thumbnail,true);
imagecopyresampled($thumbnail, $resource, 0, 0, 0, 0, $thumWidth, $thumHeight, $orgiWidth, $orgiHeight);
imagesavealpha($image,true);
imagealphablending($image,false);
imagesavealpha($image,true);
imagecopy($image, $thumbnail, 0, 0, ($thumWidth - $width) / 2, ($thumHeight - $height), $thumWidth, $thumHeight);
switch ($type) {
    case 1:
        imagegif($image);
        imagegif($image, $cache);
        break;
    case 2:

        imagejpeg($image);
        imagejpeg($image, $cache);
        break;
    case 3:
        imagepng($image);
        imagepng($image, $cache);
        break;
}
imagedestroy($resource);
imagedestroy($thumbnail);
imagedestroy($image);
