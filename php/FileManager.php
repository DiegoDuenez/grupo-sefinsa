<?php

class FileManager{


    public static function errors($key)
    {
        return $_FILES[$key]['error'];
    }

    public static function get($key, $property)
    {
        return $_FILES[$key][$property];
    }

    public static function moveTo($from, $to)
    {
        move_uploaded_file($from, $to);

    }

    public static function fileExtension($name) {
        $n = strrpos($name, '.');
        return ($n === false) ? '' : substr($name, $n+1);
    }

    public static function createFolder($path){

        if (!is_dir($path)) {
            mkdir($path);
            return true;
        }
        return false;
        
    }

    public static function renameFolder($old, $new){

        if (is_dir($old)) {
            rename($old, $new);
            return true;
        }
        return false;
    }

    public static function getFiles($path){

        if (is_dir($path)) {
            $files = scandir($path);
            return $files;
        }
        else{
            return false;
        }
       
    }

    public static function dropFiles($path)
    {
        if(is_dir($path)){
            $files = glob("$path/*");
            foreach($files as $file){
                unlink($file); 
            }
        }
            
    }

}