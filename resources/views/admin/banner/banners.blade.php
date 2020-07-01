@extends('admin.layouts.master')
@section('title','Banners')

@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="header-icon">
                <i class="fa fa-image"></i>
            </div>
            <div class="header-title">
                <h1>Banners</h1>
                <small>Banners</small>
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
                                    <h4>View Banners</h4>
                                </a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                            <div class="btn-group">
                                <div class="buttonexport" id="buttonlist">
                                    <a class="btn btn-add" href="{{ route('admin.add-banner') }}"> <i class="fa fa-plus"></i> Add Banner
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="table_id" class="table table-bordered table-striped table-hover">
                                    <thead>
                                    <tr class="info">
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Sort Order</th>                           
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>                                  
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>{!! $banner->name !!}</td>
                                            <td>{{ $banner->sort_order }}</td>
                                             <td>
                                                @if(!empty($banner->image))
                                                    <img src="{{asset('uploads/banner/'.$banner->image)}}" alt="no image" style="width: 200px;">
                                                 @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" class="btn btn-success" id="BannerStatus" rel="{{ $banner->id }}"
                                                data-toggle="toggle" data-on="Enabled" data-off="Disabled" data-onstyle="success" data-offstyle="danger"
                                                @if ($banner['status']=="1") checked @endif>  
                                            </td>                                                                             
                                            <td>
                                                <a href="{{ url('/admin/edit-banners/'.$banner->id) }}" class="btn btn-add btn-sm" data-toggle="tooltip" title="Edit Banner!" ><i class="fa fa-pencil"></i></a>
                                                <a href="{{ url('/admin/delete-banners/'.$banner->id) }}" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Delete Banner!" ><i class="fa fa-trash-o"></i> </a>
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
