<?php
use Unicodeveloper\Paystack\Facades\Paystack;
?>


<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
    <div class="row" style="margin-bottom:40px;">
        <div class="col-md-8 col-md-offset-2">
            <div>
                Lagos Eyo Print Tee Shirt
                ₦ 2,950
            </div>
            {{-- @foreach ($collection as $key => $item)
                <input type="hidden" name="$key" value>
            @endforeach --}}
            <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
            <input type="hidden" name="orderID" value="345">
            <input type="hidden" name="amount" value="8"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="3">
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}"> For other necessary things you want to add to your payload. it is optional though --}}

            <p>
                <button class="btn btn-success btn-lg btn-block" id="paymentBtn" type="submit" value="Pay Now!">
                    <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                </button>
            </p>
        </div>
    </div>
</form>
