<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/6 0006
 * Time: 17:48
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SskcOrder;

class TestController extends Controller
{
    public function index(){
        return SskcOrder::all();
    }
}