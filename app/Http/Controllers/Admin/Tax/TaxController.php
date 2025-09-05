<?php

namespace App\Http\Controllers\Admin\Tax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxController extends Controller
{
     public function index()
    {
        return view('admin.pages.tax.index');
    }
       public function store()
    {
        try{
            dd("store");
            // return view('admin.pages.products.add');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
      public function create()
    {
        try{
            return view('admin.pages.tax.add');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function edit($taxSlug)
    {
        try{
            return view('admin.pages.tax.edit');
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
     public function update($taxSlug)
    {
        try{
            dd("update");
        }catch(\Throwable $e)
        {
            return redirect()->back();
        }
    }
}
