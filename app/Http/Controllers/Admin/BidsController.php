<?php

namespace App\Http\Controllers\Admin;

use App\Model\Auction;
use App\Model\Bid;
use Illuminate\Http\Request;
use App\DataTables\BidsDatatable;
use Stripe\Charge;
use App\Http\Controllers\Controller;

class BidsController extends Controller
{
    

    public function index(BidsDatatable $bid)
    {
        return $bid->render('admin.bids.index',['title'=>'admin.bids']);
    }

    public function store(Request $request)
    {
        $data = $this->validate(request(),
			[
				'auction_id'       => 'required',
				'fee'              => 'required',
                'paid'             => 'required|numeric',
                'won'              => 'sometimes|nullable|numeric',
                'user_id'          => 'required|numeric',
                
               
			], [], [
				'auction_id'        => trans('admin.auction_id'),
				'fee'               => trans('admin.fee'),
                'paid'              => trans('admin.paid'),
                'won'               => trans('admin.won'),
                'user_id'           => trans('admin.user_id1'),
               
                
			]);

        Bid::create($data);
		session()->flash('success', trans('admin.record_added'));
		return redirect(aurl('bids'));
    }


    public function place(Request $request, $id) {
        $auction = Auction::findOrFail($id);

        $request->validate([
            'price' => 'required|integer|min:'.$auction->price
        ]);

        // charge 10 percent
        $fee = (int) ($request->input('price') * 0.1);

        try {
            Charge::create(array(
                "amount" => $fee * 100,
                "currency" => "usd",
                "customer" => $request->user()->stripe_id
            ));
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->withError('We were unable to charge your card, please try again later.');
        }

        Bid::create([
            'user_id' => $request->user()->id,
            'auction_id' => $auction->id,
            'fee' => $request->input('price'),
            'paid' => $fee
        ]);

        return back()->with('success', 'Bid placed successfully and your card has been charged '. format_price($fee));
    }
    public function destroy($id)
    {
        $bids = Bid::find($id);
        $bids->delete();
        session()->flash('success', trans('admin.delete_record'));
		return redirect(aurl('bids'));
    }
    public function multi_delete()
    {
        if(is_array(request('item')))
        {
            foreach(request('item') as $id) {
                $bids = Bid::find($id);
                $bids->delete();
            }
        } else 
        {
            $bids = Bid::find(request('item'));
            
            $bids->delete();
        }
        session()->flash('success',trans('admin.delete_record'));
        return redirect(aurl('bids'));
    }
}