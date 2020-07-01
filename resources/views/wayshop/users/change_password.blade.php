
 @extends('wayshop.layouts.master')
 @section('content')
<div class="contact-box-main">

    <div class="container">
    @include('other.message')
     <div class="row">
         <div class="col-md-3"></div>
         <div class="col-md-6">
             <div class="contact-form-right">
                 <h2>Change Password !</h2>
                 <form action="{{url('/store-password')}}" method="POST" id="contactForm registerForm">
                    @csrf 
                     <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" class="form-control" placeholder="Your Old Password" id="old_pwd" name="old_pwd">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Your Current Password" id="current_password" name="current_password" required >
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Type New Password" id="new_pwd" name="new_pwd" required >
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
