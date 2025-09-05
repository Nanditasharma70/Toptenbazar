<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @method home helps to display the home page.
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        return view('website.index');
    }
}
