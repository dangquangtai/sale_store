@extends('layout')
@section('content')
<section class="checkout_area section-padding40">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h3>Điền thông tin để hoàn thành thủ tục đặt hàng</h3>
                <form class="row contact_form" action="{{ URL::to('info-shipping') }}" method="post" name="validate_form">
                    @csrf
                    <div class="col-md-12 form-group p_star">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Your full name" data-required>

                    </div>

                    <!-- <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="company" name="company" placeholder="Company name" />
                                </div> -->
                    <div class="col-md-6 form-group p_star">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone number">

                    </div>
                    <div class="col-md-6 form-group p_star">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">

                    </div>
                    <div class="col-md-12 form-group p_star">
                        <select class="country_select choose" id="city">
                            <option value="" >Chọn tỉnh/thành phố</option>
                            @foreach($list_tinh as $key=>$item)
                            <option value="{{$item->matp}}">{{ $item->name_city }}</option>

                            @endforeach
                            <!-- <option value="4">Country</option> -->
                        </select>

                    </div>
                    <div class="col-md-12 form-group p_star">
                        <input type="text" class="form-control" id="addr" name="addr" placeholder="Detail address" />

                    </div>
                    <!-- <div class="col-md-12 form-group p_star">
                                    <input type="text" class="form-control" id="add2" name="add2" />
                                    <span class="placeholder" data-placeholder="Address line 02"></span>
                                </div> -->
                    <!-- <div class="col-md-12 form-group p_star">
                        <input type="text" class="form-control" id="city" name="city" placeholder="Town/City"/>
                     
                    </div> -->
                    <div class="col-md-12 form-group p_star">
                        <select class="district_select">
                            <option value="1">District</option>
                            <!-- <option value="2">District</option>
                                        <option value="4">District</option> -->
                        </select>
                    </div>
                    <!-- <div class="col-md-12 form-group">
                                    <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP" />
                                   
                                </div> -->
                    <div class="col-md-12 form-group">
                        <textarea class="form-control" name="message" id="message" rows="1" placeholder="Order Notes"></textarea>

                    </div>


                    <div class="col-md-12 form-group">
                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <!-- <h3>Shipping Details</h3>
                                        <div class="checkout-cap">
                                            <input type="checkbox" id="f-option3" name="selector" />
                                            <label for="f-option3">Ship to a different address?</label>
                                        </div> -->

                            </div>

                        </div>
                        <div class="col-md-12 form-group d-flex flex-wrap">
                            <a href="{{URL::to('/show-cart')}}" class="btn" style="margin-right: 10px;"> Trở về giỏ hàng</a>
                            <button id="order" type="submit" class="btn">Đặt hàng</button>
                            <!-- <div class="checkout-cap ml-5">
                                <input type="checkbox" id="fruit01" name="keep-log">
                                <label for="fruit01">Create an account?</label>
                            </div> -->
                        </div>
                    </div>

                </form>
            </div>
            <!-- <div class="col-lg-4">
                            <div class="order_box">
                                <h2>Your Order</h2>
                                <ul class="list">
                                    <li>
                                        <a href="#">Product<span>Total</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Fresh Blackberry
                                            <span class="middle">x 02</span>
                                            <span class="last">$720.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Fresh Tomatoes
                                            <span class="middle">x 02</span>
                                            <span class="last">$720.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Fresh Brocoli
                                            <span class="middle">x 02</span>
                                            <span class="last">$720.00</span>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="list list_2">
                                    <li>
                                        <a href="#">Subtotal <span>$2160.00</span></a>
                                    </li>
                                    <li>
                                        <a href="#">Shipping
                                            <span>Flat rate: $50.00</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">Total<span>$2210.00</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="payment_item">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option5" name="selector" />
                                        <label for="f-option5">Check payments</label>
                                        <div class="check"></div>
                                    </div>
                                    <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                                </div>
                                <div class="payment_item active">
                                    <div class="radion_btn">
                                        <input type="radio" id="f-option6" name="selector" />
                                        <label for="f-option6">Paypal </label>
                                        <img src="assets/img/gallery/card.jpg" alt="" />
                                        <div class="check"></div>
                                    </div>
                                    <p> Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                                </div>
                                <div class="creat_account checkout-cap">
                                    <input type="checkbox" id="f-option8" name="selector" />
                                    <label for="f-option8">I’ve read and accept the  <a href="#">terms & conditions*</a> </label>
                                </div>
                                <a class="btn w-100" href="#">Proceed to Paypal</a>
                                
                            </div>
                            
                        </div> -->
        </div>


    </div>
</section>
@push('ajax-place')
<script>
   
    $(document).on('change', '.choose', function() {
        var object = $(this).attr('id');
var action = $(this).val();
var _token = $("input[name='_token']").val();
var result = '';
if (action == 'city') {
result = 'provice';
} else {
result = 'wards';
}
$.ajax({
type: "POST",
cache: false,
url: "{{url('/display-history')}}",
data: {
object: object,
id: id,
_token: _token
},
dataType: "html",
success: function(data) {
// $('.contain').html(data);

}
});
return false;
});
</script>

@endpush
@endsection
