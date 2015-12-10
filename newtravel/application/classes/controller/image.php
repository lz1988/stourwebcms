<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Image extends Stourweb_Controller
{
    /**
     * 图片首页
     */
    public function action_index()
    {
        global $cfg_public_url;
        $this->assign('parentkey', $this->params['parentkey']);
        $this->assign('itemid', $this->params['itemid']);
        $this->parentkey = $this->params['parentkey'];
        $this->itemid = $this->params['itemid'];
        $weblist = Common::getWebList();
        $this->assign('weblist', $weblist);
        $this->assign('pulic', $cfg_public_url);
        $this->display('stourtravel/image/index');
    }

    /**
     * 目录导入
     */
    public function action_dir_import()
    {

        $sql = "select * from sline_image_group";
        $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $this->assign('dir', $rows);
        $this->assign('uploads', Common::getConfig('image.upload_path'));
        $this->display('stourtravel/image/import');
    }

    /**
     * 扫描目录名
     */
    public function  action_dir_scan()
    {
        require(Kohana::find_file('image', 'image'));
        $obj = new Image();
        $path = Arr::get($_POST, 'path');
        $path = $path == Common::getConfig('image.upload_path') ? '' : $path;
        $dirs = $obj->image_dir_list($path);
        echo json_encode(array('dirs' => $dirs, 'count' => count($dirs)));
    }

    /**
     * 扫描指定目录
     */
    public function action_target_dir()
    {
        require(Kohana::find_file('image', 'image'));
        $obj = new Image();
        $path = Arr::get($_POST, 'path');
        $group = Arr::get($_POST, 'group');
        $data = $obj->image_dir_scan($path);
        foreach ($data as $v) {
            $image = ORM::factory('image');
            $url = str_replace(array($this->baseDir, '\\'), array('', '/'), $v[0]);
            $result = $image->where('url', '=', $url)->find();
            if (!$result->loaded()) {
                $image->group_id = $group;
                $image->url = $url;
                $image->size = $v[1];
                $image->save();
            }
        }
        echo 'success!';

    }

    /**
     * 添加分组
     */
    public function action_group_view()
    {

        $this->display('stourtravel/image/view');
    }

    /**
     * 图片管理
     * 重命名、删除、移动
     */
    public function action_image_manage()
    {
        $action = Arr::get($_POST, 'action');
        $name = Arr::get($_POST, 'name');
        $id = Arr::get($_POST, 'id');
        $group_id = Arr::get($_POST, 'pid');
        switch ($action) {
            case 'rename':
                $sql = "update sline_image set image_name='{$name}' where id={$id}";
                $rows = DB::query(Database::UPDATE, $sql)->execute();
                break;
            case 'delete':
                $sql = "delete from sline_image where id in ({$id})";
                $rows = DB::query(Database::DELETE, $sql)->execute();
                break;
            case 'find':
                $p = (Arr::get($_POST, 'page') - 1) * 30;
                $rows = DB::query(Database::SELECT, "select image_name as name,url,id from sline_image where group_id ={$group_id} and is_hidden='0' order by id desc limit $p,30")->execute()->as_array();
                foreach ($rows as $k => $v) {
                    if (!isset($v['name']{0})) {
                        $rows[$k]['name'] = preg_replace('/\.(jpg|jpeg|gif|png)/', '', basename($v['url']));
                    }
                    if (strlen(Common::getConfig('image.img_domain')) > 0) {
                        $rows[$k]['url'] = rtrim(Common::getConfig('image.img_domain'), '/') . $v['url'];
                    }
                }
                break;
            case 'move':
                $sql = "update sline_image set group_id={$group_id} where id in ({$id})";
                $rows = DB::query(Database::DELETE, $sql)->execute();
                break;
        }
        echo json_encode($rows);
    }

    /**
     * 批量移动视图
     */
    public function action_image_move()
    {
        global $cfg_public_url;
        $sql = "select * from sline_image_group";
        $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $this->assign('publicPath', $cfg_public_url);
        $this->assign('group', $rows);
        $this->assign('ids', $this->params['id']);
        $this->display('stourtravel/image/move');
    }

    /**
     * 分组管理
     * 重命名、添加、删除、移动
     */
    public function action_group_manage()
    {
        global $cfg_public_url;
        $action = Arr::get($_POST, 'action');
        $group_name = Arr::get($_POST, 'name');
        $description = Arr::get($_POST, 'description');
        $group_id = Arr::get($_POST, 'id');
        switch ($action) {
            case 'rename':
                $sql = "update sline_image_group set group_name='{$group_name}' where group_id={$group_id}";
                $rows = DB::query(Database::UPDATE, $sql)->execute();
                break;
            case 'add':
                if (!$group_name) {
                    echo json_encode(0);
                    exit();
                }
                $sql = "insert into sline_image_group (group_name,description) values ('{$group_name}','{$description}')";
                list($rows) = DB::query(Database::INSERT, $sql)->execute();
                break;
            case 'delete':
                //删除组
                $sql = "delete from sline_image_group where group_id={$group_id}";
                $rows = DB::query(Database::DELETE, $sql)->execute();
                //删除组下图片
                $sql = "delete from sline_image where group_id={$group_id}";
                DB::query(Database::DELETE, $sql)->execute();
                break;
            case 'find':
                $sql = "select * from sline_image_group as g left join (select url,group_id as gid from sline_image group by group_id)as i on i.gid=g.group_id having g.group_id>1";
                $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
                foreach ($rows as $k => $v) {
                    if (is_null($v['url'])) {
                        $rows[$k]['url'] = $cfg_public_url . 'images/nopic.gif';
                    }
                }
                break;
        }
        echo json_encode($rows);
    }

    /**
     * 图片上传视图
     */
    public function action_upload_view()
    {
        global $cfg_public_url;
        $sql = "select * from sline_image_group";
        $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $this->assign('publicPath', $cfg_public_url);
        $this->assign('group', $rows);
        $this->assign('id', $this->params['groupid']);
        $this->display('stourtravel/image/upload_view');
    }

    /**
     * 图片上传
     */
    public function action_upload()
    {
        is_uploaded_file($_FILES['file']['tmp_name']) or exit;
        require(Kohana::find_file('image', 'image'));
        $obj = new Image();
        $ext = '.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
        $path = "/" . date('Y') . '/' . date('md') . '/' . md5($_FILES['file']['name'] . date('His')) . $ext;
        $filesize = filesize($_FILES['file']['tmp_name']);
        $temp = dirname(DOCROOT) . '/uploads/image.temp';
        if (move_uploaded_file($_FILES['file']['tmp_name'], $temp)) {
            $_FILES['file']['tmp_name'] = $temp;
        }
        if ($this->params['iswater'] > 0) {
            //添加水印
            $water = Common::getConfig('watermark');
            if ($water['watermark']['photo_markon'] == '1') {
                $this->setWater(
                    $_FILES['file']['tmp_name'],
                    $water['watermark']['photo_markimg'],
                    $water['watermark']['photo_marktext'],
                    $water['watermark']['photo_fontcolor'],
                    $water['watermark']['photo_waterpos'],
                    $water['watermark']['photo_fontsize'],
                    $water['watermark']['photo_marktype'],
                    $water['watermark']['photo_diaphaneity']
                );
            }
        }
        $bool = $obj->image_move($_FILES['file']['tmp_name'], $path);
        if ($bool) {
            $image = ORM::factory('image');
            $url = Common::getConfig('image.upload_path') . $path;
            $result = $image->where('url', '=', $url)->find();
            if (!$result->loaded()) {
                $image->group_id = $this->params['groupid'];
                $image->url = $url;
                $image->image_name = $this->params['name'] ? $this->params['name'] : '';
                $image->size = $filesize;
                $image->save();
            }
            if (strlen(Common::getConfig('image.img_domain')) > 0) {
                $url = rtrim(Common::getConfig('image.img_domain'), '/') . $url;
            }
            echo $url;
        }
        echo '';
    }

    /**
     * 编辑器插入图片
     */
    public function action_insert_view()
    {
        global $cfg_public_url;
        $sql = "select * from sline_image_group";
        $water = $this->params['iswater'] === '0' ? 0 : 1;
        $rows = DB::query(Database::SELECT, $sql)->execute()->as_array();
        $this->assign('publicPath', $cfg_public_url);
        $this->assign('group', $rows);
        $this->assign('iswater', $water);
        $this->display('stourtravel/image/insert_view');
    }

    /**
     * 图库配置
     */
    public function action_config()
    {
        $file = APPPATH . 'config/image.php';
        $config = include $file;
        $content = file_get_contents($file);
        if (isset($this->params['set'])) {
            $config['remote_image'] = Arr::get($_POST, 'remote_image');
            $config['img_domain'] = Arr::get($_POST, 'img_domain');
            if ($config['remote_image'] > 0) {
                $config['ftp_host'] = Arr::get($_POST, 'ftp_host');
                $config['ftp_port'] = Arr::get($_POST, 'ftp_port');
                $config['ftp_user'] = Arr::get($_POST, 'ftp_user');
                $config['ftp_pwd'] = Arr::get($_POST, 'ftp_pwd');
                $config['remote_upload'] = Arr::get($_POST, 'remote_upload');
                if (!function_exists('ftp_connect')) {
                    exit('FTP 扩展未开启');
                }
                $config['remote_image'] = true;
            } else {
                $config['remote_image'] = false;
                $config['ftp_host'] = '';
                $config['ftp_port'] = '';
                $config['ftp_user'] = '';
                $config['ftp_pwd'] = '';
                $config['remote_upload'] = '';
            }
            file_put_contents($file, preg_replace('/array\s?\(.*?\)/is', var_export($config, true), $content));
            echo 'success';
        } else {
            $this->assign('config', $config);
            $this->display('stourtravel/image/config');
        }
    }

    private function setWater($imgSrc, $markImg, $markText, $TextColor, $markPos, $fontSize, $markType, $markDiaphaneity)
    {


        $srcInfo = @getimagesize($imgSrc);
        $srcImg_w = $srcInfo[0];
        $srcImg_h = $srcInfo[1];
        if ($srcImg_w < 300) return;


        switch ($srcInfo[2]) {
            case 1:
                $srcim = imagecreatefromgif($imgSrc);
                break;
            case 2:
                $srcim = imagecreatefromjpeg($imgSrc);
                break;
            case 3:
                $srcim = imagecreatefrompng($imgSrc);
                break;
            default:
                die("不支持的图片文件类型");
                exit;
        }

        if (!strcmp($markType, "img")) //使用图片加水印.
        {
            $markImg = SLINEDATA . '/mark/' . $markImg;
            if (!file_exists($markImg) || empty($markImg)) {
                return;
            }
            $markImgInfo = getimagesize($markImg);
            $markImg_w = $markImgInfo[0];
            $markImg_h = $markImgInfo[1];
            switch ($markImgInfo[2]) {
                case 1:
                    $markim = imagecreatefromgif($markImg);
                    break;
                case 2:
                    $markim = imagecreatefromjpeg($markImg);
                    break;
                case 3:
                    $markim = imagecreatefrompng($markImg);
                    break;
                default:
                    die("不支持的水印图片文件类型");
                    exit;
            }
            $logow = $markImg_w;
            $logoh = $markImg_h;
        }
        if (!strcmp($markType, "text")) {
            $fontType = SLINEDATA . "/mark/STXINWEI.TTF";

            if (!empty($markText)) {
                if (!file_exists($fontType)) {
                    echo " fonttype not exist";
                    return;
                }
            } else {
                return;
            }

            $box = @imagettfbbox($fontSize, 0, $fontType, $markText);

            $logow = max($box[2], $box[4]) - min($box[0], $box[6]);
            $logoh = max($box[1], $box[3]) - min($box[5], $box[7]);
        }

        if ($markPos == 0) {
            $markPos = rand(1, 9);
        }

        switch ($markPos) {
            case 1:
                $x = +5;
                $y = +20;
                break;
            case 2:
                $x = ($srcImg_w - $logow) / 2;
                $y = +20;
                break;
            case 3:
                $x = $srcImg_w - $logow - 5;
                $y = +20;
                break;
            case 4:
                $x = +5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 5:
                $x = ($srcImg_w - $logow) / 2;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 6:
                $x = $srcImg_w - $logow - 5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 7:
                $x = +5;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 8:
                $x = ($srcImg_w - $logow) / 2;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 9:
                $x = $srcImg_w - $logow - 5;
                $y = $srcImg_h - $logoh - 5;
                break;
            default:
                die("此位置不支持");
                exit;
        }

        $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);
        imagecopy($dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);
        if (!strcmp($markType, "img")) {
            imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);
            imagedestroy($markim);

        }

        if (!strcmp($markType, "text")) {
            $TextColor = str_replace('rgb(', '', $TextColor);
            $TextColor = str_replace(')', '', $TextColor);
            $rgb = explode(',', $TextColor);

            $color = imagecolorallocate($dst_img, intval($rgb[0]), intval($rgb[1]), intval($rgb[2]));

            imagettftext($dst_img, $fontSize, 0, $x, $y, $color, $fontType, $markText);


        }
        switch ($srcInfo[2]) {
            case 1:
                imagegif($dst_img, $imgSrc);
                break;
            case 2:
                imagejpeg($dst_img, $imgSrc);
                break;
            case 3:
                imagepng($dst_img, $imgSrc);
                break;
            default:
                die("不支持的水印图片文件类型");
                exit;
        }
        imagedestroy($dst_img);
        imagedestroy($srcim);
    }
//end
}