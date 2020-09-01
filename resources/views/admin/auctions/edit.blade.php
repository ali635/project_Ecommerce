@extends('admin.index')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
         <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
         </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
              {!! Form::open(['url'=>aurl('auctions/'.$auction->id),'method'=>'put']) !!}
              <div class="form-group">
                {!! Form::label('name_ar',trans('admin.name_ar')) !!}
                {!! Form::text('name_ar',$auction->name_ar,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('name_en',trans('admin.name_en')) !!}
                {!! Form::text('name_en',$auction->name_en,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('price',trans('admin.price_auct')) !!}
                {!! Form::text('price',$auction->price,['class'=>'form-control']) !!}
              </div>
              <div class="form-group ">
                  {!! Form::label('description',trans('admin.description')) !!}
                  {!! Form::textarea('description',$auction->description,['class'=>'form-control','placeholder'=>trans('admin.description')]) !!}
              </div>
              <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
                  {!! Form::label('start_auction_at',trans('admin.start_auction_at')) !!}
                  {!! Form::text('start_auction_at',$auction->start_auction_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.start_auction_at'),'autocomplete'=>'off']) !!}
              </div>
              <div class="form-group col-md-4 col-lg-4 col-sm-4 col-xs-12">
                  {!! Form::label('end_auction_at',trans('admin.end_auction_at')) !!}
                  {!! Form::text('end_auction_at',$auction->end_auction_at,['class'=>'form-control datepicker','placeholder'=>trans('admin.end_auction_at'),'autocomplete'=>'off']) !!}
              </div>
              <div class="clearfix"></div>
              <div class="form-group">
                {!! Form::label('user_id',trans('admin.user_id')) !!}
                {!! Form::select('user_id',App\User::pluck('name','id'),$auction->user_id,['class'=>'form-control']) !!}
              </div>
              
              <div class="form-group">
                {!! Form::label('product_id',trans('admin.product_id')) !!}
                {!! Form::select('product_id',App\Model\Product::pluck('title','id'),$auction->product_id,['class'=>'form-control']) !!}
              </div>
              
                  {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection