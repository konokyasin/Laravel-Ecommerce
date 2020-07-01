@extends('admin.layouts.master')
@section('title','Order Details')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-eye"></i>
            </div>
            <div class="header-title">
                <h1>Order {{ $orderDetails->id }}</h1>
                <small>Order Details</small>
            </div>
        </section>
        <!-- Main content -->
        @include('other.message')
        <section class="content">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Order Details</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="taskDesc">Order Date</td>
                                            <td class="taskStatus">{{ $orderDetails->created_at->format('Y-m-d') }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Order Status</td>
                                            <td class="taskStatus">{{ $orderDetails->order_status }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Order Total</td>
                                            <td class="taskStatus">{{ $orderDetails->grand_total }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Shipping Charges</td>
                                            <td class="taskStatus">{{ $orderDetails->shipping_charges }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Coupon Code</td>
                                            <td class="taskStatus">{{ $orderDetails->coupon_code }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Coupon Amount</td>
                                            <td class="taskStatus">{{ $orderDetails->coupon_amount }}</td>
                                        </tr>
                                        <tr>
                                            <td class="taskDesc">Payment Method</td>
                                            <td class="taskStatus">{{ $orderDetails->payment_method }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Billing Address</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="taskDesc">Name</td>
                                            <td class="taskStatus">{{ $orderDetails->name }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Address</td>
                                            <td class="taskStatus">{{ $orderDetails->address }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">City</td>
                                            <td class="taskStatus">{{ $orderDetails->city }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">State</td>
                                            <td class="taskStatus">{{ $orderDetails->state }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Country</td>
                                            <td class="taskStatus">{{ $orderDetails->country }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Pincode</td>
                                            <td class="taskStatus">{{ $orderDetails->pincode }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Mobile No.</td>
                                            <td class="taskStatus">{{ $orderDetails->mobile }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Customer Details</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="taskDesc">Customer Name</td>
                                            <td class="taskStatus">{{ $orderDetails->name }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Customer Email</td>
                                            <td class="taskStatus">{{ $orderDetails->user_email }}</td>
                                        </tr>                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Shipping Address Update</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="{{ url('/admin/update-order-status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $orderDetails->id }}">
                                <table style="width: 100%;"> 
                                    <tr>
                                        <td>
                                            <select name="order_status" id="order_status" class="form-control">
                                                <option value="New" @if($orderDetails->order_status == "New") selected @endif>                                                   
                                                New</option>
                                                <option value="Pending" @if($orderDetails->order_status == "Pending") selected @endif>                                                   
                                                Pending</option>
                                                <option value="In Process" @if($orderDetails->order_status == "In Process") selected @endif>                                                   
                                                In Process</option>
                                                <option value="Shipped" @if($orderDetails->order_status == "Shipped") selected @endif>                                                   
                                                Shipped</option>
                                                <option value="Delivered" @if($orderDetails->order_status == "Delivered") selected @endif>                                                   
                                                Delivered</option>
                                                <option value="Cancelled" @if($orderDetails->order_status == "Cancelled") selected @endif>                                                   
                                                Cancelled</option>
                                                <option value="Paid" @if($orderDetails->order_status == "Paid") selected @endif>                                                   
                                                Paid</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit" class="btn btn-sm btn-success">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Shipping Address</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td class="taskDesc">Name</td>
                                            <td class="taskStatus">{{ $orderDetails->name }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Address</td>
                                            <td class="taskStatus">{{ $orderDetails->address }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">City</td>
                                            <td class="taskStatus">{{ $orderDetails->city }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">State</td>
                                            <td class="taskStatus">{{ $orderDetails->state }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Country</td>
                                            <td class="taskStatus">{{ $orderDetails->country }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Pincode</td>
                                            <td class="taskStatus">{{ $orderDetails->pincode }}</td>
                                        </tr>
                                         <tr>
                                            <td class="taskDesc">Mobile No.</td>
                                            <td class="taskStatus">{{ $orderDetails->mobile }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                        <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>Ordered Product</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Name</th>
                                            <th>Product Size</th>
                                            <th>Product Color</th>
                                            <th>Product Price</th>
                                            <th>Product Quantity</th>
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
                                            </tr>
                                        @endforeach                                   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
