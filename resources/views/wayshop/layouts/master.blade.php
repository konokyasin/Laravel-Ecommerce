<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>ThewayShop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="{{ asset('front_assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('front_assets/images/apple-touch-icon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/bootstrap.min.css') }}">
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/responsive.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('front_assets/css/custom.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- select 2 css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

@include('wayshop.layouts.header')
@yield('content')
@include('wayshop.layouts.footer')

<a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

<!-- ALL JS FILES -->
<script src="{{ asset('front_assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('front_assets/js/popper.min.js') }}"></script>
<script src="{{ asset('front_assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front_assets/js/jquery-ui.js') }}"></script>
<!-- ALL PLUGINS -->
<script src=" {{ asset('front_assets/js/jquery.superslides.min.js') }}"></script>
<script src=" {{ asset('front_assets/js/bootstrap-select.js') }}"></script>
<script src=" {{ asset('front_assets/js/inewsticker.js') }}"></script>
<script src=" {{ asset('front_assets/js/bootsnav.js') }}"></script>
<script src=" {{ asset('front_assets/js/images-loded.min.js') }}"></script>
<script src=" {{ asset('front_assets/js/isotope.min.js') }}"></script>
<script src=" {{ asset('front_assets/js/owl.carousel.min.js') }}"></script>
<script src=" {{ asset('front_assets/js/baguetteBox.min.js') }}"></script>
<script src=" {{ asset('front_assets/js/form-validator.min.js')}}"></script>
<script src=" {{ asset('front_assets/js/contact-form-script.js') }}"></script>
<script src=" {{ asset('front_assets/js/custom.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#selSize').change(function () {
            var idSize = $(this).val();
            if(idSize==""){
                return false;
            }
            $.ajax({
                type : 'get',
                url : '/get-product-price',
                data : {idSize:idSize},
                success :function (resp) {
                    // alert(resp);
                    var arr = resp.split('#');
                    $('#getPrice').html("$ "+arr[0]);
                    $('#price').val(arr[0]);
                },
                error :function(){
                    alert('error');
                }
            });
        });
        //select fa-stack-2x
        $('#country').select2();

        //checkout page jquery
        $('#billtoship').click(function(){
            if(this.checked){
                $("#shipping_name").val($("#billing_name").val());
                $("#shipping_address").val($("#billing_address").val());
                $("#shipping_city").val($("#billing_city").val());
                $("#shipping_state").val($("#billing_state").val());
                $("#shipping_country").val($("#billing_country").val());
                $("#shipping_pincode").val($("#billing_pincode").val());
                $("#shipping_mobile").val($("#billing_mobile").val());
            }else{
                $("#shipping_name").val('');
                $("#shipping_address").val('');
                $("#shipping_city").val('');
                $("#shipping_state").val('');
                $("#shipping_country").val('');
                $("#shipping_pincode").val('');
                $("#shipping_mobile").val('');
            }
        });
    });
    //payment method
    function selectPaymentMethod(){
      if($('.stripe').is(':checked') || $('.cod').is(':checked')){
        //alert('checked');
      }else{
        alert('Please Select Payment Method');
        return false;
      }
    }
</script>
</body>

</html>
