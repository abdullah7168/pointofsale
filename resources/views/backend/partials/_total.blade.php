
@if(Cart::content()->count() > 0 ) 
    {{Cart::subtotal()}}
@endif
