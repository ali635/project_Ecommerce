<?php

namespace App\Http\Controllers\Admin;

use App\Model\Auction;
use Illuminate\Http\Request;
use App\DataTables\AuctionsDatatable;
use App\Http\Controllers\Controller;

class AuctionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AuctionsDatatable $auction)
    {
        return $auction->render('admin.auctions.index',['title'=>'admin.auctions']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auctions.create',['title'=>trans('admin.create_auctions')]);
    }

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
				'name_ar'          => 'required',
				'name_en'          => 'required',
                'price'            => 'required|numeric',
                'hights_price'     => 'sometimes|nullable|numeric',
                'description_ar'   => 'required|string',
                'description_en'   => 'required|string',
                'start_auction_at' => 'sometimes|nullable|date',
                'end_auction_at'   => 'sometimes|nullable|date',
                'user_id'          => 'required|numeric',
                'product_id'       => 'required|numeric',
                'status'           => 'sometimes|nullable|in:pending,refised,active',
                'reason'           => 'sometimes|nullable|numeric',
               
			], [], [
				'name_ar'           => trans('admin.name_ar'),
				'name_en'           => trans('admin.name_en'),
                'hights_price'      => trans('admin.hights_price'),
                'description_ar'    => trans('admin.description_ar'),
                'description_en'    => trans('admin.description_en'),
                'start_auction_at'  => trans('admin.start_auction_at'),
                'end_auction_at'    => trans('admin.end_auction_at'),
                'user_id'           => trans('admin.user_id'),
                'product_id'        => trans('admin.product_id'),
                'status'            => trans('admin.status'),
                'reason'            => trans('admin.reason'),

                
			]);

        Auction::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('auctions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auction = Auction::findOrFail($id);

        return view('auctions.show', [
            'auction' => $auction,
            'bid' => $auction->bids()->where('user_id', \Auth::id())->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auction = Auction::find($id);
		$title    = trans('admin.edit');
		return view('admin.auctions.edit', compact('auction', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
        [
            'name_ar'          => 'required',
            'name_en'          => 'required',
            'price'            => 'required|numeric',
            'hights_price'     => 'sometimes|nullable|numeric',
            'description'      => 'required|string',
            'start_auction_at' => 'sometimes|nullable|date',
            'end_auction_at'   => 'sometimes|nullable|date',
            'user_id'          => 'required|numeric',
            'product_id'       => 'required|numeric',
            'status'           => 'sometimes|nullable|in:pending,refised,active',
            'reason'           => 'sometimes|nullable|numeric',
           
        ], [], [
            'name_ar'           => trans('admin.name_ar'),
            'name_en'           => trans('admin.name_en'),
            'hights_price'      => trans('admin.hights_price'),
            'description'       => trans('admin.description'),
            'start_auction_at'  => trans('admin.start_auction_at'),
            'end_auction_at'    => trans('admin.end_auction_at'),
            'user_id'           => trans('admin.user_id'),
            'product_id'        => trans('admin.product_id'),
            'status'            => trans('admin.status'),
            'reason'            => trans('admin.reason'),

            
        ]);

        Auction::where('id',$id)->update($data);
        session()->flash('success',trans('admin.updated_record'));
        return redirect(aurl('auctions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $auctions = Auction::find($id);
        $auctions->delete();
        session()->flash('success', trans('admin.delete_record'));
		return redirect(aurl('auctions'));
    }
    public function multi_delete()
    {
        if(is_array(request('item')))
        {
            foreach(request('item') as $id) {
                $auctions = Auction::find($id);
                $auctions->delete();
            }
        } else 
        {
            $auctions = Auction::find(request('item'));
            
            $auctions->delete();
        }
        session()->flash('success',trans('admin.delete_record'));
        return redirect(aurl('auctions'));
    }
}