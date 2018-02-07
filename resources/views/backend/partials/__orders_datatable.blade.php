<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Orders of Today
            </h3>
            <div class="pull-right">
                <a href="{{url('/orders')}}" class="btn btn-primary btn-flat">View All Orders</a>
            </div>
        </div>
        <div class="box-body">
            <table id="orders--this-week">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Bill</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                
            </table>
        </div>
    </div>
</div>