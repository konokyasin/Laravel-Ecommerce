@extends('wayshop.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="align-content-center">
                    <div class="card">
                        <div class="card-header bg-danger">
                            <h3 class="text-white">Order Confirmation</h3>
                            <h5 class="text-white">Thanks for Purchasing!</h5>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                            <p>YOUR COD ORDER HAS BEEN PLACED!!</p>
                            <footer class="blockquote-footer">Your Order number is {{ Session::get('order_id') }} and Your payable amount is $ {{ Session::get('grand_total') }} </footer>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-5">

    </div>
@endsection

@php
   Session::forget('order_id');
   Session::forget('grand_total'); 
@endphp