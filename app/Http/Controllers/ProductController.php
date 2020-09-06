<?php

namespace App\Http\Controllers;

use App\Model\Department;
use App\Model\Product;
use App\Model\TradeMark;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $department = Department::all();
        $brands = TradeMark::all();
        $productBrand = Product::find($id)->tradeMark;
        $recommndProduct = Product::recommendProducts();

        return view('product')->with([
            'product' => $product,
            'department' => $department,
            'brands' => $brands,
            'productBrand' => $productBrand,
            'recommndProduct' => $recommndProduct
        ]);
    }

}
