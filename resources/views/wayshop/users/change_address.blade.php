@extends('wayshop.layouts.master')
@section('content')

<div class="contact-box-main">

    <div class="container">
     @include('other.message')
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
             <div class="contact-form-right">
                 <h2>Change Address!</h2>
                 <form action="{{url('/store-address')}}" method="POST" id="contactForm registerForm">
                    @csrf
                     <div class="row">
                         
                         <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->name }}"  id="name" name="name" required placeholder="Please Enter Your Name">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->address }}"  id="address" name="address" required placeholder="Please Enter Your Address">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->city }}"  id="city" name="city" required placeholder="Please Enter Your City">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->state }}"  id="state" name="state" required placeholder="Please Enter Your State">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                               <select name="country" id="country" class="form-control">
                                   <option value="1">Select Country</option>   
                                   @foreach ($countries as $country )
                                       <option value="{{ $country->country_name }}" @if($country->country_name == $userDetails->country) selected @endif>{{ $country->country_name }}</option>
                                   @endforeach                       
                               </select>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->pincode }}"  id="pincode" name="pincode" required placeholder="Please Enter Your Pincode">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $userDetails->mobile }}"  id="mobile" name="mobile" required placeholder="Please Enter Your Mobile Number">
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Save</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                     </div>
                 </form>
             </div>

         </div>
         <div class="col-md-3"></div>
     </div>
    </div>

</div>

@endsection