@extends('wayshop.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">

        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Billing Address</h2>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->name}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->address}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->city}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->state}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->country}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{$userDetails->pincode}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                  {{$userDetails->mobile}}
                                </div>
                            </div>
                            
                            
                        </div>
                   
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2>Shipping Details</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->name}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->address}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->city}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->state}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->country}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->pincode}}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{$shippingDetails->mobile}}
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        
        </div>

    </div>

</div>

 <!-- Start Cart  -->
    <h1 class="text-center text-bold text-danger">Order Summary</h1>
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $total_amount = 0; ?>
                            @foreach($userCart as $cart)
                            <tr>
                                <td class="thumbnail-img">
                                    <a href="#">
                                <img class="img-fluid" src="{{asset('/uploads/product/'.$cart->image)}}" alt="" />
                            </a>
                                </td>
                                <td class="name-pr">
                                        
									{{$cart->product_name}}
                                    <p>{{$cart->product_code}} | {{$cart->size}}</p>
                                    </td>
                                    <td class="price-pr">
                                        <p>$ {{$cart->price}}</p>
                                    </td>
                                <td class="quantity-box">
                                    {{$cart->quantity}}
                                </td>
                                <td class="total-pr">
                                    <p>$ {{$cart->price*$cart->quantity}}</p>
                                    </td>
                                
                            </tr>
                            <?php $total_amount = $total_amount + ($cart->price*$cart->quantity); ?>
                           @endforeach                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="order-box">
                        <h3>Your Total</h3>
                        <div class="d-flex">
                            <h4>Cart Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> $ {{$total_amount}} </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost (+)</h4>
                            <div class="ml-auto font-weight-bold"> $ 0 </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount (-)</h4>
                            <div class="ml-auto font-weight-bold"> 
                                @if(!empty(Session::get('couponAmount')))
                                    $ {{Session::get('couponAmount')}}
                                    @else
                                    $ 0
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> $ {{$grand_total = $total_amount - Session::get('couponAmount')}} </div>
                        </div>
                        <hr></div>
                </div>
            </div>

           <form name="paymentForm" id="paymentForm" action="{{ url('/place-order') }}" method="post"> 
            @csrf
           <input type="hidden" value="{{ $grand_total }}" name="grand_total">
            <hr class="mb-4">
            <div class="title-left">
                <h3>Payments</h3>
            </div>
            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="payment_method" value="cod"  type="radio" class="custom-control-input cod">
                    <label class="custom-control-label" for="credit">Cash On Delivery</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="payment_method" value="stripe" type="radio" class="custom-control-input stripe" >
                    <label class="custom-control-label" for="debit">Stripe Payment</label>
                </div>
                <div class="col-12 d-flex shopping-box">
                    <button  type="submit" class="ml-auto btn hvr-hover" onclick="return selectPaymentMethod();" style="color:white;">Place Order</button> 
                </div>
            </div>
        </form>

        </div>
    </div>
    <!-- End Cart -->

@endsection