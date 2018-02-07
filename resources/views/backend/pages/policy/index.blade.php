@extends('backend.layout.master')
@push('css')
    <style>
        .input--percentage{
            font-size:20px;
            height:40px;
        }
    </style>
@endpush
@section('content')

     <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
               <h3>Policy</h3>
            </div>
            <div class="box-body">
              <div class="col-sm-4 col-sm-offset-4">
                <form action="{{url('policy/update/'.$policy[0]->id)}}" method="POST">
                    <div class="form-group">
                        <label for="servicecharges">Service Charges</label>
                        <input type="text" value="{{$policy[0]->service_charges}}" min="0" class="form-control input--percentage" name="service_charges">
                    </div>
                    <div class="form-group">
                    {{csrf_field()}}
                        <label for="menuprice">Menu Price</label>
                        <input type="text" min="0" value="{{$policy[0]->menu_price}}" class="form-control input--percentage" name="menu_price">
                    </div>
                    <div class="pull-right">
                        <input type="submit" value="Update" class="btn btn-flat btn-primary">
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush