@if(Cart::content()->count() > 0 )
    @foreach(Cart::content() as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->price * $item->qty}}</td>
            <td>
                <form action="{{url('/cart/delete/'. $item->rowId)}}" method="POST">
                    {{csrf_field()}}
                    <button type="submit" class="close pull-right">×</button>
                </form>
            </td>
        </tr>
    @endforeach
@else
    
@endif