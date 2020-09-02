<?php

namespace App\Http\Controllers\Admin;

use App\Model\Product;
use App\Model\Size;
use App\Model\Weight;
use App\DataTables\ProductsDatatable;
use App\File as FileTbl;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\MallProducts;
use App\Model\OtherData;
use App\Model\RelatedProduct;
use Storage;

class ProductesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDatatable $product)
    {
        return $product->render('admin.products.index',['title'=> trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function repare_weight_size()
    {
        if(request()->ajax() and request()->has('dep_id'))
        {
            $dep_list = array_diff(explode(',',get_parent(request('dep_id'))), [request('dep_id')]);
            $sizes   = Size::where('is_public','yes')
            ->whereIn('department_id',$dep_list)
            ->orWhere('department_id',request('dep_id'))
            ->pluck('name_' . session('lang'), 'id');
            
            //$size_2   = Size::
            //$sizes    = array_merge(json_decode($size_1, true), json_decode($size_2, true));
           // return $sizes;
            $weights = Weight::pluck('name_' . session('lang'), 'id');
            return view('admin.products.ajax.size_weight',[
                'sizes'     => $sizes,
                'weights'   => $weights,
                'product'   => Product::find(request('product_id')), 
            ])->render();

        } else {

        }
    }

    public function create()
    {
        $product = Product::create([
            'title'  		=>'',
        ]);
        if(!empty($product))
        {
            return redirect(aurl('products/' . $product->id . '/edit'));
        }
    }

    public function delete_main_image($id) {
        $product = Product::find($id);
        Storage::delete($product->photo);
        $product->photo = null;
        $product->save();
        return response(['status' => true], 200);
    }

    public function update_product_image($id){
        $product = Product::where('id',$id)->update([
            'photo' => up()->Upload([
                'file'           => 'file',
                'path'           => 'products/' . $id,
                'upload_type'    => 'single',
                'delete_file'    => '',
            ])
        ]);
        return response(['status' => true],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
/*    public function store(Request $request)
    {
        $data = $this->validate(request(),
        [
            'country_name_ar'    => 'required',
            'country_name_en'   => 'required',
            'mob'=> 'required',
            'code'=> 'required',
            'logo'=> 'required|'.v_image(),
        ], [] ,[
            'country_name_ar'       => trans('admin.country_name_ar'),
            'country_name_en'       => trans('admin.country_name_en'),
            'mob'                   => trans('admin.mob'),
            'code'                  => trans('admin.code'),
            'logo'                  => trans('admin.logo'),
        ]);
        if (request()->hasFile('logo'))
		{
			$data['logo'] = up()->Upload([
				'file'           => 'logo',
				'path'           => 'products',
				'upload_type'    => 'single',
				'delete_file'    => '',
			]);
		}
        Product::create($data);
        session()->flash('success',trans('admin.record_added'));
        return redirect(aurl('products'));
    }*/

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
    public function edit($id)
    {
        $product  = Product::find($id);

        return view('admin.products.product',['title'=>trans('admin.create_or_edit_products',['title'=>$product->title]),'product'=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload_file($id){
        if(request()->hasFile('file')){
           $fid = up()->Upload([
            'file'           => 'file',
            'path'           => 'products/' . $id,
            'upload_type'    => 'files',
            'file_type'      => 'product',
            'relation_id'    => $id,
            ]);
            return response(['status' => true, 'id' => $fid],200);
        }
    }

    public function delete_file(){
        if(request()->has('id')){
          up()->delete(request('id'));
        }
    }


    public function update($id)
    {
        $data = $this->validate(request(),
        [
            'title_ar'          => 'required',
            'content_ar'        => 'required',
            'title_en'          => 'required',
            'content_en'        => 'required',
            'code'              => 'required|string',
            'department_id'     => 'required|numeric',
            'trade_id'          => 'required|numeric',
            'manu_id'           => 'required|numeric',
            'color_id'          => 'sometimes|nullable|numeric',
            'size_id'           => 'sometimes|nullable|numeric',
            'size'              => 'sometimes|nullable',
            'currency_id'       => 'sometimes|nullable|numeric',
            'price'             => 'required|numeric',
            'stock'             => 'required|numeric',
            'start_at'          => 'required|date',
            'end_at'            => 'required|date',
            'start_offer_at'    => 'sometimes|nullable|date',
            'end_offer_at'      => 'sometimes|nullable|date',
            'price_offer'       => 'sometimes|nullable|numeric',
            'weight'            => 'sometimes|nullable',
            'weight_id'         => 'sometimes|nullable|numeric',
            'status'            => 'sometimes|nullable|in:pending,refised,active',
            'reason'            => 'sometimes|nullable|numeric',
        ], [] ,[
            'title_ar'          => trans('admin.title_ar'),
            'content'           => trans('admin.content_ar'),
            'title'             => trans('admin.title_en'),
            'content'           => trans('admin.content_en'),
            'code'              => trans('admin.code'),
            'department_id'     => trans('admin.department_id'),
            'trade_id'          => trans('admin.trade_id'),
            'manu_id'           => trans('admin.manu_id'),
            'color_id'          => trans('admin.color_id'),
            'size_id'           => trans('admin.size_id'),
            'size'              => trans('admin.size'),
            'currency_id'       => trans('admin.currency_id'),
            'price'             => trans('admin.price'),
            'stock'             => trans('admin.stock'),
            'start_at'          => trans('admin.start_at'),
            'end_at'            => trans('admin.end_at'),
            'start_offer_at'    => trans('admin.start_offer_at'),
            'end_offer_at'      => trans('admin.end_offer_at'),
            'price_offer'       => trans('admin.price_offer'),
            'weight'            => trans('admin.weight'),
            'weight_id'         => trans('admin.weight_id'),
            'status'            => trans('admin.status'),
            'reason'            => trans('admin.reason'),
        ]);
        if(request()->has('mall'))
        {
            MallProducts::where('product_id',$id)->delete();
            foreach (request('mall') as $mall)
            {
                MallProducts::create([
                    'product_id' => $id,
                    'mall_id'    => $mall,
                ]);
            }
        }
        if(request()->has('related'))
        {
            RelatedProduct::where('product_id',$id)->delete();
            foreach (request('related') as $related)
            {
                RelatedProduct::create([
                    'product_id'         => $id,
                    'related_product'    => $related,
                ]);
            }
        }
        if(request()->has('input_value') && request()->has('input_key'))
        {
            $i = 0;
            $other_data = '';
            OtherData::where('product_id',$id)->delete();
            foreach(request('input_key') as $key){
                $data_value = !empty(request('input_value')[$i]) ? request('input_value')[$i]: '';
                OtherData::create([
                    'product_id'    => $id,
                    'data_key'      => $key,
                    'data_value'    => $data_value,
                ]);
             $i++;
            }
            $data['other_data'] = rtrim($other_data, '|');
        }
        Product::where('id',$id)->update($data);
        return response(['status'=>true,'message'=>trans('admin.updated_record')],200);
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function copy_product($id){
        if(request()->ajax()){
            $releation_data = Product::find($id);
            $copy = Product::find($id)->toArray();
            unset($copy['id']);
            $create = Product::create($copy);
            if(!empty($copy['photo'])){
                $ext    = \File::extension($copy['photo']);
                $new_path = 'products/'.$create->id.'/'.str_random(30).'.'.$ext;
                \Storage::copy($copy['photo'], $new_path);
                $create->photo = $new_path;
                $create->save();
            }
            // Mall Product //
                foreach ($releation_data->mall_product()->get() as $mall)
                {
                    MallProducts::create([
                        'product_id' => $create->id,
                        'mall_id'    => $mall->mall_id,
                    ]);
                }
            // Mall Product //
            // Other Data k=>v Product //
            foreach($releation_data->other_data()->get() as $other_data){
               OtherData::create([
                    'product_id'    => $create->id,
                    'data_key'      => $other_data->data_key,
                    'data_value'    => $other_data->data_value,
                ]);
            }
            // Other Data k=>v Product //
        }
                foreach ($releation_data->files()->get() as $file) {
                    $hashname = str_random(30);
                    $ext      = \File::extension($file->full_file);
                    $new_path = 'products/'.$create->id.'/'.$hashname.'.'.$ext;
                    \Storage::copy($file->full_file, $new_path);
                    $add = FileTbl::create([
                        'name'          => $file->name,
                        'size'          => $file->size,
                        'file'          => $hashname,
                        'path'          => 'products/'.$create->id,
                        'full_file'     => 'products/'.$create->id.$hashname,
                        'mime_type'     => $file->mime_type,
                        'file_type'     => 'product',
                        'relation_id'   => $create->id,
                    ]);
                }
            
            return response([
                'status' =>true,
                'message'=>trans('admin.product_created'),
                'id'     =>$create->id,
            ],200);
        
    }


    public function deleteProduct($id){
        $products = Product::find($id);
        Storage::delete($products->photo);
        up()->delete_files($id);
        $products->delete(); 
    }
    public function destroy($id)
    {
        $this->deleteProduct($id);
        session()->flash('success', trans('admin.delete_record'));
		return redirect(aurl('products'));
    }
    public function multi_delete()
    {
        if(is_array(request('item')))
        {
            foreach(request('item') as $id) {
                $this->deleteProduct($id);
            }
        } else 
        {
            $this->deleteProduct(request('item'));
        }
        session()->flash('success',trans('admin.delete_record'));
        return redirect(aurl('products'));
    }
    public function product_search(){
        if(request()->ajax()){
            if(!empty(request('search')) && request()->has('search')){
                $related_product = RelatedProduct::where('product_id',request('id'))->get(['related_product']);
                $products = Product::where('title','LIKE','%'.request('search').'%')
                ->where('id','!=',request('id'))
                ->whereNotIn('id',$related_product)
                ->limit(10)
                ->orderBy('id','desc')
                ->get();
                return response([
                    'status'        =>true,
                    'result'        =>count($products) > 0? $products:'',
                    'count'         =>count($products)         
                ],200);
            }
        }
    }
}
