<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\CartsDatatable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cart;
use Storage;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CartsDatatable $cart)
    {
        return $cart->render('admin.carts.index',['title'=> trans('admin.carts')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validate(request(),
        [
            'user_id'         => 'required|numeric',
            'product_id'    => 'required|numeric',
            'quantity'      => 'required|numeric',
            
            
        ], [] ,[
            'user_id'            => trans('admin.user_id'),
            'product_id'         => trans('admin.product_id'),
            'country_id'         => trans('admin.country_id'),
           
            
        ]);
       
        Cart::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('carts'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carts = Cart::find($id);
        $carts->delete();
        session()->flash('success', trans('admin.delete_record'));
		return redirect(aurl('carts'));
    }
    public function multi_delete()
    {
        if(is_array(request('item')))
        {
            foreach(request('item') as $id) {
                $carts = Cart::find($id);
                $carts->delete();
            }
        } else 
        {
            $carts = Cart::find(request('item'));
            
            $carts->delete();
        }
        session()->flash('success',trans('admin.delete_record'));
        return redirect(aurl('carts'));
    }
}
