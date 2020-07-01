@extends('admin.layouts.master')
@section('title','Add Coupon')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-gift"></i>
            </div>
            <div class="header-title">
                <h1>Add Coupon</h1>
                <small>Add Coupons</small>
            </div>
        </section>
        <!-- Main content -->
        @include('other.message')
        <section class="content">
            <div class="row">
                <!-- Form controls -->
                <div class="col-sm-12">
                    <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                            <div class="btn-group" id="buttonlist">
                                <a class="btn btn-add " href="{{ route('admin.view-coupons') }}">
                                    <i class="fa fa-eye"></i>  View Coupons </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" action="{{ route('admin.store-coupons') }}" method="post" name="add_coupon" id="add_coupon" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Coupon Code</label>
                                    <input type="text" class="form-control" placeholder="Enter Coupon Code" name="coupon_code" id="coupon_code" required>
                                </div>
                                <div class="form-group">
                                    <label>Amount</label>
                                    <input type="text" class="form-control" placeholder="Enter Amount" name="coupon_amount" id="coupon_amount" required>
                                </div>
                                <div class="form-group">
                                    <label>Amount Type</label>
                                    <select name="amount_type" id="amount_type" class="form-control">
                                        <option value="Percentage">Percentage</option>
                                        <option value="Fixed">Fixed</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Coupon Expire Date</label>
                                    <input  class="form-control" name="expire_date" id="datepicker" required>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-success" value="Add Coupon">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
