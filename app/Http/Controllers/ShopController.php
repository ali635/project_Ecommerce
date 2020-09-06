<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\Department;
use App\Model\TradeMark;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::getRandProducts();
        $department = Department::all();
        $brands = TradeMark::all();
        return view('shop')->with([
            'products' => $products,
            'department' => $department,
            'brands' => $brands
        ]);
    }

}
