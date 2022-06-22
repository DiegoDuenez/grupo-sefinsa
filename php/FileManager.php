<?php


class FileManager{

    public static $key = 'file';

    public static function errors($key = 'file')
    {
        return $_FILES[$key]['error'];
    }

    public static function get($key = 'file',$property)
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

}