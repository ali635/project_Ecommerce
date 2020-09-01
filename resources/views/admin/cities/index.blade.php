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
              {!! Form::open(['id'=>'form_data','url'=>aurl('cities/destory/all')]) !!}  
              {!! Form::hidden('_method','delete') !!}
              {!! $dataTable->table(['class'=>'dataTable table table-striped table-hover table-bordered'],true)!!}
              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Trigger the modal with a button -->

<!-- Modal -->
<div id="mutlipleDelete" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger">
          <div class="empty_record hidden">
            <h4>{{ trans('admin.please_check_some_records') }} </h4>
          </div>
          <div class="not_empty_record hidden">
            <h1>{{ trans('admin.ask_delete_itme') }}  <span class="record_count"></span>  ?</h1>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="empty_record hidden">
          <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('admin.close') }}</button>
        </div>
        <div class="not_empty_record hidden">
          <input type="submit" name="del_all" value="{{ trans('admin.yes') }}" class="btn btn-danger del_all" />
        </div>
      </div>
    </div>

  </div>
</div>
  @push('js')
  <script>
    delete_all();
  </script>
  {!! $dataTable->scripts()!!}
  @endpush
</section>
@endsection