<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\TradeMark;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = Department::all();
        $brands = TradeMark::all();
        return view('blog')->with([
            'department' => $department,
            'brands' => $brands
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
