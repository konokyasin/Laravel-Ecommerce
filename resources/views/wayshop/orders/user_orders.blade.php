@extends('wayshop.layouts.master')
@section('content')

    <div class="cart-box-main">
        <div class="container">
            <h1 class="text-center text-danger text-bold">User Orders</h1>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped table-bordered table-hover w-100 mt-2">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Ordered Product</th>
                                <th>Payment Method</th>
                                <th>Grand Total</th>
                                <th>Order Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>                                    
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @foreach($order->orders as $pro)
                                            <a href="{{ url('/orders/'.$order->id) }}" class="text-primary">
                                                {{ $pro->product_code }}
                                                ({{ $pro->product_qty }})
                                            </a><br>
                                        @endforeach
                                    </td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->grand_total }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection