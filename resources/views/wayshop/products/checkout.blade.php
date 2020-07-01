@extends('wayshop.layouts.master')
@section('content')

 <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
    @include('other.message')
    <form name="checkoutFrom" id="checkoutFrom" class="mt-5" action="{{url('/checkout-store')}}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2 class="text-bold text-danger">BILL TO:</h2>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  @if(!empty($userDetails->name)) value="{{$userDetails->name}}" @endif name="billing_name" id="billing_name" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  @if(!empty($userDetails->address)) value="{{$userDetails->address}}" @endif    name="billing_address" id="billing_address" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control"  @if(!empty($userDetails->city)) value="{{$userDetails->city}}" @endif   name="billing_city" id="billing_city" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" @if(!empty($userDetails->state)) value="{{$userDetails->state}}" @endif   name="billing_state" id="billing_state" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="billing_country" id="billing_country" class="form-control">
                                        <option value="1">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country->country_name}}"  @if(!empty($userDetails->country) && $country->country_name == $userDetails->country) selected @endif>{{$country->country_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" @if(!empty($userDetails->pincode)) value="{{$userDetails->pincode}}" @endif    name="billing_pincode" id="billing_pincode" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" @if(!empty($userDetails->mobile)) value="{{$userDetails->mobile}}" @endif   name="billing_mobile" id="billing_mobile" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                             <div class="col-md-12">
                                <div class="form-group" style="margin-left:30px;">
                                    <input  type="checkbox" class="form-check-input" id="billtoship">
                                    <label class="form-check-label" for="billtoship">Shipping Address Same As Billing Address</label>
                                </div>
                            </div> 
                        </div>
                   
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="contact-form-right">
                    <h2 class="text-bold text-danger">SHIP TO:</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->name)) value="{{$shippingDetails->name}}" @endif placeholder="Enter Shipping Name"  name="shipping_name" id="shipping_name" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->address)) value="{{$shippingDetails->address}}" @endif placeholder="Enter Shipping Address"  name="shipping_address" id="shipping_address" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->city)) value="{{$shippingDetails->city}}" @endif placeholder="Enter Shipping City"  name="shipping_city" id="shipping_city" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->state)) value="{{$shippingDetails->state}}" @endif placeholder="Enter Shipping State"  name="shipping_state" id="shipping_state" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="shipping_country" id="shipping_country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->country_name}}"@if(!empty($shippingDetails->country) && $country->country_name == $shippingDetails->country) selected @endif>
                                        {{$country->country_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->pincode)) value="{{$shippingDetails->pincode}}" @endif placeholder="Enter Shipping Pincode"  name="shipping_pincode" id="shipping_pincode" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" @if(!empty($shippingDetails->mobile)) value="{{$shippingDetails->mobile}}" @endif placeholder="Enter Shipping Mobile No." name="shipping_mobile" id="shipping_mobile" required data-error="Please enter your name">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" type="submit">Checkout</button>
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        
        </div>
        </form>
    </div>

</div>

@endsection