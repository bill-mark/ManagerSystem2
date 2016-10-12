<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午4:42
 */

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class CustomerListFilter extends Model
{
    protected $table = 'customer_list_filter';
    protected $primaryKey = 'id';
}