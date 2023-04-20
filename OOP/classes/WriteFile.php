<?php
class WriteFile{
    public $fp;

    public $file;

    public function __construct($file){
        $this -> file = $file;
        if(!is_writable($this->file)){
            echo "File {$this->file} can not be written";
            exit();
        }
        $this -> fp = fopen($this->file, 'a');
    }
    public function __destruct(){
        fclose($this->fp);
    }

    public function write($text){
        if(fwrite($this->fp, $text . PHP_EOL) === FALSE){
                echo "Can't write into file{$this->file}";
                exit();
            }
        }
}