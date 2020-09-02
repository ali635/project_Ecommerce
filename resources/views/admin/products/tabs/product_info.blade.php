<div id="product_info" class="tab-pane fade in active">
    <h3>{{ trans('admin.product_info')  }}</h3>
    <div class="form-group ">
      {!! Form::label('title_ar',trans('admin.product_title_ar')) !!}
      {!! Form::text('title_ar',$product->title_ar,['class'=>'form-control','placeholder'=>trans('admin.product_title_ar')]) !!}
   </div>
   <div class="form-group ">
    {!! Form::label('title_en',trans('admin.product_title_en')) !!}
    {!! Form::text('title_en',$product->title_en,['class'=>'form-control','placeholder'=>trans('admin.product_title_en')]) !!}
 </div>
   <div class="form-group ">
    {!! Form::label('content_ar',trans('admin.product_content_ar')) !!}
    {!! Form::textarea('content_ar',$product->content_ar,['class'=>'form-control','placeholder'=>trans('admin.product_content_ar')]) !!}
   </div>
 <div class="form-group ">
  {!! Form::label('content_en',trans('admin.product_content_en')) !!}
  {!! Form::textarea('content_en',$product->content_en,['class'=>'form-control','placeholder'=>trans('admin.product_content_en')]) !!}
 </div>
 <div class="form-group ">
  {!! Form::label('code',trans('admin.product_code')) !!}
  {!! Form::text('code',$product->code,['class'=>'form-control','placeholder'=>trans('admin.product_code')]) !!}
 </div>
  
  </div>