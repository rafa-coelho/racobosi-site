<?php

require(BASE . "Lugh/autoload.php");

class Lugh
{
    // public static $urls = array();

    public static $URLS_GET = array();
    public static $URLS_POST = array();
    public static $URLS_PUT = array();
    public static $URLS_DELETE = array();
    public static $URLS_PATCH = array();

    public static $APP, $CLASS, $ACT;

    public function __construct()
    {
        $this->Run();
    }

    public function Run()
    {
        $match = false;
        $control = "";

        $urls = array();

        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                $urls = self::$URLS_GET;
                break;
            case "POST":
                $urls = self::$URLS_POST;
                break;
            case "PUT":
                $urls = self::$URLS_PUT;
                break;
            case "DELETE":
                $urls = self::$URLS_DELETE;
                break;
            case "PATCH":
                $urls = self::$URLS_PATCH;
                break;
        }

        foreach ($urls as $k => $v) {

            $uri = parse_url(URI);
            $matches = array();
            if (preg_match("#^\/?{$k}\/?$#i", $uri["path"], $matches)) {
                $match = true;
                $control = $v;

                foreach ($matches as $kk => $vv)
                    if (!is_numeric($kk) and $kk != 'querystring')
                        $_GET[$kk] = $vv;
            }
        }

        if ($match) {
            if (isset(explode(".", $control)[1])) {
                $str = explode(".", $control);
                self::$APP = $app = $str[0];
                self::$CLASS = $class = $str[1];
                self::$ACT = $act = $str[2];

                $file = BASE . "controllers/" . $app . "/" . $class . ".php";

                if (!file_exists($file))
                    die("O arquivo '$file' não existe!");

                include_once($file);

                if (!class_exists($class))
                    die("A classe '$class' não existe!");

                $c = new $class();

                if (!method_exists($c, $act))
                    die("A função '$act' não existe!");

                print_r($c->$act());
            }
        } else {
            $t = new Template("404");
            $t->display("404.phtml");
        }
    }

    // public static function setUrl($urls)
    // {
    //     foreach ($urls as $k => $v) {
    //         self::$urls[$k] = $v;
    //     }
    // }

    public static function addGet($url, $acao)
    {
        self::$URLS_GET[$url] = $acao;
    }

    public static function addPost($url, $acao)
    {
        self::$URLS_POST[$url] = $acao;
    }

    public static function addPut($url, $acao)
    {
        self::$URLS_PUT[$url] = $acao;
    }

    public static function addDelete($url, $acao)
    {
        self::$URLS_DELETE[$url] = $acao;
    }

    public static function addPatch($url, $acao)
    {
        self::$URLS_PATCH[$url] = $acao;
    }

    public static function loadClasses()
    {
        $data = func_get_args();
        foreach ($data as $d) {
            $file = BASE . "classes/$d.php";
            if (file_exists($file))
                require_once($file);
        }
    }


    static public function loadExtension()
    {
        $data = func_get_args();
        foreach ($data as $d) {
            if (file_exists(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.php'))
                require_once(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.php');
            else
				if (file_exists(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.class.php'))
                require_once(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.class.php');
            else
				if (file_exists(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.inc.php'))
                require_once(dirname(__FILE__) . '/../extensions/' . $d . '/' . $d . '.inc.php');
            else
				if (file_exists(dirname(__FILE__) . '/../extensions/' . $d . '/class.' . $d . '.php'))
                require_once(dirname(__FILE__) . '/../extensions/' . $d . '/class.' . $d . '.php');
            else
                die("FATAL ERROR: Class file not found {$d}");
        }
    }
}
