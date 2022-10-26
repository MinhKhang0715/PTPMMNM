<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginationController extends Controller
{
     function index()
    {
     $data = DB::table('tbl_product')->paginate(5);
     return view('pagination', compact('data'));
    }

    function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $data = DB::table('tbl_product')->paginate(5);
      return view('pages.product', compact('data'))->render();
     }
    }
}
