@extends('wayshop.layouts.master')
@section('content')

    <div class="cart-box-main">
        <div class="container">
            <h1 class="text-center text-danger text-bold">User Order Details</h1>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered table-hover table-dark w-100 mt-2">
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Price</th>
                                <th>Product Quantity</th>
                                <th>Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orderDetails->orders as $pro)
                                <tr>
                                    <td>{{ $pro->product_code }}</td>   
                                    <td>{{ $pro->product_name }}</td>
                                    <td>{{ $pro->product_size }}</td>
                                    <td>{{ $pro->product_color }}</td>
                                    <td>{{ $pro->product_price }}</td>
                                    <td>{{ $pro->product_qty }}</td>   
                                    <td>{{ $orderDetails->order_status }}</td>                                                                 
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection