@extends('wayshop.layouts.master')

@section('content')


<!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>{{ $productDetails->name }}</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active">{{ $productDetails->name }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->
<div class="mt-3"></div>
@include('other.message')
    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @foreach($productAltImages as $key=>$images)
                            <div class="carousel-item {{ $key==0 ? 'active' : ''}}"> <img class="d-block w-100" src="{{ asset('uploads/product/'.$images->image) }}" alt="First slide"> </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
						<i class="fa fa-angle-left" aria-hidden="true"></i>
						<span class="sr-only">Previous</span> 
					</a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
						<i class="fa fa-angle-right" aria-hidden="true"></i> 
						<span class="sr-only">Next</span> 
					</a>
                        <ol class="carousel-indicators">
                            @foreach($productAltImages as $key=>$images)
                                <li data-target="#carousel-example-1" data-slide-to="{{ $key }}" class="{{ $key==0 ? 'active' : ''}}">
                                    <img class="d-block w-100 img-fluid" src="{{ asset('uploads/product/'.$images->image) }}" alt="" />
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    <form name="addtoCart" action="{{ url('/store-cart') }}" method="post">
                        @csrf
                        <div class="single-product-details">
                            <input type="hidden" value="{{ $productDetails->id }}" name="product_id">
                            <input type="hidden" value="{{ $productDetails->name }}" name="product_name">
                            <input type="hidden" value="{{ $productDetails->code }}" name="product_code">
                            <input type="hidden" value="{{ $productDetails->color }}" name="color">
                            <input type="hidden" id="price" value="{{ $productDetails->price }}" name="price">
                            <h2>{{ $productDetails->name }}</h2>
                            <h5 id="getPrice">$ {{ $productDetails->price }}</h5>
                                    <h4>Short Description:</h4>
                                    <p>{{ $productDetails->description }}</p>
                                    <ul>
                                        <li>
                                            <div class="form-group size-st">
                                                <label class="size-label">Size</label>
                                                <select id="selSize" name="size" class="selectpicker show-tick form-control">
                                                    <option value="0" disabled>Size</option>
                                                    @foreach($productDetails->attributes as $sizes)
                                                        <option value="{{$productDetails->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-group quantity-box">
                                                <label class="control-label">Quantity</label>
                                                <input class="form-control" name="quantity" value="1" min="1" max="20" type="number">
                                            </div>
                                        </li>
                                    </ul>

                                    <div class="price-box-bar">
                                        <div class="cart-and-bay-btn">                                        
                                            <button type="submit" class="btn hvr-hover text-white" data-fancybox-close="">Add to cart</button>
                                        </div>
                                    </div>

                                    <div class="add-to-btn">
                                        <div class="add-comp">
                                            <a class="btn hvr-hover" href="#"><i class="fas fa-heart"></i> Add to wishlist</a>
                                            <a class="btn hvr-hover" href="#"><i class="fas fa-sync-alt"></i> Add to Compare</a>
                                        </div>
                                        <div class="share-bar">
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-google-plus" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                            <a class="btn hvr-hover" href="#"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Featured Products</h1>
                    </div>
                    <div class="featured-products-box owl-carousel owl-theme">
                        @foreach($featuredProducts as $featuredProduct)
                            <div class="item">
                                <div class="products-single fix">
                                    <div class="box-img-hover">
                                        <img src="{{ asset('uploads/product/'.$featuredProduct->image) }}" class="img-fluid" alt="Image">
                                        <div class="mask-icon">
                                            <ul>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                            </ul>
                                            <a class="cart" href="#">Add to Cart</a>
                                        </div>
                                    </div>
                                    <div class="why-text">
                                        <h4>{{ $featuredProduct->name }}</h4>
                                        <h5> ${{ $featuredProduct->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <!-- Start Instagram Feed  -->
    <div class="instagram-box">
        <div class="main-instagram owl-carousel owl-theme">
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-01.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-02.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-03.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-04.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-06.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-07.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-08.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-09.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="ins-inner-box">
                    <img src="{{ asset('front_assets/images/instagram-img-05.jpg') }}" alt="" />
                    <div class="hov-in">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Instagram Feed  -->


@endsection