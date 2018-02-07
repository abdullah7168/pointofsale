@extends('backend.layout.master')

@push('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
@endpush
@section('content')
    <div class="row">
        <div class="col-sm-12">
           <div class="row">
                 @include('backend.partials.__total_sales')
                 <div class="col-sm-4">
                    @include('backend.partials.__revenue')
                    @if($profit)
                        @include('backend.partials.__profit')
                    @else
                        @include('backend.partials.__loss')
                    @endif
                    @include('backend.partials.__salecount')
                 </div>
           </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
<script>
  $(document).ready(function(){
     __baseurl = '{{url("/")}}';
     $('#totalsales--table').DataTable({
        //setup source
        ajax:{
              url: __baseurl + '/totalsales',
              dataSrc: ''
        },
        columns : [
              { data : 'id'},
              { data : 'totalbill'},
              { data : 'created_at'}
        ],
        "language": {
          "emptyTable": "No orders for today"
        }

     });
  });
</script>
@endpush