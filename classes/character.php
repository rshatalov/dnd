<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";

class Character
{
    public $name;
    public $avatar;
    public $uid;
    public function __construct($uid)
    {
        $this->uid = $uid;
        $this->name = "!!!";
    }
    
    public function template()
    {
        $t = <<<TEMPLATE

{$this->uid} {$this->name}
                
TEMPLATE;
    return $t;
    }
};
/*
$ch_info['avatar'] = "";
        $image = 'images/characters/' . $_SESSION['uid'] . '.png';
        if (file_exists($image))
            $ch_info['avatar'] = $image;
        
        
$ch = $_SESSION['email'];
$ch .= <<<m
        <hr/>
    <div id="avatar"><img height="150" width="150" src="{$ch_info['avatar']}"></div>
    <form enctype="multipart/form-data" method="post">
        <input type="file" name="file">
    <input type="submit">
    <input type="hidden" name="a" value="file_upload">
    </form>

m;

*/