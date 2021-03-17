<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function test()
    {
    	return response()->json(['success'=>'Got Simple Ajax Request.']);
    }
}
