<?php

namespace App\Service;

class Rss2Reader
{
    private $url            = '';
    private $content_obj    = null;

    public function __construct($url)
    {
        $this->setUrl($url);
        $this->download();
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function download(){

        if($this->url == ''){
            return false;
        }

        $res = file_get_contents($this->url);
        if($res == ''){
            return false;
        }

        $obj = new \SimpleXmlElement($res);
        if(!$obj){
            return false;
        }
        $this->content_obj = $obj;
        return true;
    }

    public function getChannel() {
        if(is_null($this->content_obj)){
            return false;
        }

        return $this->content_obj;
    }
}