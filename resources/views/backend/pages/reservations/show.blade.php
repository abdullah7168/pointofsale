@extends('backend.layout.master')

@section('title')
    Booking
@endsection
@push('css')
    <style>
        .lead--smaller{
            font-size:16px;
        }
    </style>
@endpush
@section('content')

    <div class="col-sm-4 col-sm-offset-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title "><small>booking by</small><p class="lead"><strong>{{$booking->title}}</strong></p></h3>
                <div class="pull-right">
                    <a href="{{URL::previous()}}">Back</a>
                </div>
            </div>
            <div class="box-body">
                <p><i class="fa fa-clock-o" aria-hidden="true"></i> Time:  {{$booking->start_time}}</p>
                <p><i class="fa fa-bookmark" aria-hidden="true"></i> Table Number is <strong>{{$tablenumber->tablenumber}}</strong></p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> {{$booking->email}}</p>
                <p><i class="fa fa-phone" aria-hidden="true"></i> {{$booking->phone}}</p>
                @if($booking->comment)
                    <p class="lead"><strong>Additional Comments:</strong></p>
                    <p class="lead lead--smaller">{{$booking->comment}}</p>
                @else
                    <p class="lead"><i>no additional comments.</i></p>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('scripts')

@endpush