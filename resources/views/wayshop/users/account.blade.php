@extends('wayshop.layouts.master')
@section('content')


 <!-- Start My Account  -->
    <div class="my-account-box-main">
        <div class="container">
            <div class="my-account-page">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-icon">
                                    <a href="{{ url('/change-password') }}"><i class="fa fa-lock"></i> </a>
                                </div>
                                <div class="service-desc">
                                    <h4>Change Password</h4>
                                    <p>Change Password</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-icon">
                                    <a href="{{ url('/change-address') }}"> <i class="fa fa-location-arrow"></i> </a>
                                </div>
                                <div class="service-desc">
                                    <h4>Change Address</h4>
                                    <p>Edit addresses for orders and gifts</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="account-box">
                            <div class="service-box">
                                <div class="service-icon">
                                    <a href="{{ url('/orders') }}"> <i class="fa fa-gift"></i> </a>
                                </div>
                                <div class="service-desc">
                                    <h4>Your Orders</h4>
                                    <p>Track & view your orders</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bottom-box">
                    <div class="row">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End My Account -->


@endsection