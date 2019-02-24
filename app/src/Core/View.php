<?php

namespace PHPSailors\Core;

class View{

    private $file_name;
    private $data;
    private $file_content;

    public function __construct()
    {
        $this->file_content = '';
    }


    public function renderview($file_name, $data):void {

        if(is_null($file_name)){
            throw new \Exception('Cannot render a view without specifying a file name.');
        }

        $this->file_name = $file_name;
        $this->data = $data;
        if(file_exists(TEMPLATES.$this->file_name.'.php')){
            require_once (TEMPLATES.$this->file_name.'.php');
        } else{
            throw new \Exception('The requested view cannot be found.');
        }
    }

    public function get($data_item){
        return isset($this->data[$data_item]) ? $this->data[$data_item] : 'Data cannot be found';
    }

}