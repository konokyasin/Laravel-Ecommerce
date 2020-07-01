@extends('admin.layouts.master')
@section('title','View Coupons')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-gift"></i>
            </div>
            <div class="header-title">
                <h1>View Coupons</h1>
                <small>Coupons</small>
            </div>
        </section>
        <!-- Main content -->
        @include('other.message')
        <div id="message_success" style="display: none;" class="alert alert-sm alert-success">Status Enabled</div>
        <div id="message_error" style="display: none;" class="alert alert-sm alert-danger">Status Disabled</div>
        <section class="content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonexport">
                                <a href="#">
                                    <h4>View Coupons</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.add-coupon') }}"> <i class="fa fa-plus"></i> Add Coupon
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="info">
                                        <th>Coupon ID</th>
                                        <th>Coupon Code</th>
                                        <th>Amount</th>                           
                                        <th>Amount Type</th>
                                        <th>Expire Date</th>
                                        <th>Created Date</th>
                                        <th>Status</th>
                                        <th>Action</th>                                  
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($coupons as $coupon)
                                        <tr>
                                            <td>{{ $coupon->id }}</td>
                                            <td>{{ $coupon->coupon_code }}</td>
                                            <td>
                                                {{ $coupon->coupon_amount }}
                                                @if( $coupon->amount_type == "Percentage" )% @else$ @endif
                                            </td>
                                            <td>{{ $coupon->amount_type }}</td>
                                            <td>{{ $coupon->expire_date }}</td>
                                            <td>{{ $coupon->created_at }}</td>
                                            <td>
                                                <input type="checkbox" class="btn btn-success" id="CouponStatus" rel="{{ $coupon->id }}"
                                                data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                @if ($coupon['status']=="1") checked @endif>  
                                            </td>                                                                             
                                            <td>
                                                <a href="{{ route('admin.edit-coupon', $coupon->id) }}" class="btn btn-add btn-sm" data-toggle="tooltip" title="Edit Coupon!" ><i class="fa fa-pencil"></i></a>
                                                <a href="{{ route('admin.delete-coupon', $coupon->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Coupon!" ><i class="fa fa-trash-o"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


@endsection
