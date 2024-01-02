<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
   public function dashboard()
   {
        $urls = Url::where('user_id',auth()->id())->orderBy('created_at','desc')->get();
        return view('dashboard', compact('urls'));
   }
}
