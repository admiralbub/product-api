<div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column gap-3">
    <form method="post">
        @foreach($payment_providers as $payment_provider)
            @csrf
            @if($payment_provider->type=="field")
                <div class="position-relative">
                    <label class="form-label">{{$payment_provider->name}}</label>

                    <input class="form-control"  name="payment_provider[{{$payment_provider->key}}]" value="{{$payment_provider->value}}">

                </div>
            @endif
           
            
        @endforeach
    </form>
</div>
