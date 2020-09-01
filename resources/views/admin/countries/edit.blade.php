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
              {!! Form::open(['url'=>aurl('countries/'.$country->id),'method'=>'put','files'=>true]) !!}
              <div class="form-group">
                {!! Form::label('country_name_ar',trans('admin.country_name_ar')) !!}
                {!! Form::text('country_name_ar',$country->country_name_ar,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('country_name_en',trans('admin.country_name_en')) !!}
                {!! Form::text('country_name_en',$country->country_name_en,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('code',trans('admin.code')) !!}
                {!! Form::text('code',$country->code,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('mob',trans('admin.mob')) !!}
                {!! Form::text('mob',$country->mob,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('currency',trans('admin.currency')) !!}
                {!! Form::text('currency',$country->currency,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('logo',trans('admin.country_flag')) !!}
                {!! Form::file('logo',['class'=>'form-control']) !!}
                @if (!empty($country->logo))
                      <img src="{{ Storage::url($country->logo) }}" style="width: 100px;height:100px;" />
                  @endif
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