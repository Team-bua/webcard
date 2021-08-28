@extends('layout_index.master')
@section('content')

@if(isset($subject))
<p style="color:red">
    {{$subject->type_subject}}
</p>
<p style="color:red">
    {{$subject->subject}}
</p>
@endif

@endsection
@section('script')
@stop
