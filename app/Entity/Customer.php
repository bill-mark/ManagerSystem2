<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午4:42
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    protected $table = 'customer_basic';

    protected $primaryKey = 'id';
}