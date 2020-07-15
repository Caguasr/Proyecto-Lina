<?php
class ViewControllers {
    private static $view_path = './views/';
    public function  load_view($views){
        require_once(self::$view_path . 'header.php');
        require_once(self::$view_path . $views . '.php');
        require_once(self::$view_path . 'footer.php');
    }

    public function __destruct()
    {
        //unset();
    }
}