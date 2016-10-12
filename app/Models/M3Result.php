<?php

/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/21
 * Time: 下午8:14
 */
namespace App\Models;
class M3Result
{

    public $status;
    public $message;

    public function toJson()
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}