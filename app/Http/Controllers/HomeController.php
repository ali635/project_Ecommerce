<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $products = Product::published()->orderBy('id' , 'desc');
        // if(request()->has('search') && request()->get('search') != ''){
        //     $products = $products->where('name' , 'like' , "%".request()->get('search')."%");
        // }
        // $products = $products->paginate(30);
        return view('style.home' );
    }

    

    public function login_test()
    {
        return view('auth.login');
    }
    public function show($id){

        $products = Product::find($id);

        // $cat = Category::findOrFail($id);
        // $videos = Video::published()->where('cat_id', $id)->orderBy('id' , 'desc')->paginate(30);

        return view('style.home' , compact('products'));
    }
}
