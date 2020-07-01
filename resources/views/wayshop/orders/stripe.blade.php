@extends('wayshop.layouts.master')
@section('content')
    <div class="container mt-5">
        @include('other.message')
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
                            <p>YOUR ORDER HAS BEEN PLACED!!</p>
                            <footer class="blockquote-footer">Your Order number is {{ Session::get('order_id') }} and Your payable amount is $ {{ Session::get('grand_total') }}.For card payment check below. </footer>
                            </blockquote>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="text-white">Make your payment by entering your debit or credit card.</h3>
                        <h5 class="text-white">Thanks for being with us.</h5>
                    </div>
                    <div class="card-body">
                        <script src="https://js.stripe.com/v3/"></script>

                        <form action="/stripe-payment" method="post" id="payment-form">
                            @csrf
                            <div class="form-row">
                                <b>Total Amount:</b>
                                <input type="text" class="form-control" name="total_amount" placeholder="Enter Total Payable Amount">
                                <b>Your Name:</b>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                                <b>Card Number:</b>
                                <div id="card-element" class="form-control">

                                </div>
                            </div>

                            <button class="btn btn-success btn-sm" style="float: right; margin-top: 10px;">Submit Payment</button>
                        </form>  
                        <div id="card-error" role="alert"></div>
                        </div>
                </div>                                   
            </div>
        </div>
    </div>
    <div class="mt-5"></div>

    <script>
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51GwiB4DahCR9TFgpP3rfxzFoJuFcKzwD8Mg1zVItePZoRecmNWDCtuEX7B6EL1J6ISB7qByJCkboXCyIdhiT99nx00y8AJJSzw');

        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }
    </script>
@endsection

@php
   //Session::forget('order_id');
   //Session::forget('grand_total'); 
@endphp