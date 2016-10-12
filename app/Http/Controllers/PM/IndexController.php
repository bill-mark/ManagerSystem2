<?php
/**
 * Created by PhpStorm.
 * User: powman
 * Date: 16/7/28
 * Time: 上午7:01
 */

namespace App\Http\Controllers\PM;

use App\Http\Controllers\Controller;
use App\Models\M3Result;
use Illuminate\Http\Request;
use \Mail;

class IndexController extends Controller
{
    public function toIndex()
    {
        return view('pm.index');
    }

    public function toWelcome()
    {
        return view('welcome02');
    }


}
