@extends('backend.layout.master')

@push('css')
    
@endpush
@section('title')
   
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Revenue Reports</h3></div>
        <div class="box-body">
            @if($_total_revenue)
                {{$_total_revenue}}
            @endif
        </div>
   </div>
@endsection
@push('scripts')
    
@endpush