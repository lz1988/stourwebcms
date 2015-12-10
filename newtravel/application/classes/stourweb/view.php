<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Acts as an object wrapper for HTML pages with embedded PHP, called "views".
 * Variables can be assigned with the view object and referenced locally within
 * the view.
 *
 * @package    Kohana
 * @category   Base
 * @author     Kohana Team
 * @copyright  (c) 2008-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Stourweb_View {

    // Array of global variables
    protected static $_global_data = array();

    /**
     * Returns a new View object. If you do not define the "file" parameter,
     * you must call [Stourweb_View::set_filename].
     *
     *     $view = Stourweb_View::factory($file);
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  View
     */
    public static function factory($file = NULL, array $data = NULL)
    {
        return new Stourweb_View($file, $data);
    }

    /**
     * Captures the output that is generated when a view is included.
     * The view data will be extracted to make local variables. This method
     * is static to prevent object scope resolution.
     *
     *     $output = Stourweb_View::capture($file, $data);
     *
     * @param   string  $kohana_view_filename   filename
     * @param   array   $kohana_view_data       variables
     * @return  string
     */
    public  function capture($kohana_view_filename, array $kohana_view_data)
    {

        self::$_user_data = $kohana_view_data + self::$_global_data;
        // Import the view variables to local namespace
        extract($kohana_view_data, EXTR_SKIP);

        if (Stourweb_View::$_global_data)
        {
            // Import the global view variables to local namespace
            extract(Stourweb_View::$_global_data, EXTR_SKIP | EXTR_REFS);
        }


        // Capture the view output
        ob_start();

        try
        {
            $to = APPPATH.'/cache/tplcache/'.$this->_templet.'.php';

            $isfileto = is_file($to);
            if(!$isfileto || filemtime($kohana_view_filename) > filemtime($to) || (filesize($to) == 0 && filesize($kohana_view_filename) > 0) || MODE==1)
            {
                $file_content = self::get_file($kohana_view_filename);
                $new_content = self::compile_template($file_content,$this->_data);
                self::write_file($to,$new_content);//写缓存文件.
            }
            include($to);

            // Load the view within the current scope

        }
        catch (Exception $e)
        {
            // Delete the output buffer
            ob_end_clean();

            // Re-throw the exception
            throw $e;
        }

        // Get the captured output and close the buffer
        return ob_get_clean();
    }

    /**
     * Sets a global variable, similar to [Stourweb_View::set], except that the
     * variable will be accessible to all views.
     *
     *     Stourweb_View::set_global($name, $value);
     *
     * @param   string  $key    variable name or an array of variables
     * @param   mixed   $value  value
     * @return  void
     */
    public static function set_global($key, $value = NULL)
    {
        if (is_array($key))
        {
            foreach ($key as $key2 => $value)
            {
                Stourweb_View::$_global_data[$key2] = $value;
            }
        }
        else
        {
            Stourweb_View::$_global_data[$key] = $value;
        }
    }

    /**
     * Assigns a global variable by reference, similar to [Stourweb_View::bind], except
     * that the variable will be accessible to all views.
     *
     *     Stourweb_View::bind_global($key, $value);
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  referenced variable
     * @return  void
     */
    public static function bind_global($key, & $value)
    {
        Stourweb_View::$_global_data[$key] =& $value;
    }

    // View filename
    protected $_file;

    // template_name;
    protected $_templet;

    // Array of local variables
    protected $_data = array();

    //static Array
    public static $_user_data = array();

    /**
     * Sets the initial view filename and local data. Views should almost
     * always only be created using [Stourweb_View::factory].
     *
     *     $view = new View($file);
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  void
     * @uses    Stourweb_View::set_filename
     */
    public function __construct($file = NULL, array $data = NULL)
    {
        if ($file !== NULL)
        {
            $this->set_filename($file);
        }

        if ($data !== NULL)
        {
            // Add the values to the current data
            $this->_data = $data + $this->_data;
            self::$_user_data = $this->_data;
        }
    }

    /**
     * Magic method, searches for the given variable and returns its value.
     * Local variables will be returned before global variables.
     *
     *     $value = $view->foo;
     *
     * [!!] If the variable has not yet been set, an exception will be thrown.
     *
     * @param   string  $key    variable name
     * @return  mixed
     * @throws  Kohana_Exception
     */
    public function & __get($key)
    {
        if (array_key_exists($key, $this->_data))
        {
            return $this->_data[$key];
        }
        elseif (array_key_exists($key, Stourweb_View::$_global_data))
        {
            return Stourweb_View::$_global_data[$key];
        }
        else
        {
            throw new Kohana_Exception('View variable is not set: :var',
                array(':var' => $key));
        }
    }

    /**
     * Magic method, calls [Stourweb_View::set] with the same parameters.
     *
     *     $view->foo = 'something';
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  value
     * @return  void
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Magic method, determines if a variable is set.
     *
     *     isset($view->foo);
     *
     * [!!] `NULL` variables are not considered to be set by [isset](http://php.net/isset).
     *
     * @param   string  $key    variable name
     * @return  boolean
     */
    public function __isset($key)
    {
        return (isset($this->_data[$key]) OR isset(Stourweb_View::$_global_data[$key]));
    }

    /**
     * Magic method, unsets a given variable.
     *
     *     unset($view->foo);
     *
     * @param   string  $key    variable name
     * @return  void
     */
    public function __unset($key)
    {
        unset($this->_data[$key], Stourweb_View::$_global_data[$key]);
        unset(self::$_user_data[$key], Stourweb_View::$_global_data[$key]);
    }

    /**
     * Magic method, returns the output of [Stourweb_View::render].
     *
     * @return  string
     * @uses    Stourweb_View::render
     */
    public function __toString()
    {
        try
        {
            return $this->render();
        }
        catch (Exception $e)
        {
            /**
             * Display the exception message.
             *
             * We use this method here because it's impossible to throw and
             * exception from __toString().
             */
            $error_response = Kohana_Exception::_handler($e);

            return $error_response->body();
        }
    }

    /**
     * Sets the view filename.
     *
     *     $view->set_filename($file);
     *
     * @param   string  $file   view filename
     * @return  View
     * @throws  View_Exception
     */
    public function set_filename($file)
    {
        $this->_templet = $file; //模板文件

        if (($path = Kohana::find_file('views', $file)) === FALSE)
        {
            throw new View_Exception('The requested view :file could not be found', array(
                ':file' => $file,
            ));
        }

        // Store the file path locally
        $this->_file = $path;

        return $this;
    }

    /**
     * Assigns a variable by name. Assigned values will be available as a
     * variable within the view file:
     *
     *     // This value can be accessed as $foo within the view
     *     $view->set('foo', 'my value');
     *
     * You can also use an array to set several values at once:
     *
     *     // Create the values $food and $beverage in the view
     *     $view->set(array('food' => 'bread', 'beverage' => 'water'));
     *
     * @param   string  $key    variable name or an array of variables
     * @param   mixed   $value  value
     * @return  $this
     */
    public function set($key, $value = NULL)
    {
        if (is_array($key))
        {
            foreach ($key as $name => $value)
            {
                $this->_data[$name] = $value;

            }
        }
        else
        {
            $this->_data[$key] = $value;
        }

        return $this;
    }

    /**
     * Assigns a value by reference. The benefit of binding is that values can
     * be altered without re-setting them. It is also possible to bind variables
     * before they have values. Assigned values will be available as a
     * variable within the view file:
     *
     *     // This reference can be accessed as $ref within the view
     *     $view->bind('ref', $bar);
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  referenced variable
     * @return  $this
     */
    public function bind($key, & $value)
    {
        $this->_data[$key] =& $value;

        return $this;
    }

    /**
     * Renders the view object to a string. Global and local data are merged
     * and extracted to create local variables within the view file.
     *
     *     $output = $view->render();
     *
     * [!!] Global variables with the same key name as local variables will be
     * overwritten by the local variable.
     *
     * @param   string  $file   view filename
     * @return  string
     * @throws  View_Exception
     * @uses    Stourweb_View::capture
     */
    public function render($file = NULL)
    {
        if ($file !== NULL)
        {
            $this->set_filename($file);
        }

        if (empty($this->_file))
        {
            throw new View_Exception('You must set the file to use within your view before rendering');
        }

        // Combine local and global data and capture the output
        return Stourweb_View::capture($this->_file, $this->_data);
    }
    /**
     *@模板编译
     *@param $string $html
     *@reutn $html
     */
    public function compile_template($str) {


        $str = preg_replace("/\<\!\-\-\[(.+?)\]\-\-\>/", "", $str); //去注释 <!--[注释内容]-->
        $str = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $str); //特殊用法,将<!--{$var}--> 解析成{$var}
        $str = preg_replace("/\{template\s+([^\}]+)\}/", "<?php echo  Stourweb_View::template(\\1);  ?>", $str); //引用模板
        $str = preg_replace("/\{php\s+(.+)\}/", "<?php \\1?>", $str); //php表达式解析
        $str = preg_replace("/\{if\s+(.+?)\}/", "<?php if(\\1) { ?>", $str); //if标签
        $str = preg_replace("/\{else\}/", "<?php } else { ?>", $str); //else标签
        $str = preg_replace("/\{elseif\s+(.+?)\}/", "<?php } else if(\\1) { ?>", $str); //else if
        $str = preg_replace("/\{\/if\}/", "<?php } ?>\r\n", $str); //if结束
        $str = preg_replace("/\{loop\s+(\S+)\s+(\S+)\}/", "<?php \$n=1; if(is_array(\\1)) { foreach(\\1 as \\2) { ?>", $str); //循环数组
        $str = preg_replace("/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/", "<?php \$n=1; if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>", $str);
        $str = preg_replace("/\{\/loop\}/", "<?php \$n++;}unset(\$n); } ?>", $str); //循环结束
        $str = preg_replace("/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*\(([^{}]*)\))\}/", "<?php echo \\1;?>", $str); //函数解析func($pa,$pa2)
        $str = preg_replace("/<\?php([^\?]+)\?>/es", "self::template_addquote('<?php\\1?>')", $str); //
        $str = preg_replace("/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\+\-\x7f-\xff]*)\}/", "<?php echo \\1;?>", $str);//{$msg}变量解析
        $str = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es", "self::template_addquote('<?php echo \\1;?>')", $str); //数组解析 $arr['name']
        $str = preg_replace("/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s", "<?php echo \\1;?>", $str); //常量解析如:SLINEROOT.
        $str = preg_replace("/\'([A-Za-z]+)\[\'([A-Za-z\.]+)\'\](.?)\'/s", "'\\1[\\2]\\3'", $str);
        $str = preg_replace("/\{st:(\w+)\s+([^}]+)\}/ie", "self::st_tag_start('$1','$2')", $str); //标签解析
        $str = preg_replace("/\{\/st\}/ie", "", $str);//标签结束
        $str = preg_replace("/(\r?\n)\\1+/", "\\1", $str);
        $str = str_replace("\t", '', $str);

        return $str;
    }

    public function template_addquote($var) {
        return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
    }
    /**
     * 解析ST标签
     * @param string $op 操作类
     * @param string $data 参数
     * @param string $html 匹配到的所有的HTML代码
     */
    public static function st_tag_start($op, $data)
    {



        preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($data), $matches, PREG_SET_ORDER);

        $params = array();//标签参数

        foreach ($matches as $v)
        {

            $params[$v[1]] = $v[2];
        }



        $str = '';

        $return = isset($params['return']) && trim($params['return']) ? trim($params['return']) : 'data'; //默认返回数组
        $action = $params['action'];

        //  if (!isset($action) || empty($action)) return false;//操作方法

        if (file_exists(Kohana::find_file('classes','taglib/'.$op)))
        {

            $str .= '$'.$op.'_tag = new Taglib_'.ucfirst($op).'();if (method_exists($'.$op.'_tag, \''.$action.'\')) {';
            $str .= '$'.$return.' = $'.$op.'_tag->'.$action.'('.self::arr_to_html($params).');';
            $str .= '}';
        }


        return "<?php " .$str."?".">";
    }

    /**
     * ST标签结束
     */
    private static function st_tag_end()
    {
        return '';
    }

    /**
     * 转换数据为HTML代码
     * @param array $data 数组
     */
    private static function arr_to_html($data) {
        if (is_array($data))
        {
            $str = 'array(';
            foreach ($data as $key=>$val)
            {
                if (is_array($val))
                {
                    $str .= "'$key'=>".self::arr_to_html($val).",";
                }
                else
                {
                    if (strpos($val, '$')===0)
                    {
                        $str .= "'$key'=>$val,";
                    }
                    else
                    {
                        $str .= "'$key'=>'".addslashes($val)."',";
                    }
                }
            }
            return $str.')';
        }
        return false;
    }
    /**
     * 写文件
     * @param string $filename
     * @param string $data
     * @return true if success
     * */
    public function write_file($filename, $data)
    {

        $filearr= explode('/',$filename); //拆分路径,创建模板对应目录
        array_pop($filearr);
        $folder = implode('/',$filearr);
        self::create_folders($folder);
        if(@$fp = fopen($filename, 'wb')) {
            flock($fp, LOCK_EX);
            $len = fwrite($fp, $data);
            flock($fp, LOCK_UN);
            fclose($fp);
            return $len;
        } else {
            die("Notice:Cache can not be written ,please check right");
            return false;
        }
    }
    public function create_folders($dir)
    {
        return is_dir ( $dir ) or (self::create_folders ( dirname ( $dir ) ) and mkdir ( $dir, 0777 ));
    }

    /**
     * 获取文件内容
     * @param string $filename,绝对路径
     * @return true if success
     * */
    public function get_file($filename)
    {
        return @file_get_contents($filename);
    }
    /**
     * 删除文件
     * @param string $filename,绝对路径
     * @return true if success
     * */
    public function del_file($filename)
    {
        return is_file($filename) ? @unlink($filename) : false;
    }
    /**引用文件
     * @param string 引入文件名
     * */
    public static function template($file)
    {

        echo Stourweb_View::factory($file,self::$_user_data);
    }



}
