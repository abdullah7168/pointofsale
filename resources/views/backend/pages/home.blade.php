@extends('backend.layout.master')

@push('css')
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <style>
        .__fav_list{
          list-style:none;
          font-size:14px;
          padding-left:0;
        }
        .__fav_list:first-child  i{
          color:gold;
        }
        .flex{
          display:column;
        }
        .flex--column{
          flex-direction:row;
        }
    </style>

@endpush
@section('content')

     <div class="row">
        <div class="col-md-12">
            <div class="row">
              @include('backend.partials.__order_chart')
              <div class="flex flex--column">
                 @include('backend.partials.__favs')
              </div>
            </div>
            <div class="row">
              @include('backend.partials.__orders_datatable')
              @include('backend.partials.__stocks')
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
  $(function() {
  // Create a function that will handle AJAX requests
  function requestData(days, chart){
    $.ajax({
      type: "GET",
      url: "{{url('charts/order/api')}}", // This is the URL to the API
      data: { days: days }
    })
    .done(function( data ) {
      // When the response to the AJAX request comes back render the chart with new data
      chart.setData(JSON.parse(data));
    })
    .fail(function() {
      // If there is no communication between the server, show an error
      alert( "error occured" );
    });
  }
  var chart = Morris.Bar({
    // ID of the element in which to draw the chart.
    element: 'stats-container',
    // Set initial data (ideally you would provide an array of default data)
    data: [0,0],
    xkey: 'date',
    ykeys: ['value'],
    labels: ['Orders']
  });
  // Request initial data for the past 7 days:
  requestData(7, chart);
  $('ul.ranges a').click(function(e){
    e.preventDefault();
    // Get the number of days from the data attribute
    var el = $(this);
    days = el.attr('data-range');
    // Request the data and render the chart using our handy function
    requestData(days, chart);
    // Make things pretty to show which button/tab the user clicked
    el.parent().addClass('active');
    el.parent().siblings().removeClass('active');
  })
});
</script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
<script>
  $(document).ready(function(){
     __baseurl = '{{url("/")}}';
     $('#orders--this-week').DataTable({
        //setup source
        ajax:{
              url: __baseurl + '/api/data/order',
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