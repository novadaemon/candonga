<?php namespace Candonga\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index(Request $request)
    {
        return view('index');
    }
}

