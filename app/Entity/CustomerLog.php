<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午4:42
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{

    protected $table = 'customer_log';

    protected $primaryKey = 'id';
}