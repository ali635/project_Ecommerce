<h3 class="label
    {{ $level == 'user'?'label-info':'' }}
    {{ $level == 'vendor'?'label-primary':'' }}
    {{ $level == 'company'?'label-success':'' }}
    ">
    {{ trans('admin.'.$level) }}
</h3>
