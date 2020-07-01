@extends('admin.layouts.master')
@section('title','Edit Coupon')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
       <div class="header-icon">
          <i class="fa fa-product-hunt"></i>
       </div>
       <div class="header-title">
          <h1>Edit Coupon</h1>
          <small>Edit Coupons</small>
       </div>
    </section>
@include('other.message')
    <!-- Main content -->
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
                <form class="col-sm-6" enctype="multipart/form-data" action="{{ route('admin.update-coupon',$couponDetails->id) }}" method="post" name="edit_coupon" id="edit_coupon">
                    @csrf 
                     
                      <div class="form-group">
                         <label>Coupon Code</label>
                         <input type="text" class="form-control" value="{{$couponDetails->coupon_code}}" name="coupon_code" id="coupon_code" required>
                      </div>
                      <div class="form-group">
                         <label>Amount</label>
                         <input type="text" class="form-control" value="{{$couponDetails->coupon_amount}}" name="coupon_amount" id="coupon_amount" required>
                      </div>
                      <div class="form-group">
                        <label>Amount Type</label>
                        <select name="amount_type" id="amount_type" class="form-control">
                        <option  @if($couponDetails->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
                        <option  @if($couponDetails->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                        </select>

                     </div>
                      <div class="form-group">
                         <label>Expiry Date</label>
                         <input type="text" value="{{$couponDetails->expire_date}}" class="form-control" name="expire_date" id="datepicker" required>
                      </div>
                      
                      <div>
                         <input type="submit" class="btn btn-success" value="Update Coupon">
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