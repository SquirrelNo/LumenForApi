<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    //
    public function newsList() {
    	$list = \App\News::orderBy('order', 'desc')->skip(0)->take(3)->get();
    	return json_encode($list);
    }
}
