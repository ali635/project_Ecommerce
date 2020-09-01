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
              {!! Form::open(['url'=>aurl('cities')]) !!}
                  <div class="form-group">
                    {!! Form::label('city_name_ar',trans('admin.city_name_ar')) !!}
                    {!! Form::text('city_name_ar',old('city_name_ar'),['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('city_name_en',trans('admin.city_name_en')) !!}
                    {!! Form::text('city_name_en',old('city_name_en'),['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('country_id',trans('admin.country_id')) !!}
                    {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.session('lang'),'id'),old('country_id'),['class'=>'form-control']) !!}
                  </div>
              
                  {!! Form::submit(trans('admin.add2'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection