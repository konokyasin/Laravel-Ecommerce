@extends('admin.layouts.master')
@section('title','Edit Banner')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-pencil"></i>
            </div>
            <div class="header-title">
                <h1>Edit Banner</h1>
                <small>Edit Banner</small>
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
                                <a class="btn btn-add " href="{{ route('admin.banners') }}">
                                    <i class="fa fa-image"></i>  View Banners </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form class="col-sm-6" action="{{ url('/admin/update-banners/'.$bannerDetails->id) }}" method="post" enctype="multipart/form-data">
                                @csrf                  
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Banner Name" value="{{ $bannerDetails->name }}" name="banner_name" id="banner_name" required>
                                </div>
                                <div class="form-group">
                                    <label>Text Style</label>
                                    <input type="text" class="form-control" placeholder="Enter Text Style" value="{{ $bannerDetails->text_style }}" name="text_style" id="text_style" required>
                                </div>
                                <div class="form-group">
                                    <label for="banner_content">Content</label>
                                    <textarea id="banner_content" class="form-control" name="banner_content" placeholder="Enter Banner Content" required>{{ $bannerDetails->content }}</textarea>                                  
                                </div>
                                <div class="form-group">
                                    <label>Link</label>
                                    <input name="link" id="link" placeholder="Enter Link" value="{{ $bannerDetails->link }}" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Sort Order</label>
                                    <input type="number" class="form-control" name="sort_order" id="sort_order" placeholder="Enter Sort Order" value="{{ $bannerDetails->sort_order }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Banner Image</label>
                                    <input type="file" name="image">
                                    <input type="hidden" name="current_image" value="{{ $bannerDetails->image }}">
                                    @if(!empty($bannerDetails->image))
                                        <img src="{{asset('uploads/banner/'.$bannerDetails->image)}}" alt="no image" style="width: 250px; margin-top: 10px;">
                                    @endif
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-success" value="Update Banner">
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
