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
              {!! Form::open(['url'=>aurl('users/'.$user->id),'method'=>'put']) !!}
                  <div class="form-group">
                    {!! Form::label('name',trans('admin.name')) !!}
                    {!! Form::text('name',$user->name,['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('email',trans('admin.email')) !!}
                    {!! Form::email('email',$user->email,['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('password',trans('admin.password')) !!}
                    {!! Form::password('password',['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('mobile',trans('admin.mobile')) !!}
                    {!! Form::tel('mobile',$user->mobile,['class'=>'form-control']) !!}
                  </div>
                  <div class="form-group">
                    {!! Form::label('address',trans('admin.address')) !!}
                    {!! Form::text('address',$user->address,['class'=>'form-control']) !!}
                  </div>
               <div class="clearfix"></div>
                  <div class="form-group">
                    {!! Form::label('level',trans('admin.level')) !!}
                    {!! Form::select('level',['user'=>trans('admin.usera'),'vendor'=>trans('admin.vendor'),'company'=>trans('admin.company'),
                    ],$user->level,['class'=>'form-control','placeholder'=>'........']) !!}
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