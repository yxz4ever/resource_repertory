<?php
    /**
     * 遍历某个目录下的全部文件
     */
    function index(){
        $dir = dirname(__FILE__);
        listDir($dir);
    }
    
    function listDir($dir) {
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    if ((is_dir($dir . "/" . $file)) && $file != "." && $file != "..") {
                        echo "<b><font color='red'>文件名：</font></b>", $file, "<br><hr>";
                        listDir($dir . "/" . $file . "/");
                    } else {
                        if ($file != "." && $file != "..") {
                            echo $file . "<br>";
                        }
                    }
                }
                closedir($dh);
            }
        }
    }

