@extends('backend.layout.master')

@section('title')
    Reservation
@endsection
@push('css')
    <link rel="stylesheet" href="{{url('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css')}}">
    <style>
        .content-wrapper{
            background:#fff !important;
        }
        .card{
            box-shadow: 1px 2px 4px rgba(0,0,0,0.3);
            padding:10px;
        }
        .dynamic_data__div__animateable{
            opacity:0;
        }
        .card-light-grey{
            background:#f5f5f5;
        }
        .wrapper__white{
            background:#fff;
            padding: 15px 0 15px 15px;
        }
    </style>
@endpush
@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title with-border">
                Check Availability
            </h3>
        </div>
        <div class="box-body" style="padding-bottom:20px;">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="col-sm-12">
                    <h4>Choose Date</h4>
                </div>
                <div class="col-sm-12">
                    <form  action="{{url('reserve')}}" method="GET">
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' name="_time" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <input id="_checktables" value="Check Availability"type="submit" class="btn btn-primary">
                    </form>
                </div>
                <div class="clearfix" style="margin:35px 0;"></div>
                <div class="col-sm-12 dynamic_data__div__animateable" id="_rtnTables">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{url('bower_components/moment/moment.js')}}"></script>
<script src="{{url('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
  $(document).ready(function(){  
    //date picker settings
    var today = new Date();
    $('#datetimepicker1').datetimepicker({
        format:'YYYY-MM-DD HH:mm:ss',
        disabledHours: [0,1,2,3,4,5,6,7,8,9,10,11,23],
        minDate: today,

    });
    //ajax request to get available tables for the specied time. 
    $('#_checktables').on('click',function(event){
        event.preventDefault();
        base_url = '{{url("/")}}'
        var _from = $('#datetimepicker1').data('date');
        console.log(_from);
        var adding_time = moment(_from).add(2,'H');
        console.log(adding_time);
        var _to = adding_time.format('YYYY-MM-DD HH:mm:ss');
        console.log(_to);
        $.ajax({
            method: 'GET',
            url: base_url + '/check',
            data: {_from,_to},
        })
        .done(function(msg){
            $('#_rtnTables').empty();
            $('#_rtnTables').append(msg['_form']);
            $('.dynamic_data__div__animateable').animate({opacity:1});
            var from = msg['from'];
            var to   = msg['to'];

            //appending tables to the select. 
            var data = (msg['array_tables']);
            var toAppend = '';
            $.each(data,function(data,o){
            toAppend += '<option value="' + o.id + '">'+o.tablenumber+'</option>';
            });
            $('#select').append(toAppend);
            $('#__from').val(from);
            $('#__to').val(to);
        }); 
    });

    //telephone input field validations

});
</script>
@endpush