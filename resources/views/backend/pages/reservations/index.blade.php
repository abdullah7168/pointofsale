@extends('backend.layout.master')

@push('css')
    <link rel="stylesheet" href="{{url('bower_components/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{url('bower_components/fullcalendar/dist/schedular.min.css')}}">
@endpush
@section('title')
   
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border"><h3 class="box-title">Reservation Calendar</h3><a href="{{url('/reserve')}}" class="btn btn-flat btn-primary pull-right">Book a Table</a></div>
         <div class="col-sm-12">
             @if(Session::has('message'))
               <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-check"></i>{{Session::get('message')}}</h4>
              </div>
            @endif
         </div>
        <div class="box-body">
           
            <div style="padding:10px margin-top:20px;">
                <div id="calendar"></div>
            </div>
        </div>
   </div>
@endsection
@push('scripts')
    <script src="{{url('bower_components/moment/moment.js')}}"></script>
    <script src="{{url('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
     <script src="{{url('bower_components/fullcalendar/dist/schedular.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            var base_url = '{{ url("/") }}';

            $('#calendar').fullCalendar({
                schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                timezone: 'locale',
                defaultView: 'agendaDay',
                weekends: true,
                aspectRatio: 1,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                minTime: '11:00:00',
                maxTime: '23:00:00',
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: { 
                url: base_url + '/api',
                error: function() {
                     console.log(this.url);
                   }
                },
                resources: {
                    url: base_url + '/tables/api',
                    error:function(){
                        console.log(this.url);
                    }
                },
               
                
                
               
                
            });
        });
    </script>
@endpush